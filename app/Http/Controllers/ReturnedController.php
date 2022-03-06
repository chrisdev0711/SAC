<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReturnedStoreRequest;
use App\Http\Requests\ReturnedUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use App\Models\Returned;
use Auth;
use Session;

class ReturnedController extends Controller
{        
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Returned::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);
        return view('app.returned.create',compact('appliance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'returned_on' => ['required', 'date'],
            'returned_reason' => ['required', 'max:255', 'string'],
        ]);
        $appliance_id = $request->appliance_id;
      
        $returned = Returned::create($validated);

        $appliance_id = session('appliance_id');
        Action::create([
            'actionable_id' => $returned->id,
            'actionable_type' => 'App\Models\Returned',
            'appliance_id' => $appliance_id,
            'actioned_by' => Auth::user()->id,
        ]);

        if($appliance_id != null)
        {
           $appliance = Appliance::find($appliance_id);
           Action::create([
            'actionable_id' => $returned->id,
            'actionable_type' => 'App\Models\Returned',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
           ]);

           $appliance->Status = "test & repair";
           $appliance->save();
        }
        return redirect()
            ->route('appliances.index')
            ->withSuccess(__('crud.appliances.returned'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
