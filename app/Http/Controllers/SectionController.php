<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Section::class);

        return SectionResource::collection(Section::all());
    }

    public function store(SectionRequest $request)
    {
        $this->authorize('create', Section::class);

        return new SectionResource(Section::create($request->validated()));
    }

    public function show(Section $section)
    {
        $this->authorize('view', $section);

        return new SectionResource($section);
    }

    public function update(SectionRequest $request, Section $section)
    {
        $this->authorize('update', $section);

        $section->update($request->validated());

        return new SectionResource($section);
    }

    public function destroy(Section $section)
    {
        $this->authorize('delete', $section);

        $section->delete();

        return response()->json();
    }
}
