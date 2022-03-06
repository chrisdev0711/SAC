<?php

namespace App\Http\Controllers;

use App\Models\PlugCheck;
use Illuminate\Http\Request;
use App\Http\Requests\PlugCheckStoreRequest;
use App\Http\Requests\PlugCheckUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Auth;
use Session;

class PlugCheckController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PlugCheck::class);

        $search = $request->get('search', '');

        $plugChecks = PlugCheck::search($search)
            ->latest()
            ->paginate(50);

        return view('app.plug_checks.index', compact('plugChecks', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', PlugCheck::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);
        $sac_num = $appliance->SACNo;
        return view('app.plug_checks.create', compact('sac_num', 'appliance_id'));
    }

    /**
     * @param \App\Http\Requests\PlugCheckStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlugCheckStoreRequest $request)
    {
        $this->authorize('create', PlugCheck::class);

        $validated = $request->validated();
        
        $plugCheck = PlugCheck::create($validated);

        $appliance_id = session('appliance_id');
        if($appliance_id != null)
        {
           $appliance = Appliance::find($appliance_id);
           Action::create([
            'actionable_id' => $plugCheck->id,
            'actionable_type' => 'App\Models\PlugCheck',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
           ]);

           $appliance->Status = "test & repair";
           $appliance->save();
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PlugCheck $plugCheck
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PlugCheck $plugCheck)
    {
        $this->authorize('view', $plugCheck);

        return view('app.plug_checks.show', compact('plugCheck'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PlugCheck $plugCheck
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PlugCheck $plugCheck)
    {
        $this->authorize('update', $plugCheck);

        $action = Action::where('actionable_id', $plugCheck->id)->where('actionable_type', 'App\Models\PlugCheck')->first();
        $appliance = Appliance::find($action->appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.plug_checks.edit', compact('plugCheck', 'sac_num'));
    }

    /**
     * @param \App\Http\Requests\PlugCheckUpdateRequest $request
     * @param \App\Models\PlugCheck $plugCheck
     * @return \Illuminate\Http\Response
     */
    public function update(
        PlugCheckUpdateRequest $request,
        PlugCheck $plugCheck
    ) {
        $this->authorize('update', $plugCheck);

        $validated = $request->validated();

        $plugCheck->update($validated);

        $action = Action::where('actionable_id', $plugCheck->id)->where('actionable_type', 'App\Models\PlugCheck')->first();
        if($action)
        {
            $appliance = Appliance::find($action->appliance_id);
            $newAction = Action::firstOrCreate(
                [
                    'actionable_id' => $plugCheck->id,
                    'actionable_type' => 'App\Models\PlugCheck'
                ],
                [
                    'actionable_id' => $plugCheck->id,
                    'actionable_type' => 'App\Models\PlugCheck'
                ]
            );

            $newAction->appliance_id = $appliance->id;
            $newAction->actioned_by = Auth::user()->id;
            $newAction->save();

           $appliance->Status = "test & repair";
           $appliance->save();
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PlugCheck $plugCheck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PlugCheck $plugCheck)
    {
        $this->authorize('delete', $plugCheck);

        $plugCheck->delete();

        return redirect()
            ->route('plug-checks.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function setStatusScrapped(Request $request) {
        $appliance_id = $request->appliance_id;
        $appliance = Appliance::find($appliance_id);
        $appliance->status = 'scrapped';
        $appliance->save();

        return redirect()
            ->route('dashboard')
            ->withSuccess(__('crud.common.setScrapped'));
        
    }
}
