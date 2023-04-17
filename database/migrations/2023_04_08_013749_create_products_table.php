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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('category_id');
            $table->string('name', 255)->nullable(false);
            $table->string('photo', 255)->nullable(false);
            $table->unsignedInteger('price')->nullable(false);
            $table->unsignedInteger('stock')->nullable(false);
            $table->text('description')->nullable(true);
            $table->unsignedInteger('warranty')->nullable(false);
            $table->string('condition', 20)->nullable(false);
            $table->string('status', 20)->nullable(false);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
};
