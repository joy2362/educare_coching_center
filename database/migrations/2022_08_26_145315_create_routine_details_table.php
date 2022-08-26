<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutineDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('routine_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('day');
            $table->time('class_start');
            $table->time('class_end');
            $table->string('teacher_initial');
            $table->timestamps();
            $table->foreign('routine_id')->on('routines')->references('id')->onDelete("cascade");
            $table->foreign('subject_id')->on('subjects')->references('id')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routine_details');
    }
}
