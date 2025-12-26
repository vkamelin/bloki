<?php

namespace App\Http\Resources;

use App\Models\Revision;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Revision */
class RevisionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'revision',
            'id' => $this->id,
            'entry_type' => $this->entry_type,
            'entry_id' => $this->entry_id,
            'data' => $this->data,
            'timestamp' => $this->timestamp,
            'note' => $this->note,

            'created_by' => $this->created_by,

            'createdBy' => new AdminResource($this->whenLoaded('createdBy')),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'permissions' => [
                    'view' => $request->user()?->can('view', $this->resource),
                    'delete' => $request->user()?->can('delete', $this->resource),
                ]
            ]
        ];
    }

    public function additional(array $data = []): array
    {
        return [
            'links' => [
                'self' => route('api.revisions.show', $this->resource),
                'entry' => route('api.entries.show', $this->entry_id),
                'compare' => route('api.revisions.compare', $this->resource)
            ]
        ];
    }
}
