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
}
