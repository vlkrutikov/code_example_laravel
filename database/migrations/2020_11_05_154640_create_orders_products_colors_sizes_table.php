<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProductsColorsSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products_colors_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_product_color_id');
            $table->unsignedInteger('size_id')->nullable();
            $table->unsignedInteger('product_count');
            $table->timestamps();

            $table->foreign('order_product_color_id')->references('id')->on('orders_products_colors')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_products_colors_sizes');
    }
}
