<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldRequest;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use App\Services\Dashboard\FieldConfiguration;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    protected $fieldConfig;
    
    public function __construct()
    {
        $this->fieldConfig = new FieldConfiguration();
    }

    public function index()
    {
        $this->authorize('viewAny', Field::class);

        return FieldResource::collection(Field::all());
    }

    public function store(FieldRequest $request)
    {
        $this->authorize('create', Field::class);

        $field = Field::create($request->validated());
        
        // Add field type configuration to the response
        $field->load('group');
        $field->type_config = $this->fieldConfig->getFieldType($field->type);
        
        return new FieldResource($field);
    }

    public function show(Field $field)
    {
        $this->authorize('view', $field);

        // Add field type configuration to the response
        $field->load('group');
        $field->type_config = $this->fieldConfig->getFieldType($field->type);
        
        return new FieldResource($field);
    }

    public function update(FieldRequest $request, Field $field)
    {
        $this->authorize('update', $field);

        $field->update($request->validated());
        
        // Add field type configuration to the response
        $field->load('group');
        $field->type_config = $this->fieldConfig->getFieldType($field->type);

        return new FieldResource($field);
    }

    public function destroy(Field $field)
    {
        $this->authorize('delete', $field);

        $field->delete();

        return response()->json();
    }
    
    public function getFieldTypes()
    {
        return response()->json($this->fieldConfig->getFieldTypes());
    }
}
