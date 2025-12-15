<?php

namespace App\Http\Resources;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Section */
class SectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'slug' => $this->slug,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'meta' => $this->meta,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'collection_id' => $this->collection_id,
            'parent_id' => $this->parent_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,

            'collection' => new CollectionResource($this->whenLoaded('collection')),
            'parent' => new SectionResource($this->whenLoaded('parent')),
            'createdBy' => new AdminResource($this->whenLoaded('createdBy')),
            'updatedBy' => new AdminResource($this->whenLoaded('updatedBy')),
        ];
    }
}
