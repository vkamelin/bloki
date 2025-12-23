<?php

namespace App\Http\Resources;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Field */
class FieldResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'description' => $this->description,
            'instructions' => $this->instructions,
            'type' => $this->type,
            'settings' => $this->settings,
            'required' => $this->required,
            'validation_rules' => $this->validation_rules,
            'list_visibility' => $this->list_visibility,
            'translatable' => $this->translatable,
            'searchable' => $this->searchable,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'group_id' => $this->group_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,

            'group' => new FieldGroupResource($this->whenLoaded('group')),
            'createdBy' => new AdminResource($this->whenLoaded('createdBy')),
            'updatedBy' => new AdminResource($this->whenLoaded('updatedBy')),
        ];
    }
}
