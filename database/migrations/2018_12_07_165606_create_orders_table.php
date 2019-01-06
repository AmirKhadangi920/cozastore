<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('id', 8);
            $table->primary('id');
            $table->string('buyer', 8);
                $table->foreign('buyer')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->unsignedInteger('discount_code_id')->nullable();
                $table->foreign('discount_code_id')
                    ->references('id')
                    ->on('discount_codes')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->string('admin_description', 255)->nullable();
            $table->string('buyer_description', 255)->nullable();
            $table->string('destination', 255);
            $table->string('postal_code', 10);
            $table->bigInteger('offer')->default(0);
            $table->string('shipping_type', 100)->nullable();
            $table->integer('shipping_cost')->default(0);
            $table->bigInteger('total')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->datetime('payment')->nullable();
            $table->datetime('payment_jalali')->nullable();
            $table->string('auth_code', 50)->nullable();
            $table->string('payment_code', 30)->nullable();
            $table->mediumText('datetimes')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
