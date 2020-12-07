<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_entry');
            $table->string('order_id');
            $table->unsignedInteger('product_id');
            $table->bigInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
