<?php

namespace App\Http\Resources;

use App\Models\FieldGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin FieldGroup */
class FieldGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'type' => 'field-group',
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'description' => $this->description,
            'is_global' => $this->is_global,
            'rules' => $this->rules,
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
                'self' => route('api.field-groups.show', $this->resource),
                'fields' => route('api.fields.index', ['group' => $this->resource])
            ]
        ];
    }
}
