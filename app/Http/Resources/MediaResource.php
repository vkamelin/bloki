<?php

namespace App\Http\Resources;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Media */
class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'media',
            'id' => $this->id,
            'uuid' => $this->uuid,
            'path' => $this->path,
            'original_name' => $this->original_name,
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            'alt_text' => $this->alt_text,
            'caption' => $this->caption,
            'transforms' => $this->transforms,
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
                'self' => route('api.media.show', $this->resource),
                'download' => route('api.media.download', $this->resource),
                'entries' => route('api.entries.index', ['media' => $this->resource])
            ]
        ];
    }
}
