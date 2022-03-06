<?php

namespace App\Http\Controllers\Api;

use App\Models\Cleaning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CleaningResource;
use App\Http\Resources\CleaningCollection;
use App\Http\Requests\CleaningStoreRequest;
use App\Http\Requests\CleaningUpdateRequest;

class CleaningController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Cleaning::class);

        $search = $request->get('search', '');

        $cleanings = Cleaning::search($search)
            ->latest()
            ->paginate();

        return new CleaningCollection($cleanings);
    }

    /**
     * @param \App\Http\Requests\CleaningStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CleaningStoreRequest $request)
    {
        $this->authorize('create', Cleaning::class);

        $validated = $request->validated();
        if ($request->hasFile('inside_before_img')) {
            $validated['inside_before_img'] = $request
                ->file('inside_before_img')
                ->store('public');
        }

        if ($request->hasFile('outside_before_img')) {
            $validated['outside_before_img'] = $request
                ->file('outside_before_img')
                ->store('public');
        }

        if ($request->hasFile('inside_after_img')) {
            $validated['inside_after_img'] = $request
                ->file('inside_after_img')
                ->store('public');
        }

        if ($request->hasFile('outside_after_img')) {
            $validated['outside_after_img'] = $request
                ->file('outside_after_img')
                ->store('public');
        }

        if ($request->hasFile('inside_before_img')) {
            $validated['inside_before_img'] = $request
                ->file('inside_before_img')
                ->store('public');
        }

        if ($request->hasFile('outside_before_img')) {
            $validated['outside_before_img'] = $request
                ->file('outside_before_img')
                ->store('public');
        }

        if ($request->hasFile('inside_after_img')) {
            $validated['inside_after_img'] = $request
                ->file('inside_after_img')
                ->store('public');
        }

        if ($request->hasFile('outside_after_img')) {
            $validated['outside_after_img'] = $request
                ->file('outside_after_img')
                ->store('public');
        }

        $cleaning = Cleaning::create($validated);

        return new CleaningResource($cleaning);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cleaning $cleaning
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cleaning $cleaning)
    {
        $this->authorize('view', $cleaning);

        return new CleaningResource($cleaning);
    }

    /**
     * @param \App\Http\Requests\CleaningUpdateRequest $request
     * @param \App\Models\Cleaning $cleaning
     * @return \Illuminate\Http\Response
     */
    public function update(CleaningUpdateRequest $request, Cleaning $cleaning)
    {
        $this->authorize('update', $cleaning);

        $validated = $request->validated();

        if ($request->hasFile('inside_before_img')) {
            if ($cleaning->inside_before_img) {
                Storage::delete($cleaning->inside_before_img);
            }

            $validated['inside_before_img'] = $request
                ->file('inside_before_img')
                ->store('public');
        }

        if ($request->hasFile('outside_before_img')) {
            if ($cleaning->outside_before_img) {
                Storage::delete($cleaning->outside_before_img);
            }

            $validated['outside_before_img'] = $request
                ->file('outside_before_img')
                ->store('public');
        }

        if ($request->hasFile('inside_after_img')) {
            if ($cleaning->inside_after_img) {
                Storage::delete($cleaning->inside_after_img);
            }

            $validated['inside_after_img'] = $request
                ->file('inside_after_img')
                ->store('public');
        }

        if ($request->hasFile('outside_after_img')) {
            if ($cleaning->outside_after_img) {
                Storage::delete($cleaning->outside_after_img);
            }

            $validated['outside_after_img'] = $request
                ->file('outside_after_img')
                ->store('public');
        }

        if ($request->hasFile('inside_before_img')) {
            if ($cleaning->inside_before_img) {
                Storage::delete($cleaning->inside_before_img);
            }

            $validated['inside_before_img'] = $request
                ->file('inside_before_img')
                ->store('public');
        }

        if ($request->hasFile('outside_before_img')) {
            if ($cleaning->outside_before_img) {
                Storage::delete($cleaning->outside_before_img);
            }

            $validated['outside_before_img'] = $request
                ->file('outside_before_img')
                ->store('public');
        }

        if ($request->hasFile('inside_after_img')) {
            if ($cleaning->inside_after_img) {
                Storage::delete($cleaning->inside_after_img);
            }

            $validated['inside_after_img'] = $request
                ->file('inside_after_img')
                ->store('public');
        }

        if ($request->hasFile('outside_after_img')) {
            if ($cleaning->outside_after_img) {
                Storage::delete($cleaning->outside_after_img);
            }

            $validated['outside_after_img'] = $request
                ->file('outside_after_img')
                ->store('public');
        }

        $cleaning->update($validated);

        return new CleaningResource($cleaning);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cleaning $cleaning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cleaning $cleaning)
    {
        $this->authorize('delete', $cleaning);

        if ($cleaning->inside_before_img) {
            Storage::delete($cleaning->inside_before_img);
        }

        if ($cleaning->outside_before_img) {
            Storage::delete($cleaning->outside_before_img);
        }

        if ($cleaning->inside_after_img) {
            Storage::delete($cleaning->inside_after_img);
        }

        if ($cleaning->outside_after_img) {
            Storage::delete($cleaning->outside_after_img);
        }

        if ($cleaning->inside_before_img) {
            Storage::delete($cleaning->inside_before_img);
        }

        if ($cleaning->outside_before_img) {
            Storage::delete($cleaning->outside_before_img);
        }

        if ($cleaning->inside_after_img) {
            Storage::delete($cleaning->inside_after_img);
        }

        if ($cleaning->outside_after_img) {
            Storage::delete($cleaning->outside_after_img);
        }

        $cleaning->delete();

        return response()->noContent();
    }
}
