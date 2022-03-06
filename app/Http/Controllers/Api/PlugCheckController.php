<?php

namespace App\Http\Controllers\Api;

use App\Models\PlugCheck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlugCheckResource;
use App\Http\Resources\PlugCheckCollection;
use App\Http\Requests\PlugCheckStoreRequest;
use App\Http\Requests\PlugCheckUpdateRequest;

class PlugCheckController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PlugCheck::class);

        $search = $request->get('search', '');

        $plugChecks = PlugCheck::search($search)
            ->latest()
            ->paginate();

        return new PlugCheckCollection($plugChecks);
    }

    /**
     * @param \App\Http\Requests\PlugCheckStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlugCheckStoreRequest $request)
    {
        $this->authorize('create', PlugCheck::class);

        $validated = $request->validated();

        $plugCheck = PlugCheck::create($validated);

        return new PlugCheckResource($plugCheck);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PlugCheck $plugCheck
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PlugCheck $plugCheck)
    {
        $this->authorize('view', $plugCheck);

        return new PlugCheckResource($plugCheck);
    }

    /**
     * @param \App\Http\Requests\PlugCheckUpdateRequest $request
     * @param \App\Models\PlugCheck $plugCheck
     * @return \Illuminate\Http\Response
     */
    public function update(
        PlugCheckUpdateRequest $request,
        PlugCheck $plugCheck
    ) {
        $this->authorize('update', $plugCheck);

        $validated = $request->validated();

        $plugCheck->update($validated);

        return new PlugCheckResource($plugCheck);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PlugCheck $plugCheck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PlugCheck $plugCheck)
    {
        $this->authorize('delete', $plugCheck);

        $plugCheck->delete();

        return response()->noContent();
    }
}
