<?php

namespace App\Http\Controllers;

use App\Models\Appliance;
use Illuminate\Http\Request;
use App\Http\Requests\ApplianceStoreRequest;
use App\Http\Requests\ApplianceUpdateRequest;

use App\Imports\AppliancesImport;
use Maatwebsite\Excel\Validators\ValidationException;
use Session;
use Auth;

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

        $appliances = null;
        if(Auth::user()->hasRole("Warehouse")) {
            $appliances = Appliance::where('Status', '=', 'pending')
                ->orWhere('Status', '=', 'checked in')
                ->search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        } else if(Auth::user()->hasRole("Engineering")) {
            $appliances = Appliance::where('Status', '=', 'checked in')
                ->orWhere('Status', '=', 'test & repair')
                ->search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        } else if(Auth::user()->hasRole("Cleaning")) {
            $appliances = Appliance::where('Status', '=', 'test & repair')
                ->orWhere('Status', '=', 'cleaning')
                ->search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        } else if(Auth::user()->hasRole("QualityControl")) {
            $appliances = Appliance::where('Status', '=', 'cleaning')
                ->orWhere('Status', '=', 'quality control')
                ->search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        } else if(Auth::user()->hasRole("Admin")) {
            $appliances = Appliance::search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        }

        return view('app.appliances.index', compact('appliances', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Appliance::class);

        return view('app.appliances.create');
    }

    /**
     * @param \App\Http\Requests\ApplianceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApplianceStoreRequest $request)
    {
        $this->authorize('create', Appliance::class);

        $validated = $request->validated();
        if(!$validated['SerialNum'])
            $validated['SerialNum'] = '00000000';

        $appliance = Appliance::create($validated);

        return redirect()
            ->route('appliances.edit', $appliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appliance $appliance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Appliance $appliance)
    {
        $this->authorize('view', $appliance);
        
        return view('app.appliances.show', compact('appliance'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Appliance $appliance
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Appliance $appliance)
    {
        $this->authorize('update', $appliance);

        return view('app.appliances.edit', compact('appliance'));
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

        return redirect()
            ->route('appliances.edit', $appliance)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('appliances.index')
            ->withSuccess(__('crud.common.removed'));
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        if(!$request->import_file){
            Session::flash('message', "File not selected!");
            return redirect()->back();
        }
        try {

            \Excel::import(new AppliancesImport,$request->import_file);

        } catch(ValidationException $e)
        {
            $failure = $e->failures();
            $errors = $failure[0]->errors();
            Session::flash('message', $errors[0]);

            return redirect()->back();
        }

        return redirect()
            ->route('appliances.index')
            ->withSuccess(__('crud.appliances.imported'));
    }

    public function importView(Request $request)
    {
        return view('app.appliances.import');
    }

    public function dashboard(Request $request)
    {
        $search = $request->get('search', '');
        
        $appliances = null;
        if(Auth::user()->hasRole("Warehouse")) {
            $appliances = Appliance::where('Status', '=', 'pending')
                ->orWhere('Status', '=', 'checked in')
                ->search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        } else if(Auth::user()->hasRole("Engineering")) {
            $appliances = Appliance::where('Status', '=', 'checked in')
                ->orWhere('Status', '=', 'test & repair')
                ->search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        } else if(Auth::user()->hasRole("Cleaning")) {
            $appliances = Appliance::where('Status', '=', 'test & repair')
                ->orWhere('Status', '=', 'cleaning')
                ->search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        } else if(Auth::user()->hasRole("QualityControl")) {
            $appliances = Appliance::where('Status', '=', 'cleaning')
                ->orWhere('Status', '=', 'quality control')
                ->search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        } else if(Auth::user()->hasRole("Admin")) {
            $appliances = Appliance::search($search)
                ->orderByDesc('updated_at')
                ->paginate(50);
        }

        return view('dashboard', compact('appliances', 'search'));
    }

    public function qrScan(Request $request)
    {
        $sacNo = $request->uuid;
        $appliance = Appliance::where('SACNo', '=', $sacNo)->first();
        return view('app.appliances.show', compact('appliance'));
    }

    public function viewQr(Request $request)
    {
        $sacNo = $request->uuid;
        $appliance = Appliance::where('SACNo', '=', $sacNo)->first();
        return view('app.appliances.view-qr', compact('appliance'));
    }    

    
}
