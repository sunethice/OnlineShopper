<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->string('color', 50)->comment('product color');
            $table->double('weight')->comment('product weight');
            $table->double('price')->comment('product price');
            $table->double('cost')->comment('product cost');
            $table->unsignedInteger('stock')->default(0)->comment('product stocks');
            $table->string('product_name', 100)->comment('product name');
            $table->string('description', 200)->comment('product description');
            $table->string('imageurl', 200)->comment('product image url');
            $table->timestamps();
            $table->softDeletes();
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
}
