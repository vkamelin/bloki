<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldGroupRequest;
use App\Http\Resources\FieldGroupResource;
use App\Models\FieldGroup;

class FieldGroupController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', FieldGroup::class);

        return FieldGroupResource::collection(FieldGroup::all());
    }

    public function store(FieldGroupRequest $request)
    {
        $this->authorize('create', FieldGroup::class);

        return new FieldGroupResource(FieldGroup::create($request->validated()));
    }

    public function show(FieldGroup $fieldGroup)
    {
        $this->authorize('view', $fieldGroup);

        return new FieldGroupResource($fieldGroup);
    }

    public function update(FieldGroupRequest $request, FieldGroup $fieldGroup)
    {
        $this->authorize('update', $fieldGroup);

        $fieldGroup->update($request->validated());

        return new FieldGroupResource($fieldGroup);
    }

    public function destroy(FieldGroup $fieldGroup)
    {
        $this->authorize('delete', $fieldGroup);

        $fieldGroup->delete();

        return response()->json();
    }
}
