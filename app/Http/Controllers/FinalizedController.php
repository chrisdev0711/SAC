<?php

namespace App\Http\Controllers;

use App\Models\Finalized;
use Illuminate\Http\Request;
use App\Http\Requests\FinalizedStoreRequest;
use App\Http\Requests\FinalizedUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Auth;
use Session;

class FinalizedController extends Controller
{
    
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Finalized::class);

        $search = $request->get('search', '');

        $finalizeds = Finalized::search($search)
            ->latest()
            ->paginate(50);

        return view('app.finalizeds.index', compact('finalizeds', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Finalized::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.finalizeds.create', compact('sac_num'));
    }

    /**
     * @param \App\Http\Requests\FinalizedStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FinalizedStoreRequest $request)
    {
        $this->authorize('create', Finalized::class);

        $validated = $request->validated();

        $finalized = Finalized::create($validated);

        $appliance_id = session('appliance_id');
        if($appliance_id != null)
        {
           $appliance = Appliance::find($appliance_id);
           Action::create([
            'actionable_id' => $finalized->id,
            'actionable_type' => 'App\Models\Finalized',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
           ]);

           $appliance->Status = "finalized";
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
    public function show(Request $request, Finalized $finalized)
    {
        $this->authorize('view', $finalized);

        return view('app.finalizeds.show', compact('finalized'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Finalized $finalized
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Finalized $finalized)
    {
        $this->authorize('update', $finalized);

        $action = Action::where('actionable_id', $finalized->id)->where('actionable_type', 'App\Models\Finalized')->first();
        $appliance = Appliance::find($action->appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.finalizeds.edit', compact('finalized', 'sac_num'));
    }

    /**
     * @param \App\Http\Requests\FinalizedUpdateRequest $request
     * @param \App\Models\Finalized $finalized
     * @return \Illuminate\Http\Response
     */
    public function update(
        FinalizedUpdateRequest $request,
        Finalized $finalized
    ) {
        $this->authorize('update', $finalized);

        $validated = $request->validated();

        $finalized->update($validated);

        $action = Action::where('actionable_id', $finalized->id)->where('actionable_type', 'App\Models\Finalized')->first();
        if($action)
        {
            $appliance = Appliance::find($action->appliance_id);
            $newAction = Action::firstOrCreate(
                [
                    'actionable_id' => $finalized->id,
                    'actionable_type' => 'App\Models\Finalized'
                ],
                [
                    'actionable_id' => $finalized->id,
                    'actionable_type' => 'App\Models\Finalized'
                ]
            );

            $newAction->appliance_id = $appliance->id;
            $newAction->actioned_by = Auth::user()->id;
            $newAction->save();

           $appliance->Status = "finalized";
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
    public function destroy(Request $request, Finalized $finalized)
    {
        $this->authorize('delete', $finalized);

        $finalized->delete();

        return redirect()
            ->route('finalizeds.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
