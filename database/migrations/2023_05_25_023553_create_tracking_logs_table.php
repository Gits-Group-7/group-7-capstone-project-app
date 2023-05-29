<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('tracking_logs', function (Blueprint $table) {
            $table->id();
            $table->string('location')->nullable(true)->default('Sistem');
            $table->text('note')->nullable(true);
            $table->string('status', 30)->nullable(false);
            $table->string('is_complete', 20)->default('No')->nullable(false);
            $table->string('transaction_order_id');
            $table->foreign('transaction_order_id')->references('id')->on('transaction_orders')->onDelete('cascade');
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
        Schema::dropIfExists('tracking_logs');
    }
};
