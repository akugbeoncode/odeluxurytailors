<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public static function generateProductCode() {
        $is_valid_product_code = false;
        $product_code = '';
        while(!$is_valid_product_code) {
            $product_code = static::createProductCode();
            $product = static::where('code', $product_code)->first();
            if (!$product) {
                $is_valid_product_code = true;
            }
        }
        return $product_code;
    }

    public static function createProductCode() {
        return rand();
    }

    public function brand() {
        return $this->belongsTo(Brand::class, "brand_id", "id");
    }

    public function category() {
        return $this->belongsTo(Category::class, "category_id", "id");
    }

    public function unit() {
        return $this->belongsTo(Unit::class, "unit_id", "id");
    }

    public function sales_unit() {
        return $this->belongsTo(Unit::class, "sale_unit_id", "id");
    }

    public function purchase_unit() {
        return $this->belongsTo(Unit::class, "purchase_unit_id", "id");
    }
}
