<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            
            $table->string('first_name');
            $table->string('last_name');
            
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('blood_group')->nullable();

            $table->string('parent_contact_number');
            $table->string('contact_number')->nullable();

            $table->string('father_occupation');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->enum('gender',['male','female']);
            $table->string('current_institute')->nullable();
            $table->date('dob');

            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('division_id');
            
            $table->string('status')->default('active');
            
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('batch_id')->nullable();

            $table->timestamps();

            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('batch_id')->references('id')->on('batches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_details');
    }
}
