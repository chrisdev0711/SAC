<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QualityControl;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\QualityControlStoreRequest;
use App\Http\Requests\QualityControlUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Auth;
use Session;

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
            ->paginate(50);

        return view(
            'app.quality_controls.index',
            compact('qualityControls', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', QualityControl::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);
        $sac_num = $appliance->SACNo;


        return view('app.quality_controls.create', compact('sac_num'));
    }

    /**
     * @param \App\Http\Requests\QualityControlStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualityControlStoreRequest $request)
    {
        $this->authorize('create', QualityControl::class);
        
        $validated = $request->validated();
        if ($request->hasFile('cosmetic_mark_1_img')) {
            $validated['cosmetic_mark_1_img'] = $request
                ->file('cosmetic_mark_1_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_2_img')) {
            $validated['cosmetic_mark_2_img'] = $request
                ->file('cosmetic_mark_2_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_3_img')) {
            $validated['cosmetic_mark_3_img'] = $request
                ->file('cosmetic_mark_3_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_4_img')) {
            $validated['cosmetic_mark_4_img'] = $request
                ->file('cosmetic_mark_4_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_5_img')) {
            $validated['cosmetic_mark_5_img'] = $request
                ->file('cosmetic_mark_5_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_6_img')) {
            $validated['cosmetic_mark_6_img'] = $request
                ->file('cosmetic_mark_6_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_7_img')) {
            $validated['cosmetic_mark_7_img'] = $request
                ->file('cosmetic_mark_7_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_8_img')) {
            $validated['cosmetic_mark_8_img'] = $request
                ->file('cosmetic_mark_8_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_9_img')) {
            $validated['cosmetic_mark_9_img'] = $request
                ->file('cosmetic_mark_9_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_10_img')) {
            $validated['cosmetic_mark_10_img'] = $request
                ->file('cosmetic_mark_10_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_11_img')) {
            $validated['cosmetic_mark_11_img'] = $request
                ->file('cosmetic_mark_11_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_12_img')) {
            $validated['cosmetic_mark_12_img'] = $request
                ->file('cosmetic_mark_12_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_13_img')) {
            $validated['cosmetic_mark_13_img'] = $request
                ->file('cosmetic_mark_13_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_14_img')) {
            $validated['cosmetic_mark_14_img'] = $request
                ->file('cosmetic_mark_14_img')
                ->store('public');
        }

        $qualityControl = QualityControl::create($validated);

        $appliance_id = session('appliance_id');
        if($appliance_id != null)
        {
           $appliance = Appliance::find($appliance_id);
           Action::create([
            'actionable_id' => $qualityControl->id,
            'actionable_type' => 'App\Models\QualityControl',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
           ]);

           switch ($request->input('action')) {
            case 'backToFault':
                $appliance->Status = "test & repair";
                $appliance->save();
                break;
            case 'backToClean':
                $appliance->Status = "cleaning";
                $appliance->save();
                break;
            case 'default':
                $appliance->Status = "listing";
                $appliance->save();
                break;
            }           
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QualityControl $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, QualityControl $qualityControl)
    {
        $this->authorize('view', $qualityControl);

        return view('app.quality_controls.show', compact('qualityControl'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QualityControl $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, QualityControl $qualityControl)
    {
        $this->authorize('update', $qualityControl);
        
        $action = Action::where('actionable_id', $qualityControl->id)->where('actionable_type', 'App\Models\QualityControl')->first();
        $appliance = Appliance::find($action->appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.quality_controls.edit', compact('qualityControl', 'sac_num'));
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

        if ($request->hasFile('cosmetic_mark_1_img')) {
            if ($qualityControl->cosmetic_mark_1_img) {
                Storage::delete($qualityControl->cosmetic_mark_1_img);
            }

            $validated['cosmetic_mark_1_img'] = $request
                ->file('cosmetic_mark_1_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_2_img')) {
            if ($qualityControl->cosmetic_mark_2_img) {
                Storage::delete($qualityControl->cosmetic_mark_2_img);
            }

            $validated['cosmetic_mark_2_img'] = $request
                ->file('cosmetic_mark_2_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_3_img')) {
            if ($qualityControl->cosmetic_mark_3_img) {
                Storage::delete($qualityControl->cosmetic_mark_3_img);
            }

            $validated['cosmetic_mark_3_img'] = $request
                ->file('cosmetic_mark_3_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_4_img')) {
            if ($qualityControl->cosmetic_mark_4_img) {
                Storage::delete($qualityControl->cosmetic_mark_4_img);
            }

            $validated['cosmetic_mark_4_img'] = $request
                ->file('cosmetic_mark_4_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_5_img')) {
            if ($qualityControl->cosmetic_mark_5_img) {
                Storage::delete($qualityControl->cosmetic_mark_5_img);
            }

            $validated['cosmetic_mark_5_img'] = $request
                ->file('cosmetic_mark_5_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_6_img')) {
            if ($qualityControl->cosmetic_mark_6_img) {
                Storage::delete($qualityControl->cosmetic_mark_6_img);
            }

            $validated['cosmetic_mark_6_img'] = $request
                ->file('cosmetic_mark_6_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_7_img')) {
            if ($qualityControl->cosmetic_mark_7_img) {
                Storage::delete($qualityControl->cosmetic_mark_7_img);
            }

            $validated['cosmetic_mark_7_img'] = $request
                ->file('cosmetic_mark_7_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_8_img')) {
            if ($qualityControl->cosmetic_mark_8_img) {
                Storage::delete($qualityControl->cosmetic_mark_8_img);
            }

            $validated['cosmetic_mark_8_img'] = $request
                ->file('cosmetic_mark_8_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_9_img')) {
            if ($qualityControl->cosmetic_mark_9_img) {
                Storage::delete($qualityControl->cosmetic_mark_9_img);
            }

            $validated['cosmetic_mark_9_img'] = $request
                ->file('cosmetic_mark_9_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_10_img')) {
            if ($qualityControl->cosmetic_mark_10_img) {
                Storage::delete($qualityControl->cosmetic_mark_10_img);
            }

            $validated['cosmetic_mark_10_img'] = $request
                ->file('cosmetic_mark_10_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_11_img')) {
            if ($qualityControl->cosmetic_mark_11_img) {
                Storage::delete($qualityControl->cosmetic_mark_11_img);
            }

            $validated['cosmetic_mark_11_img'] = $request
                ->file('cosmetic_mark_11_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_12_img')) {
            if ($qualityControl->cosmetic_mark_12_img) {
                Storage::delete($qualityControl->cosmetic_mark_12_img);
            }

            $validated['cosmetic_mark_12_img'] = $request
                ->file('cosmetic_mark_12_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_13_img')) {
            if ($qualityControl->cosmetic_mark_13_img) {
                Storage::delete($qualityControl->cosmetic_mark_13_img);
            }

            $validated['cosmetic_mark_13_img'] = $request
                ->file('cosmetic_mark_13_img')
                ->store('public');
        }

        if ($request->hasFile('cosmetic_mark_14_img')) {
            if ($qualityControl->cosmetic_mark_14_img) {
                Storage::delete($qualityControl->cosmetic_mark_14_img);
            }

            $validated['cosmetic_mark_14_img'] = $request
                ->file('cosmetic_mark_14_img')
                ->store('public');
        }

        $qualityControl->update($validated);

        $action = Action::where('actionable_id', $qualityControl->id)->where('actionable_type', 'App\Models\QualityControl')->first();
        if($action)
        {
            $appliance = Appliance::find($action->appliance_id);
            $newAction = Action::firstOrCreate(
                [
                    'actionable_id' => $qualityControl->id,
                    'actionable_type' => 'App\Models\QualityControl'
                ],
                [
                    'actionable_id' => $qualityControl->id,
                    'actionable_type' => 'App\Models\QualityControl'
                ]
            );

            $newAction->appliance_id = $appliance->id;
            $newAction->actioned_by = Auth::user()->id;
            $newAction->save();

            switch ($request->input('action')) {
                case 'backToFault':
                    $appliance->Status = "test & repair";
                    $appliance->save();
                    break;
                case 'backToClean':
                    $appliance->Status = "cleaning";
                    $appliance->save();
                    break;
                case 'default':
                    $appliance->Status = "listing";
                    $appliance->save();
                    break;
            } 
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QualityControl $qualityControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, QualityControl $qualityControl)
    {
        $this->authorize('delete', $qualityControl);

        if ($qualityControl->cosmetic_mark_1_img) {
            Storage::delete($qualityControl->cosmetic_mark_1_img);
        }

        if ($qualityControl->cosmetic_mark_2_img) {
            Storage::delete($qualityControl->cosmetic_mark_2_img);
        }

        if ($qualityControl->cosmetic_mark_3_img) {
            Storage::delete($qualityControl->cosmetic_mark_3_img);
        }

        if ($qualityControl->cosmetic_mark_4_img) {
            Storage::delete($qualityControl->cosmetic_mark_4_img);
        }

        if ($qualityControl->cosmetic_mark_5_img) {
            Storage::delete($qualityControl->cosmetic_mark_5_img);
        }

        if ($qualityControl->cosmetic_mark_6_img) {
            Storage::delete($qualityControl->cosmetic_mark_6_img);
        }

        if ($qualityControl->cosmetic_mark_7_img) {
            Storage::delete($qualityControl->cosmetic_mark_7_img);
        }

        if ($qualityControl->cosmetic_mark_8_img) {
            Storage::delete($qualityControl->cosmetic_mark_8_img);
        }

        if ($qualityControl->cosmetic_mark_9_img) {
            Storage::delete($qualityControl->cosmetic_mark_9_img);
        }

        if ($qualityControl->cosmetic_mark_10_img) {
            Storage::delete($qualityControl->cosmetic_mark_10_img);
        }

        if ($qualityControl->cosmetic_mark_11_img) {
            Storage::delete($qualityControl->cosmetic_mark_11_img);
        }

        if ($qualityControl->cosmetic_mark_12_img) {
            Storage::delete($qualityControl->cosmetic_mark_12_img);
        }

        if ($qualityControl->cosmetic_mark_13_img) {
            Storage::delete($qualityControl->cosmetic_mark_13_img);
        }

        if ($qualityControl->cosmetic_mark_14_img) {
            Storage::delete($qualityControl->cosmetic_mark_14_img);
        }

        $qualityControl->delete();

        return redirect()
            ->route('quality-controls.index')
            ->withSuccess(__('crud.common.removed'));
    }    
}
