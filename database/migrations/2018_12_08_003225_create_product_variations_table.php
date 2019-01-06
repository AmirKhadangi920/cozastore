<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->string('id', 8);
            $table->primary('id');
            $table->string('product_id', 8);
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedInteger('warranty_id')->nullable();
                $table->foreign('warranty_id')
                    ->references('id')
                    ->on('warranties')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedInteger('color_id')->nullable();
                $table->foreign('color_id')
                    ->references('id')
                    ->on('colors')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->integer('price');
            $table->tinyInteger('unit')->default(1);
            $table->integer('offer')->nullable();
            $table->timestamp('offer_deadline')->nullable();
            $table->smallInteger('stock_inventory')->default(0);
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
        Schema::dropIfExists('product_variations');
    }
}
