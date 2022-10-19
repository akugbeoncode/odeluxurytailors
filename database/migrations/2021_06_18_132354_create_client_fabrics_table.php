<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class CreateClientFabricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_fabrics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo');
            $table->timestamps();

            $table->uuid('client_id')->index();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->foreignId('transaction_fabric_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_fabrics');
    }
}
