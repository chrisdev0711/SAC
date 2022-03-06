<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\FaultDiagnosis;
use App\Http\Controllers\Controller;
use App\Http\Resources\FaultDiagnosisResource;
use App\Http\Resources\FaultDiagnosisCollection;
use App\Http\Requests\FaultDiagnosisStoreRequest;
use App\Http\Requests\FaultDiagnosisUpdateRequest;

class FaultDiagnosisController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', FaultDiagnosis::class);

        $search = $request->get('search', '');

        $faultDiagnoses = FaultDiagnosis::search($search)
            ->latest()
            ->paginate();

        return new FaultDiagnosisCollection($faultDiagnoses);
    }

    /**
     * @param \App\Http\Requests\FaultDiagnosisStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaultDiagnosisStoreRequest $request)
    {
        $this->authorize('create', FaultDiagnosis::class);

        $validated = $request->validated();

        $faultDiagnosis = FaultDiagnosis::create($validated);

        return new FaultDiagnosisResource($faultDiagnosis);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FaultDiagnosis $faultDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, FaultDiagnosis $faultDiagnosis)
    {
        $this->authorize('view', $faultDiagnosis);

        return new FaultDiagnosisResource($faultDiagnosis);
    }

    /**
     * @param \App\Http\Requests\FaultDiagnosisUpdateRequest $request
     * @param \App\Models\FaultDiagnosis $faultDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(
        FaultDiagnosisUpdateRequest $request,
        FaultDiagnosis $faultDiagnosis
    ) {
        $this->authorize('update', $faultDiagnosis);

        $validated = $request->validated();

        $faultDiagnosis->update($validated);

        return new FaultDiagnosisResource($faultDiagnosis);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FaultDiagnosis $faultDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, FaultDiagnosis $faultDiagnosis)
    {
        $this->authorize('delete', $faultDiagnosis);

        $faultDiagnosis->delete();

        return response()->noContent();
    }
}
