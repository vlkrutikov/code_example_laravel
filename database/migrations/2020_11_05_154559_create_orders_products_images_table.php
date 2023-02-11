<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProductsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_product_id');
            $table->string('image');
            $table->timestamps();

            $table->foreign('order_product_id')->references('id')->on('orders_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_products_images');
    }
}
