<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\ListingStoreRequest;
use App\Http\Requests\ListingUpdateRequest;

use App\Models\Appliance;
use App\Models\Action;
use Auth;
use Session;

class ListingController extends Controller
{
    
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Listing::class);

        $search = $request->get('search', '');

        $listings = Listing::search($search)
            ->latest()
            ->paginate(50);

        return view('app.listings.index', compact('listings', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Listing::class);

        $appliance_id = $request->appliance_id;
        if($appliance_id != null)
            session(['appliance_id' => $appliance_id]);

        $appliance = Appliance::find($appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.listings.create', compact('sac_num'));
    }

    /**
     * @param \App\Http\Requests\ListingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingStoreRequest $request)
    {
        $this->authorize('create', Listing::class);

        $validated = $request->validated();

        $listing = Listing::create($validated);

        $appliance_id = session('appliance_id');
        if($appliance_id != null)
        {
           $appliance = Appliance::find($appliance_id);
           Action::create([
            'actionable_id' => $listing->id,
            'actionable_type' => 'App\Models\Listing',
            'appliance_id' => $appliance->id,
            'actioned_by' => Auth::user()->id,
           ]);

           $appliance->Status = "costing";
           $appliance->save();
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Listing $listing)
    {
        $this->authorize('view', $listing);

        return view('app.listings.show', compact('listing'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Listing $listing)
    {
        $this->authorize('update', $listing);

        $action = Action::where('actionable_id', $listing->id)->where('actionable_type', 'App\Models\Listing')->first();
        $appliance = Appliance::find($action->appliance_id);
        $sac_num = $appliance->SACNo;

        return view('app.listings.edit', compact('listing', 'sac_num'));
    }

    /**
     * @param \App\Http\Requests\ListingUpdateRequest $request
     * @param \App\Models\Listing $listing
     * @return \Illuminate\Http\Response
     */
    public function update(
        ListingUpdateRequest $request,
        Listing $listing
    ) {
        $this->authorize('update', $listing);

        $validated = $request->validated();

        $listing->update($validated);

        $action = Action::where('actionable_id', $listing->id)->where('actionable_type', 'App\Models\Listing')->first();
        if($action)
        {
            $appliance = Appliance::find($action->appliance_id);
            $newAction = Action::firstOrCreate(
                [
                    'actionable_id' => $listing->id,
                    'actionable_type' => 'App\Models\Listing'
                ],
                [
                    'actionable_id' => $listing->id,
                    'actionable_type' => 'App\Models\Listing'
                ]
            );

            $newAction->appliance_id = $appliance->id;
            $newAction->actioned_by = Auth::user()->id;
            $newAction->save();

           $appliance->Status = "costing";
           $appliance->save();
        }

        return redirect()
            ->route('appliances.show', $appliance)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->delete();

        return redirect()
            ->route('listings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
