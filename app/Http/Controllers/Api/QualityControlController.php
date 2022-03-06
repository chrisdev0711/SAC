<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\QualityControl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\QualityControlResource;
use App\Http\Resources\QualityControlCollection;
use App\Http\Requests\QualityControlStoreRequest;
use App\Http\Requests\QualityControlUpdateRequest;

class QualityControlController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', QualityControl::class);

        $search = $request->get('search', '');

        $qualityControls = QualityControl::search($search)
            ->latest()
            ->paginate();

        return new QualityControlCollection($qualityControls);
    }

    /**
     * @param \App\Http\Requests\QualityControlStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualityControlStoreRequest $request)
    {
        $this->authorize('create', QualityControl::class);

        $validated = $request->validated();
        if ($request->hasFile('cosmetic_mark1_img')) {
            $validated['cosmetic_mark1_img'] = $request
                ->file('cosmetic_mark1_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark2_img')) {
            $validated['cosmetic_mark2_img'] = $request
                ->file('cosmetic_mark2_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark3_img')) {
            $validated['cosmetic_mark3_img'] = $request
                ->file('cosmetic_mark3_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark1_img')) {
            $validated['cosmetic_mark1_img'] = $request
                ->file('cosmetic_mark1_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark2_img')) {
            $validated['cosmetic_mark2_img'] = $request
                ->file('cosmetic_mark2_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark3_img')) {
            $validated['cosmetic_mark3_img'] = $request
                ->file('cosmetic_mark3_img')
                ->store('public');
        }

        $qualityControl = QualityControl::create($validated);

        return new QualityControlResource($qualityControl);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QualityControl $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, QualityControl $qualityControl)
    {
        $this->authorize('view', $qualityControl);

        return new QualityControlResource($qualityControl);
    }

    /**
     * @param \App\Http\Requests\QualityControlUpdateRequest $request
     * @param \App\Models\QualityControl $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function update(
        QualityControlUpdateRequest $request,
        QualityControl $qualityControl
    ) {
        $this->authorize('update', $qualityControl);

        $validated = $request->validated();

        if ($request->hasFile('cosmetic_mark1_img')) {
            if ($qualityControl->cosmetic_mark1_img) {
                Storage::delete($qualityControl->cosmetic_mark1_img);
            }

            $validated['cosmetic_mark1_img'] = $request
                ->file('cosmetic_mark1_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark2_img')) {
            if ($qualityControl->cosmetic_mark2_img) {
                Storage::delete($qualityControl->cosmetic_mark2_img);
            }

            $validated['cosmetic_mark2_img'] = $request
                ->file('cosmetic_mark2_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark3_img')) {
            if ($qualityControl->cosmetic_mark3_img) {
                Storage::delete($qualityControl->cosmetic_mark3_img);
            }

            $validated['cosmetic_mark3_img'] = $request
                ->file('cosmetic_mark3_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark1_img')) {
            if ($qualityControl->cosmetic_mark1_img) {
                Storage::delete($qualityControl->cosmetic_mark1_img);
            }

            $validated['cosmetic_mark1_img'] = $request
                ->file('cosmetic_mark1_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark2_img')) {
            if ($qualityControl->cosmetic_mark2_img) {
                Storage::delete($qualityControl->cosmetic_mark2_img);
            }

            $validated['cosmetic_mark2_img'] = $request
                ->file('cosmetic_mark2_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark3_img')) {
            if ($qualityControl->cosmetic_mark3_img) {
                Storage::delete($qualityControl->cosmetic_mark3_img);
            }

            $validated['cosmetic_mark3_img'] = $request
                ->file('cosmetic_mark3_img')
                ->store('public');
        }

        $qualityControl->update($validated);

        return new QualityControlResource($qualityControl);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QualityControl $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, QualityControl $qualityControl)
    {
        $this->authorize('delete', $qualityControl);

        if ($qualityControl->cosmetic_mark1_img) {
            Storage::delete($qualityControl->cosmetic_mark1_img);
        }

        if ($qualityControl->cosmetic_mark2_img) {
            Storage::delete($qualityControl->cosmetic_mark2_img);
        }

        if ($qualityControl->cosmetic_mark3_img) {
            Storage::delete($qualityControl->cosmetic_mark3_img);
        }

        if ($qualityControl->cosmetic_mark1_img) {
            Storage::delete($qualityControl->cosmetic_mark1_img);
        }

        if ($qualityControl->cosmetic_mark2_img) {
            Storage::delete($qualityControl->cosmetic_mark2_img);
        }

        if ($qualityControl->cosmetic_mark3_img) {
            Storage::delete($qualityControl->cosmetic_mark3_img);
        }

        $qualityControl->delete();

        return response()->noContent();
    }
}
