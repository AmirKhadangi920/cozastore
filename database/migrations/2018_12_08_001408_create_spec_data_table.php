<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('spec_row_id');
            $table->foreign('spec_row_id')
                    ->references('id')
                    ->on('spec_rows')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->string('product_id', 8);
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                    
            $table->string('data', 255);
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
        Schema::dropIfExists('specification_data');
    }
}
