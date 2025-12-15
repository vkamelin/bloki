<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Http\Resources\EntryResource;
use App\Models\Entry;

class EntryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Entry::class);

        return EntryResource::collection(Entry::all());
    }

    public function store(EntryRequest $request)
    {
        $this->authorize('create', Entry::class);

        return new EntryResource(Entry::create($request->validated()));
    }

    public function show(Entry $entry)
    {
        $this->authorize('view', $entry);

        return new EntryResource($entry);
    }

    public function update(EntryRequest $request, Entry $entry)
    {
        $this->authorize('update', $entry);

        $entry->update($request->validated());

        return new EntryResource($entry);
    }

    public function destroy(Entry $entry)
    {
        $this->authorize('delete', $entry);

        $entry->delete();

        return response()->json();
    }
}
