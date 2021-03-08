<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slug_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->longText('video')->nullable();
            $table->longText('zoom')->nullable();
            $table->tinyInteger('difficulty')->nullable()->comment('0=All; 1=Easy; 2=Middle; 3=Hard');
            $table->float('price')->nullable()->comment('null=free');
            $table->time('time')->nullable();
            $table->longText('what_to_learn')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('for_who')->nullable();
            $table->longText('includes')->nullable();
            $table->date('available_time')->nullable()->comment('null=forever');
            $table->softDeletes();
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
        Schema::dropIfExists('courses');
    }
}
