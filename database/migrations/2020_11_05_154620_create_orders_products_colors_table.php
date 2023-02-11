<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProductsColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_product_id');
            $table->string('color');
            $table->decimal('product_price', 9, 3)->nullable();
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
        Schema::dropIfExists('orders_products_colors');
    }
}
