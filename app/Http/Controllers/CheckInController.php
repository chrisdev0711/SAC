<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CheckInStoreRequest;
use App\Http\Requests\CheckInUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
use Session;

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

        $checkIns = CheckIn::all();
        
        if($search)
        {
            $checkIns = $checkIns->filter(function($checkIn) use($search) {
                if(stripos($checkIn->serial_num, $search) !== false || stripos($checkIn->condition, $search) !== false)
                    return true;
                if(stripos($checkIn->sacNo(), $search) !== false)
                    return true;

                return false;
            });
        }
        
        $checkIns = $checkIns->sortByDesc('updated_at');
        $checkIns = $this->paginate($checkIns);

        return view('app.check_ins.index', compact('checkIns', 'search'));
    }

    public function paginate($items, $perPage = 50, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', CheckIn::class);

        $appliance_id = $request->appliance_id;
        $serial_number = '00000000';
        $sac_num = null;
        $location = null;
        if($appliance_id)
        {
            $appliance = Appliance::find($appliance_id);
            if($appliance->SerialNum){
            //     Session::flash('message', "Serial Number Empty, Please fill it first");
            //     return redirect()
            //         ->route('appliances.edit', $appliance);
            // } else {
                $serial_number = $appliance->SerialNum;
            }

            $sac_num = $appliance->SACNo;
            $location = $appliance->Location;
        }

        return view('app.check_ins.create', compact('serial_number', 'sac_num', 'location'));
    }

    /**
     * @param \App\Http\Requests\CheckInStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckInStoreRequest $request)
    {
        $this->authorize('create', CheckIn::class);
        $validated = $request->validated();

        $appliance_in_img = null;
        $data_badge_img = null;
        $serial_num = $validated['serial_num'];
        $condition = $validated['condition'];

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

        $checkIn = CheckIn::create([
            'appliance_in_img' => $appliance_in_img,
            'data_badge_img' => $data_badge_img,
            'serial_num' => $serial_num,
            'condition' => $condition,
        ]);

        $sac_num = $validated['sac_num'];
        $appliance = Appliance::where('SACNo', $sac_num)->first();
        Action::create([
            'actionable_id' => $checkIn->id,
            'actionable_type' => 'App\Models\CheckIn',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
        ]);

        if($validated['Location'])
            $appliance->Location = $validated['Location'];
        if($serial_num)
            $appliance->SerialNum = $serial_num;
        $appliance->Status = "checked in";
        $appliance->save();
        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CheckIn $checkIn
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CheckIn $checkIn)
    {
        $this->authorize('view', $checkIn);

        $serial_number = $checkIn->serial_num;

        return view('app.check_ins.show', compact('checkIn', 'serial_number'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CheckIn $checkIn
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CheckIn $checkIn)
    {
        $this->authorize('update', $checkIn);

        $appliance = Appliance::where('SerialNum', $checkIn->serial_num)->first();
        $sac_num = $appliance->SACNo;

        return view('app.check_ins.edit', compact('checkIn', 'sac_num'));
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

        $appliance_in_img = null;
        $data_badge_img = null;
        $serial_num = $validated['serial_num'];
        $condition = $validated['condition'];

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

        $checkIn->update([
            'appliance_in_img' => $appliance_in_img,
            'data_badge_img' => $data_badge_img,
            'serial_num' => $serial_num,
            'condition' => $condition,
        ]);

        $sac_num = $validated['sac_num'];
        $appliance = Appliance::where('SACNo', $sac_num)->first();
        $newAction = Action::firstOrCreate(
            [
                'actionable_id' => $checkIn->id,
                'actionable_type' => 'App\Models\CheckIn'
            ],
            [
                'actionable_id' => $checkIn->id,
                'actionable_type' => 'App\Models\CheckIn'
            ]
        );
        $newAction->appliance_id = $appliance->id;
        $newAction->actioned_by = Auth::user()->id;
        $newAction->save();

        if($validated['Location'])
            $appliance->Location = $validated['Location'];
        $appliance->Status = "checked in";
        $appliance->save();

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.saved'));
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

        $checkIn->delete();

        return redirect()
            ->route('check-ins.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
