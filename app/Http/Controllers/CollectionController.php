<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionRequest;
use App\Http\Resources\CollectionResource;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Collection::class);

        return CollectionResource::collection(Collection::all());
    }

    public function store(CollectionRequest $request)
    {
        $this->authorize('create', Collection::class);

        return new CollectionResource(Collection::create($request->validated()));
    }

    public function show(Collection $collection)
    {
        $this->authorize('view', $collection);

        return new CollectionResource($collection);
    }

    public function update(CollectionRequest $request, Collection $collection)
    {
        $this->authorize('update', $collection);

        $collection->update($request->validated());

        return new CollectionResource($collection);
    }

    public function destroy(Collection $collection)
    {
        $this->authorize('delete', $collection);

        $collection->delete();

        return response()->json();
    }
}
