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
        Schema::create('cake_interested', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cake_id');
            $table->unsignedBigInteger('interested_id');
            $table->foreign('cake_id')->references('id')->on('cake')->onDelete('cascade');;
            $table->foreign('interested_id')->references('id')->on('interested')->onDelete('cascade');;
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
        Schema::dropIfExists('cake_interested');
    }
};
