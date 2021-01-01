<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubmittedAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_submitted_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('std_id');
            $table->integer('xm_id');
            $table->integer('q_id');
            $table->integer('op_id');
            $table->string('check_submit');
            $table->string('check')->comment('std+exam+question');
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
        Schema::dropIfExists('student_submitted_answers');
    }
}