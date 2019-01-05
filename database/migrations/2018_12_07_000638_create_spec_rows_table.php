<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('spec_header_id');
            $table->foreign('spec_header_id')
                    ->references('id')
                    ->on('spec_headers')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            $table->string('title', 50);
            $table->string('label', 50)->nullable();
            $table->mediumText('values')->nullable();
            $table->mediumText('help')->nullable();
            $table->boolean('multiple')->default(0);
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
        Schema::dropIfExists('specification_rows');
    }
}
