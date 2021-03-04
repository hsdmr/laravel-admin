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
            $table->string('title')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->longText('content')->nullable();
            $table->integer('student_number')->default(-1);
            $table->tinyInteger('difficulty')->default(0);
            $table->float('price')->default(0);
            $table->time('time')->nullable();
            $table->longText('what_to_learn')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('for_who')->nullable();
            $table->longText('includes')->nullable();
            $table->unsignedBigInteger('course_id')->default(0);
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
