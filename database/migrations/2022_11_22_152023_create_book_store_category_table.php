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
        Schema::create('book_store_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_store_id')->unsigned();
            $table->unsignedBigInteger('book_category_id')->unsigned();
            $table->foreign('book_store_id')->references('id')->on('book_store');
            $table->foreign('book_category_id')->references('id')->on('book_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_category');
    }
};
