<?php

namespace App\Http\Controllers;

use App\Models\Cleaning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CleaningStoreRequest;
use App\Http\Requests\CleaningUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Auth;
use Session;
use \Datetime;

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
            ->paginate(50);

        return view('app.cleanings.index', compact('cleanings', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Cleaning::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);
        $sac_num = $appliance->SACNo;

        $started_at = DateTime::createFromFormat('m-d-Y H:i', date('m-d-Y H:i'));

        $old = $appliance->actionsByType('Cleaning');
        if($old)
        {
            $cleaning = Cleaning::find($old->actionable_id);
            $started_at = $cleaning->time_started;
        }

        return view('app.cleanings.create', compact('sac_num', 'started_at'));
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

        $cleaning = Cleaning::create($validated);

        $appliance_id = session('appliance_id');
        if($appliance_id != null)
        {
           $appliance = Appliance::find($appliance_id);
           Action::create([
            'actionable_id' => $cleaning->id,
            'actionable_type' => 'App\Models\Cleaning',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
           ]);

           $appliance->Status = "quality control";
           $appliance->save();
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cleaning $cleaning
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cleaning $cleaning)
    {
        $this->authorize('view', $cleaning);

        return view('app.cleanings.show', compact('cleaning'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cleaning $cleaning
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Cleaning $cleaning)
    {
        $this->authorize('update', $cleaning);

        $action = Action::where('actionable_id', $cleaning->id)->where('actionable_type', 'App\Models\Cleaning')->first();
        $appliance = Appliance::find($action->appliance_id);
        $sac_num = $appliance->SACNo;

        $started_at = DateTime::createFromFormat('m-d-Y H:i', date('m-d-Y H:i'));

        $old = $appliance->actionsByType('Cleaning');
        if($old)
        {
            $cleaning = Cleaning::find($old->actionable_id);
            $started_at = $cleaning->time_started;
        }

        return view('app.cleanings.edit', compact('cleaning', 'sac_num'));
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

        $cleaning->update($validated);

        $action = Action::where('actionable_id', $cleaning->id)->where('actionable_type', 'App\Models\Cleaning')->first();
        if($action)
        {
            $appliance = Appliance::find($action->appliance_id);
            $newAction = Action::firstOrCreate(
                [
                    'actionable_id' => $cleaning->id,
                    'actionable_type' => 'App\Models\Cleaning'
                ],
                [
                    'actionable_id' => $cleaning->id,
                    'actionable_type' => 'App\Models\Cleaning'
                ]
            );

            $newAction->appliance_id = $appliance->id;
            $newAction->actioned_by = Auth::user()->id;
            $newAction->save();

            $appliance->Status = "quality control";
            $appliance->save();
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.saved'));
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

        $cleaning->delete();

        return redirect()
            ->route('cleanings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
