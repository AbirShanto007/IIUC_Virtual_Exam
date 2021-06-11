<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("starting_number")->nullable();
            $table->integer("ending_number")->nullable();
            $table->string("grade")->nullable();
            $table->string("grade_point")->nullable();
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
        Schema::dropIfExists('grade_points');
    }
}