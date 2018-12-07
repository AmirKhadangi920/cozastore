<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 8)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('product_id', 8);
            $table->foreign('product_id')->references('id')->on('products');
            $table->tinyInteger('rating');
            $table->mediumText('review');
            $table->mediumText('answer')->nullable();
            $table->boolean('seen')->default(0);
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
        Schema::dropIfExists('reviews');
    }
}
