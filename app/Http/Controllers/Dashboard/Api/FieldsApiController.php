<?php

namespace App\Http\Controllers\Dashboard\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use App\Services\Dashboard\FieldConfiguration;
use Illuminate\Http\Request;

class FieldsApiController extends Controller
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

    public function store(Request $request)
    {
        $this->authorize('create', Field::class);
        
        $field = Field::create($request->all());
        
        return new FieldResource($field);
    }

    public function show(Field $field)
    {
        $this->authorize('view', $field);
        
        return new FieldResource($field);
    }

    public function update(Request $request, Field $field)
    {
        $this->authorize('update', $field);
        
        $field->update($request->all());
        
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