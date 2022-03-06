<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaultDiagnosis;
use App\Http\Requests\FaultDiagnosisStoreRequest;
use App\Http\Requests\FaultDiagnosisUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Auth;
use Session;
use \Datetime;

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
            ->paginate(50);

        return view(
            'app.fault_diagnoses.index',
            compact('faultDiagnoses', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', FaultDiagnosis::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);        
        $sac_num = $appliance->SACNo;

        $started_at = DateTime::createFromFormat('m-d-Y H:i', date('m-d-Y H:i'));

        $old = $appliance->actionsByType('FaultDiagnosis');
        if($old)
        {
            $faultDiagnoses = FaultDiagnosis::find($old->actionable_id);
            $started_at = $faultDiagnoses->time_started;
        }

        return view('app.fault_diagnoses.create', compact('sac_num', 'old', 'started_at'));
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

        $appliance_id = session('appliance_id');
        if($appliance_id != null)
        {
            $appliance = Appliance::find($appliance_id);
            Action::create([
                'actionable_id' => $faultDiagnosis->id,
                'actionable_type' => 'App\Models\FaultDiagnosis',
                'appliance_id' => $appliance->id,
                'actioned_by' => Auth::user()->id,
            ]);
            switch ($request->input('action')) {
                case 'waitingParts':
                    $appliance->Status = "test & repair";
                    $appliance->save();
                    break;                
                case null:
                    $appliance->Status = "cleaning";
                    $appliance->save();
                    break;
            }             
            if($faultDiagnosis->test_again) {
                $appliance->Status = "test & repair";
                $appliance->save();
            }
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FaultDiagnosis $faultDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, FaultDiagnosis $faultDiagnosis)
    {
        $this->authorize('view', $faultDiagnosis);

        return view('app.fault_diagnoses.show', compact('faultDiagnosis'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\FaultDiagnosis $faultDiagnosis
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, FaultDiagnosis $faultDiagnosis)
    {
        $this->authorize('update', $faultDiagnosis);

        $action = Action::where('actionable_id', $faultDiagnosis->id)->where('actionable_type', 'App\Models\FaultDiagnosis')->first();
        $appliance = Appliance::find($action->appliance_id);
        $sac_num = $appliance->SACNo;

        $started_at = DateTime::createFromFormat('m-d-Y H:i', date('m-d-Y H:i'));
        $old = $appliance->actionsByType('FaultDiagnosis');      
        if($old)
        {
            $faultDiagnoses = FaultDiagnosis::find($old->actionable_id);
            $started_at = $faultDiagnoses->time_started;
        }

        return view('app.fault_diagnoses.edit', compact('faultDiagnosis', 'sac_num', 'started_at'));
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

        $action = Action::where('actionable_id', $faultDiagnosis->id)->where('actionable_type', 'App\Models\FaultDiagnosis')->first();
        if($action)
        {
            $appliance = Appliance::find($action->appliance_id);
            $newAction = Action::firstOrCreate(
                [
                    'actionable_id' => $faultDiagnosis->id,
                    'actionable_type' => 'App\Models\FaultDiagnosis'
                ],
                [
                    'actionable_id' => $faultDiagnosis->id,
                    'actionable_type' => 'App\Models\FaultDiagnosis'
                ]
            );

            $newAction->appliance_id = $appliance->id;
            $newAction->actioned_by = Auth::user()->id;
            $newAction->save();

            if(!$faultDiagnosis->test_again) {
                $appliance->Status = "cleaning";
                $appliance->save();
            }
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('fault-diagnoses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
