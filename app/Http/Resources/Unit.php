<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Unit extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "code" => $this->code,
            "name" => $this->name,
            "base_unit" => $this->base_unit,
            "operator" => $this->operator,
            "operational_value" => $this->operational_value,
            'description' => $this->description,
            "is_active" => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
