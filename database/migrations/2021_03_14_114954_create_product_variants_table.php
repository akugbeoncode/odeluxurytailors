<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("image");
            $table->integer("brand_id");
            $table->integer("category_id");
            $table->integer("unit_id");
            $table->integer("quantity");
            $table->decimal("unit_price", 10, 2);
            $table->integer("available");
            $table->integer("sold");
            $table->integer("defective");
            $table->uuid("created_by");
            $table->uuid("updated_by");
            $table->timestamps();

            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
