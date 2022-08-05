<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_debits', function (Blueprint $table) {
            $table->id();
            $table->double('amount',10,2);
            $table->unsignedBigInteger('user_id');
            $table->enum('payment_type',['cash' ,'online'])->default('cash');
            $table->string('status')->default('paid');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_debits');
    }
}
