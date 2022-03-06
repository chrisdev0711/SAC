<?php

namespace App\Http\Controllers;

use App\Models\Ebay;
use Illuminate\Http\Request;
use App\Http\Requests\EbayStoreRequest;
use App\Http\Requests\EbayUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Auth;
use Session;

class EbayController extends Controller
{
    
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Ebay::class);

        $search = $request->get('search', '');

        $ebays = Ebay::search($search)
            ->latest()
            ->paginate(50);

        return view('app.ebays.index', compact('ebays', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Ebay::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.ebays.create', compact('sac_num'));
    }

    /**
     * @param \App\Http\Requests\EbayStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ebaystoreRequest $request)
    {
        $this->authorize('create', Ebay::class);

        $validated = $request->validated();

        $ebay = Ebay::create($validated);

        $appliance_id = session('appliance_id');
        if($appliance_id != null)
        {
           $appliance = Appliance::find($appliance_id);
           Action::create([
            'actionable_id' => $ebay->id,
            'actionable_type' => 'App\Models\Ebay',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
           ]);

           $appliance->Status = "finalizing";
           $appliance->save();
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Ebay $ebay)
    {
        $this->authorize('view', $ebay);

        return view('app.ebays.show', compact('ebay'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ebay $ebay
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Ebay $ebay)
    {
        $this->authorize('update', $ebay);
        
        $action = Action::where('actionable_id', $ebay->id)->where('actionable_type', 'App\Models\Ebay')->first();
        $appliance = Appliance::find($action->appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.ebays.edit', compact('ebay', 'sac_num'));
    }

    /**
     * @param \App\Http\Requests\EbayUpdateRequest $request
     * @param \App\Models\Ebay $ebay
     * @return \Illuminate\Http\Response
     */
    public function update(
        EbayUpdateRequest $request,
        Ebay $ebay
    ) {
        $this->authorize('update', $ebay);

        $validated = $request->validated();

        $ebay->update($validated);

        $action = Action::where('actionable_id', $ebay->id)->where('actionable_type', 'App\Models\Ebay')->first();
        if($action)
        {
            $appliance = Appliance::find($action->appliance_id);
            $newAction = Action::firstOrCreate(
                [
                    'actionable_id' => $ebay->id,
                    'actionable_type' => 'App\Models\Ebay'
                ],
                [
                    'actionable_id' => $ebay->id,
                    'actionable_type' => 'App\Models\Ebay'
                ]
            );

            $newAction->appliance_id = $appliance->id;
            $newAction->actioned_by = Auth::user()->id;
            $newAction->save();

           $appliance->Status = "finalizing";
           $appliance->save();
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Ebay $ebay)
    {
        $this->authorize('delete', $ebay);

        $ebay->delete();

        return redirect()
            ->route('ebays.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
