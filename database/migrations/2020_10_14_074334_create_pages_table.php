<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slug_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->integer('statu')->default(0);
            $table->string('title');
            $table->longText('content')->nullable();
            $table->integer('hit')->default(0);
            $table->string('template')->default('standart');
            $table->string('language')->default('tr');
            $table->tinyInteger('sidebar')->default(0);
            $table->softDeletes();
            $table->timestamps();

            //$table->foreign('slug_id')->references('id')->on('slugs');
            //$table->foreign('media_id')->references('id')->on('media');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
