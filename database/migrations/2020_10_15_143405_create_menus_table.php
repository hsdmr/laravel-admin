<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->default('#');
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('parent')->nullable();
            $table->integer('position')->default(0);
            $table->string('menuname')->default('Ana Menü');
            $table->string('language')->default('tr_TR');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
