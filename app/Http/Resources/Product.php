<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "generic_name" => $this->generic_name,
            "code" => $this->code,
            "category_id" => $this->category_id,
            "brand_id" => $this->brand_id,
            "unit_id" => $this->unit_id,
            "purchase_unit_id" => $this->purchase_unit_id,
            "sale_unit_id" => $this->sale_unit_id,
            "has_inventory" => $this->has_inventory,
            "is_active" => $this->is_active,
            "quantity" => $this->quantity,
            "quantity_alert" => $this->quantity_alert,
            "product_meta" => $this->product_meta,
            "product_details" => $this->product_details,
            "unit_cost" => $this->unit_cost,
            "unit_price" => $this->unit_price,
            "brand" => $this->brand,
            "category" => $this->category,
            "unit" => $this->unit,
            "sales_unit" => $this->sales_unit,
            "purchase_unit" => $this->purchase_unit,
            "created_by" => $this->created_by,
            "updated_by" => $this->updated_by,
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0'
        ];
    }
}
