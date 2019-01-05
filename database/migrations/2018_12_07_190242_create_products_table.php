<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('id', 8);
            $table->primary('id');
            $table->string('user_id', 8);
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->integer('brand_id')->unsigned()->nullable();
                $table->foreign('brand_id')
                    ->references('id')
                    ->on('brands')
                    ->onDelete('set null')
                    ->onUpdate('set null');

            $table->integer('spec_id')->unsigned()->nullable();
                $table->foreign('spec_id')
                    ->references('id')
                    ->on('specs')
                    ->onDelete('set null')
                    ->onUpdate('set null');
                    
            $table->string('name', 50);
            $table->string('code', 20)->nullable();
            $table->string('short_description', 255)->nullable();
            $table->mediumText('note')->nullable();
            $table->string('aparat_video', 8)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->text('full_description')->nullable();
            $table->mediumText('keywords')->nullable();
            $table->string('photo', 50)->nullable();
            $table->mediumText('gallery')->nullable();
            $table->tinyInteger('label')->nullable();
            $table->mediumText('advantages')->nullable();
            $table->mediumText('disadvantages')->nullable();
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
}
