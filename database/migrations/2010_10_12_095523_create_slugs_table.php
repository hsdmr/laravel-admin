<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlugsTable extends Migration
{
    public function up()
    {
        Schema::create('slugs', function (Blueprint $table) {
            $table->id();
            $table->string('owner');
            $table->string('slug')->unique();
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->tinyInteger('no_index')->default(0);
            $table->tinyInteger('no_follow')->default(0);
            $table->string('language')->default('tr');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('slugs');
    }
}
