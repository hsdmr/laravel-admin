<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slug_id')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('title');
            $table->integer('upper')->nullable();
            $table->longText('content')->nullable();
            $table->string('language')->default('tr_TR');
            $table->timestamps();

            $table->foreign('slug_id')->references('id')->on('slugs');
            $table->foreign('media_id')->references('id')->on('media');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
