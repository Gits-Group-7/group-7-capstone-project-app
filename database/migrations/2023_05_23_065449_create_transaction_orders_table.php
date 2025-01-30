<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_orders', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('snap_token', 255)->nullable(false);
            $table->timestamp('order_date')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable(false);
            $table->text('order_address')->nullable(false);
            $table->text('order_note')->nullable(true);
            $table->string('type_transaction_order', 10)->nullable(false);
            $table->string('prof_order_payment')->nullable(false)->default('empty');
            $table->string('order_confirmed', 20)->nullable(false)->default('No');
            $table->unsignedInteger('delivery_price')->nullable(false)->default(0);
            $table->unsignedInteger('total_price_transaction_order')->nullable(false)->default(0);
            $table->string('track_delivery_location', 100)->nullable(true);
            $table->string('status_delivery', 30)->nullable(false);
            $table->string('delivery_complete', 20)->nullable(false)->default("No");
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('transaction_orders');
    }
};
