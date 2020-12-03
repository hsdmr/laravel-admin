<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('logo')->default(1);
            $table->unsignedBigInteger('favicon')->default(1);
            $table->longText('headcss')->nullable();
            $table->longText('headjs')->nullable();
            $table->longText('footerjs')->nullable();
            $table->tinyInteger('no_index')->default(1);
            $table->tinyInteger('no_follow')->default(1);
            $table->string('language')->default('tr_TR');
            $table->timestamps();

            $table->foreign('logo')->references('id')->on('media');
            $table->foreign('favicon')->references('id')->on('media');
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
