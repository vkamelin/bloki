<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevisionRequest;
use App\Http\Resources\RevisionResource;
use App\Models\Revision;

class RevisionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Revision::class);

        return RevisionResource::collection(Revision::all());
    }

    public function store(RevisionRequest $request)
    {
        $this->authorize('create', Revision::class);

        return new RevisionResource(Revision::create($request->validated()));
    }

    public function show(Revision $revision)
    {
        $this->authorize('view', $revision);

        return new RevisionResource($revision);
    }

    public function update(RevisionRequest $request, Revision $revision)
    {
        $this->authorize('update', $revision);

        $revision->update($request->validated());

        return new RevisionResource($revision);
    }

    public function destroy(Revision $revision)
    {
        $this->authorize('delete', $revision);

        $revision->delete();

        return response()->json();
    }
}
