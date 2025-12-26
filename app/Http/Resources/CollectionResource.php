<?php

namespace App\Http\Resources;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Collection */
class CollectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'collection',
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'icon' => $this->icon,
            'has_sections' => $this->has_sections,
            'section_structure' => $this->section_structure,
            'entry_behavior' => $this->entry_behavior,
            'is_singleton' => $this->is_singleton,
            'full_text_search' => $this->full_text_search,
            'default_template_section' => $this->default_template_section,
            'default_template_entry' => $this->default_template_entry,
            'route_patterns' => $this->route_patterns,
            'api_visibility' => $this->api_visibility,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,

            'createdBy' => new AdminResource($this->whenLoaded('createdBy')),
            'updatedBy' => new AdminResource($this->whenLoaded('updatedBy')),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'permissions' => [
                    'view' => $request->user()?->can('view', $this->resource),
                    'update' => $request->user()?->can('update', $this->resource),
                    'delete' => $request->user()?->can('delete', $this->resource),
                ]
            ]
        ];
    }

    public function additional(array $data = []): array
    {
        return [
            'links' => [
                'self' => route('api.collections.show', $this->resource),
                'entries' => route('api.entries.index', ['collection' => $this->resource]),
                'sections' => route('api.sections.index', ['collection' => $this->resource])
            ]
        ];
    }
}
