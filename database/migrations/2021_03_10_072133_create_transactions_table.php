<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('pickup_date');
            $table->date('actual_pickup_date');
            $table->decimal('brought_forward', 10, 2);
            $table->decimal('order_total', 10, 2);
            $table->decimal('vat', 10, 2);
            $table->decimal('total', 10, 2);
            $table->decimal('deposit', 10, 2);
            $table->timestamps();

            $table->uuid('client_id')->index();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->uuid('registered_by')->index();
            $table->foreign('registered_by')->references('id')->on('users')->onDelete('cascade');

            $table->foreignId('status_id')->constrained()->onDelete('cascade');

            $table->foreignId('transaction_type_id')->constrained()->onDelete('cascade');

            $table->foreignId('pickup_status_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
