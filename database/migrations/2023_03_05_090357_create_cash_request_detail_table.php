<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_request_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('cash_request_id')->references('id')->on('cash_request');
            $table->string('description');
            $table->float('amount');
            $table->integer('qty');
            $table->string('unit');
            $table->float('total');
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
        Schema::dropIfExists('cash_request_detail');
    }
};
