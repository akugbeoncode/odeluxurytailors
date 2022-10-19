<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("generic_name")->nullable();
            $table->string("code");
            $table->text("product_meta")->nullable();
            $table->text("product_details")->nullable();
            $table->bigInteger("quantity_alert")->default(0);
            $table->bigInteger("quantity")->default(0);
            $table->tinyInteger("has_inventory")->default(0);
            $table->tinyInteger("is_active")->default(0);
            $table->bigInteger('purchase_unit_id')->unsigned()->index();
            $table->bigInteger('sale_unit_id')->unsigned()->index();

            $table->decimal("unit_cost", 10, 2)->default(0);
            $table->decimal("unit_price", 10, 2)->default(0);
            
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');
            $table->foreign('purchase_unit_id')->references('id')->on('units');
            $table->foreign('sale_unit_id')->references('id')->on('units');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
