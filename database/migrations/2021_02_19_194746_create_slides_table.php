<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->string('color')->default('#000');
            $table->integer('opacity')->default(100);
            $table->tinyInteger('is_video')->default(0);
            $table->string('bg')->nullable();
            $table->string('button')->nullable();
            $table->string('link')->nullable();
            $table->integer('order')->default(0);
            $table->string('language')->default('tr');
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
        Schema::dropIfExists('slides');
    }
}
