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
            $table->integer('cash_request_id')->nullable();
            $table->string('description');
            $table->float('amount',20,2);
            $table->integer('qty');
            $table->string('unit');
            $table->float('total',20,2);
            $table->timestamps();

            // $table->foreign('cash_request_id')->references('id')->on('cash_request');
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
