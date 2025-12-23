<?php

namespace App\Http\Resources;

use App\Models\FieldValue;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin FieldValue */
class FieldValueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'entity_type' => $this->entity_type,
            'entity_id' => $this->entity_id,
            'value_type' => $this->value_type,
            'value_string' => $this->value_string,
            'value_text' => $this->value_text,
            'value_int' => $this->value_int,
            'value_float' => $this->value_float,
            'value_bool' => $this->value_bool,
            'value_json' => $this->value_json,
            'value_date' => $this->value_date,
            'value_datetime' => $this->value_datetime,
            'locale' => $this->locale,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'field_id' => $this->field_id,

            'field' => new FieldResource($this->whenLoaded('field')),
        ];
    }
}
