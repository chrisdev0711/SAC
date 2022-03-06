<?php

namespace App\Http\Controllers;

use App\Models\Costing;
use Illuminate\Http\Request;
use App\Http\Requests\CostingStoreRequest;
use App\Http\Requests\CostingUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Auth;
use Session;

class CostingController extends Controller
{
    
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Costing::class);

        $search = $request->get('search', '');

        $costings = Costing::search($search)
            ->latest()
            ->paginate(50);

        return view('app.costings.index', compact('costings', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Costing::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.costings.create', compact('sac_num'));
    }

    /**
     * @param \App\Http\Requests\costingstoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(costingstoreRequest $request)
    {
        $this->authorize('create', Costing::class);

        $validated = $request->validated();

        $costing = Costing::create($validated);

        $appliance_id = session('appliance_id');
        if($appliance_id != null)
        {
           $appliance = Appliance::find($appliance_id);
           Action::create([
            'actionable_id' => $costing->id,
            'actionable_type' => 'App\Models\Costing',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
           ]);

           $appliance->Status = "ebay";
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
    public function show(Request $request, Costing $costing)
    {
        $this->authorize('view', $costing);

        return view('app.costings.show', compact('costing'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Costing $costing
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Costing $costing)
    {
        $this->authorize('update', $costing);

        $action = Action::where('actionable_id', $costing->id)->where('actionable_type', 'App\Models\Costing')->first();
        $appliance = Appliance::find($action->appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.costings.edit', compact('costing', 'sac_num'));
    }

    /**
     * @param \App\Http\Requests\CostingUpdateRequest $request
     * @param \App\Models\Costing $costing
     * @return \Illuminate\Http\Response
     */
    public function update(
        CostingUpdateRequest $request,
        Costing $costing
    ) {
        $this->authorize('update', $costing);

        $validated = $request->validated();

        $costing->update($validated);

        $action = Action::where('actionable_id', $costing->id)->where('actionable_type', 'App\Models\Costing')->first();
        if($action)
        {
            $appliance = Appliance::find($action->appliance_id);
            $newAction = Action::firstOrCreate(
                [
                    'actionable_id' => $costing->id,
                    'actionable_type' => 'App\Models\Costing'
                ],
                [
                    'actionable_id' => $costing->id,
                    'actionable_type' => 'App\Models\Costing'
                ]
            );

            $newAction->appliance_id = $appliance->id;
            $newAction->actioned_by = Auth::user()->id;
            $newAction->save();

           $appliance->Status = "ebay";
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
    public function destroy(Request $request, Costing $costing)
    {
        $this->authorize('delete', $costing);

        $costing->delete();

        return redirect()
            ->route('costings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
