<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Admin */
class AdminResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'role_id' => $this->role_id,
            'role' => $this->whenLoaded('role'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
