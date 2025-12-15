<?php

namespace App\Http\Resources;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Entry */
class EntryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'slug' => $this->slug,
            'name' => $this->name,
            'title' => $this->title,
            'status' => $this->status,
            'published_at' => $this->published_at,
            'meta' => $this->meta,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'collection_id' => $this->collection_id,
            'cteated_by' => $this->cteated_by,
            'updated_by' => $this->updated_by,

            'collection' => new CollectionResource($this->whenLoaded('collection')),
            'cteatedBy' => new AdminResource($this->whenLoaded('cteatedBy')),
            'updatedBy' => new AdminResource($this->whenLoaded('updatedBy')),
        ];
    }
}
