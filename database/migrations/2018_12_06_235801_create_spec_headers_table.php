<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('spec_id');
            $table->foreign('spec_id')
                    ->references('id')
                    ->on('specs')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                    
            $table->string('title', 50);
            $table->string('description', 255)->nullable();
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
        Schema::dropIfExists('specification_headers');
    }
}
