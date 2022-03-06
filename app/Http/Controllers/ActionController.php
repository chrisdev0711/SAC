<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Action;
use App\Models\Appliance;
use Illuminate\Http\Request;
use App\Http\Requests\ActionStoreRequest;
use App\Http\Requests\ActionUpdateRequest;

class ActionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Action::class);

        $search = $request->get('search', '');
        
        $search_year = $request->get('search_year', '');
        $search_month = $request->get('search_month', '');
        if (!$search_year && $search_month) 
            $search_year = date('Y');
        else if($search_year && !$search_month)
            $search_month = date('n');
        $start = $search_year.'-'.($search_month < 10 ? '0'.$search_month : $search_month);
               
        $actions = Action::search($search)
            ->latest()
            ->paginate(50);
        if ($start!=0) {
            $actions = Action::where('updated_at', 'like', '%'.$start.'%')
                ->orderBy('actionable_type')
                ->paginate(50);
        } 

        return view('app.actions.index', compact('actions', 'search','search_year', 'search_month'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Action::class);

        $appliances = Appliance::pluck('ModelNumber', 'id');
        $users = User::pluck('name', 'id');

        return view('app.actions.create', compact('appliances', 'users'));
    }

    /**
     * @param \App\Http\Requests\ActionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActionStoreRequest $request)
    {
        $this->authorize('create', Action::class);

        $validated = $request->validated();

        $action = Action::create($validated);

        return redirect()
            ->route('actions.edit', $action)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Action $action
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Action $action)
    {
        $this->authorize('view', $action);

        return view('app.actions.show', compact('action'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Action $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Action $action)
    {
        $this->authorize('update', $action);

        $appliances = Appliance::pluck('ModelNumber', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.actions.edit',
            compact('action', 'appliances', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\ActionUpdateRequest $request
     * @param \App\Models\Action $action
     * @return \Illuminate\Http\Response
     */
    public function update(ActionUpdateRequest $request, Action $action)
    {
        $this->authorize('update', $action);

        $validated = $request->validated();

        $action->update($validated);

        return redirect()
            ->route('actions.edit', $action)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Action $action
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Action $action)
    {
        $this->authorize('delete', $action);

        $action->delete();

        return redirect()
            ->route('actions.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function viewAction(Request $request)
    {
        $action_id = $request->action_id;
        $action = Action::find($action_id);

        $model = $action->actionable;

        $idx = strrpos($action->actionable_type, '\\');
        $model_type = substr($action->actionable_type, $idx+1);

        if($model_type == 'CheckIn')
            return redirect()->route('check-ins.show', $model);
        elseif($model_type == 'PlugCheck')
            return redirect()->route('plug-checks.show', $model);
        elseif($model_type == 'FaultDiagnosis')
            return redirect()->route('fault-diagnoses.show', $model);
        elseif($model_type == 'PlugCheck')
            return redirect()->route('plug-checks.show', $model);
        elseif($model_type == 'Cleaning')
            return redirect()->route('cleanings.show', $model);
        elseif($model_type == 'QualityControl')
            return redirect()->route('quality-controls.show', $model);
        elseif($model_type == 'Listing')
            return redirect()->route('listings.show', $model);
        elseif($model_type == 'Costing')
            return redirect()->route('costings.show', $model);
        elseif($model_type == 'Ebay')
            return redirect()->route('ebays.show', $model);
        elseif($model_type == 'Finalized')
            return redirect()->route('finalizeds.show', $model);

    }
}
