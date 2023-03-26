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
        Schema::create('cash_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->nullable();
            $table->integer('request_by')->nullable();
            $table->date('date');
            $table->integer('approved_by')->nullable(); //nullable
            $table->string('status')->nullable(); //nullable
            $table->text('reasons')->nullable();
            $table->timestamps();

            // $table->foreign('project_id')->references('id')->on('projects');
            // $table->foreign('request_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_request');
    }
};
