<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1);
            $table->unsignedBigInteger('article_id')->default(1);
            $table->string('title')->nullable();
            $table->tinyInteger('statu')->default(0);
            $table->longText('content');
            $table->string('language')->default('tr');
            $table->softDeletes();
            $table->timestamps();

            //$table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('article_id')->references('id')->on('articles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
