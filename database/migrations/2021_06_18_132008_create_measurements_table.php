<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->string('head_size');
            $table->string('agbada_shoulder');
            $table->string('aghada_length');
            $table->string('shoulder');
            $table->string('chest');
            $table->string('neck');
            $table->string('round_sleeve');
            $table->string('sleeve_length');
            $table->string('forearm');
            $table->string('cloth_length');
            $table->string('cuff_wrist');
            $table->string('tommy');
            $table->string('waist');
            $table->string('seat');
            $table->string('laps_thigh');
            $table->string('knee');
            $table->string('calf');
            $table->string('trouser_length');
            $table->string('trouser_base');
            $table->timestamps();

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
        Schema::dropIfExists('measurements');
    }
}
