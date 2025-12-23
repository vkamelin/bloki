<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldRequest;
use App\Http\Resources\FieldResource;
use App\Models\Field;

class FieldController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Field::class);

        return FieldResource::collection(Field::all());
    }

    public function store(FieldRequest $request)
    {
        $this->authorize('create', Field::class);

        return new FieldResource(Field::create($request->validated()));
    }

    public function show(Field $field)
    {
        $this->authorize('view', $field);

        return new FieldResource($field);
    }

    public function update(FieldRequest $request, Field $field)
    {
        $this->authorize('update', $field);

        $field->update($request->validated());

        return new FieldResource($field);
    }

    public function destroy(Field $field)
    {
        $this->authorize('delete', $field);

        $field->delete();

        return response()->json();
    }
}
