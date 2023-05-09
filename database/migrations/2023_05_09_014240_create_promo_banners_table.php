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
        Schema::create('promo_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('photo');
            $table->string('status', 20);
            $table->string('product_id')->nullable('true');
            $table->string('service_id')->nullable('true');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
        Schema::dropIfExists('promo_banners');
    }
};
