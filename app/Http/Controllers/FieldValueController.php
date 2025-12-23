<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldValueRequest;
use App\Http\Resources\FieldValueResource;
use App\Models\FieldValue;

class FieldValueController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', FieldValue::class);

        return FieldValueResource::collection(FieldValue::all());
    }

    public function store(FieldValueRequest $request)
    {
        $this->authorize('create', FieldValue::class);

        return new FieldValueResource(FieldValue::create($request->validated()));
    }

    public function show(FieldValue $fieldValue)
    {
        $this->authorize('view', $fieldValue);

        return new FieldValueResource($fieldValue);
    }

    public function update(FieldValueRequest $request, FieldValue $fieldValue)
    {
        $this->authorize('update', $fieldValue);

        $fieldValue->update($request->validated());

        return new FieldValueResource($fieldValue);
    }

    public function destroy(FieldValue $fieldValue)
    {
        $this->authorize('delete', $fieldValue);

        $fieldValue->delete();

        return response()->json();
    }
}
