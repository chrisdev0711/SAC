<?php

namespace App\Http\Controllers\Api;

use App\Models\Appliance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApplianceResource;
use App\Http\Resources\ApplianceCollection;
use App\Http\Requests\ApplianceStoreRequest;
use App\Http\Requests\ApplianceUpdateRequest;

class ApplianceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Appliance::class);

        $search = $request->get('search', '');

        $appliances = Appliance::search($search)
            ->latest()
            ->paginate();

        return new ApplianceCollection($appliances);
    }

    /**
     * @param \App\Http\Requests\ApplianceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplianceStoreRequest $request)
    {
        $this->authorize('create', Appliance::class);

        $validated = $request->validated();

        $appliance = Appliance::create($validated);

        return new ApplianceResource($appliance);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appliance $appliance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Appliance $appliance)
    {
        $this->authorize('view', $appliance);

        return new ApplianceResource($appliance);
    }

    /**
     * @param \App\Http\Requests\ApplianceUpdateRequest $request
     * @param \App\Models\Appliance $appliance
     * @return \Illuminate\Http\Response
     */
    public function update(
        ApplianceUpdateRequest $request,
        Appliance $appliance
    ) {
        $this->authorize('update', $appliance);

        $validated = $request->validated();

        $appliance->update($validated);

        return new ApplianceResource($appliance);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appliance $appliance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Appliance $appliance)
    {
        $this->authorize('delete', $appliance);

        $appliance->delete();

        return response()->noContent();
    }
}
