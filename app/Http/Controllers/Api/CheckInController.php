<?php

namespace App\Http\Controllers\Api;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CheckInResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CheckInCollection;
use App\Http\Requests\CheckInStoreRequest;
use App\Http\Requests\CheckInUpdateRequest;

class CheckInController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', CheckIn::class);

        $search = $request->get('search', '');
        
        $checkIns = CheckIn::search($search)
            ->latest()
            ->paginate();

        return new CheckInCollection($checkIns);
    }

    /**
     * @param \App\Http\Requests\CheckInStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckInStoreRequest $request)
    {
        $this->authorize('create', CheckIn::class);

        $validated = $request->validated();
        if ($request->hasFile('appliance_in_img')) {
            $validated['appliance_in_img'] = $request
                ->file('appliance_in_img')
                ->store('public');
        }

        if ($request->hasFile('data_badge_img')) {
            $validated['data_badge_img'] = $request
                ->file('data_badge_img')
                ->store('public');
        }

        if ($request->hasFile('appliance_in_img')) {
            $validated['appliance_in_img'] = $request
                ->file('appliance_in_img')
                ->store('public');
        }

        if ($request->hasFile('data_badge_img')) {
            $validated['data_badge_img'] = $request
                ->file('data_badge_img')
                ->store('public');
        }

        $checkIn = CheckIn::create($validated);

        return new CheckInResource($checkIn);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CheckIn $checkIn
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CheckIn $checkIn)
    {
        $this->authorize('view', $checkIn);

        return new CheckInResource($checkIn);
    }

    /**
     * @param \App\Http\Requests\CheckInUpdateRequest $request
     * @param \App\Models\CheckIn $checkIn
     * @return \Illuminate\Http\Response
     */
    public function update(CheckInUpdateRequest $request, CheckIn $checkIn)
    {
        $this->authorize('update', $checkIn);

        $validated = $request->validated();

        if ($request->hasFile('appliance_in_img')) {
            if ($checkIn->appliance_in_img) {
                Storage::delete($checkIn->appliance_in_img);
            }

            $validated['appliance_in_img'] = $request
                ->file('appliance_in_img')
                ->store('public');
        }

        if ($request->hasFile('data_badge_img')) {
            if ($checkIn->data_badge_img) {
                Storage::delete($checkIn->data_badge_img);
            }

            $validated['data_badge_img'] = $request
                ->file('data_badge_img')
                ->store('public');
        }

        if ($request->hasFile('appliance_in_img')) {
            if ($checkIn->appliance_in_img) {
                Storage::delete($checkIn->appliance_in_img);
            }

            $validated['appliance_in_img'] = $request
                ->file('appliance_in_img')
                ->store('public');
        }

        if ($request->hasFile('data_badge_img')) {
            if ($checkIn->data_badge_img) {
                Storage::delete($checkIn->data_badge_img);
            }

            $validated['data_badge_img'] = $request
                ->file('data_badge_img')
                ->store('public');
        }

        $checkIn->update($validated);

        return new CheckInResource($checkIn);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CheckIn $checkIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CheckIn $checkIn)
    {
        $this->authorize('delete', $checkIn);

        if ($checkIn->appliance_in_img) {
            Storage::delete($checkIn->appliance_in_img);
        }

        if ($checkIn->data_badge_img) {
            Storage::delete($checkIn->data_badge_img);
        }

        if ($checkIn->appliance_in_img) {
            Storage::delete($checkIn->appliance_in_img);
        }

        if ($checkIn->data_badge_img) {
            Storage::delete($checkIn->data_badge_img);
        }

        $checkIn->delete();

        return response()->noContent();
    }
}
