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
        Schema::create('order_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedInteger('total_price')->default(0);
            $table->boolean('is_checkout')->default(true);
            $table->string('material', 20)->nullable(true);
            $table->string('custom_design')->nullable(true);
            $table->date('deadline')->default(DB::raw('DATE_ADD(CURRENT_DATE, INTERVAL 7 DAY)'));
            $table->string('service_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
        Schema::dropIfExists('order_services');
    }
};
