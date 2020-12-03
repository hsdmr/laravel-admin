<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slug_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->integer('statu')->default(0);
            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('hit')->default(0);
            $table->string('language')->default('tr_TR');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('slug_id')->references('id')->on('slugs');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('media_id')->references('id')->on('media');
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
