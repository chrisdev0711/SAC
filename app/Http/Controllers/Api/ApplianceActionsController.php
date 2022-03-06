<?php

namespace App\Http\Controllers\Api;

use App\Models\Appliance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActionResource;
use App\Http\Resources\ActionCollection;

class ApplianceActionsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appliance $appliance
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Appliance $appliance)
    {
        $this->authorize('view', $appliance);

        $search = $request->get('search', '');

        $actions = $appliance
            ->actions()
            ->search($search)
            ->latest()
            ->paginate();

        return new ActionCollection($actions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appliance $appliance
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Appliance $appliance)
    {
        $this->authorize('create', Action::class);

        $validated = $request->validate([
            'actionable_id' => ['required', 'max:255'],
            'actionable_type' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $action = $appliance->actions()->create($validated);

        return new ActionResource($action);
    }
}
