<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id', 8);
                $table->foreign('order_id')
                        ->references('id')
                        ->on('orders')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
                        
            $table->string('variation_id', 8)->nullable();
                $table->foreign('variation_id')
                        ->references('id')
                        ->on('product_variations')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->integer('count')->unsigned();
            $table->bigInteger('price')->unsigned()->default(0);
            $table->bigInteger('offer')->unsigned()->default(0);
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
        Schema::dropIfExists('order_products');
    }
}
