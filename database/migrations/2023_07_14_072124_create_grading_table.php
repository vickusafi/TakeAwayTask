<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grading', function (Blueprint $table) {
            $table->id();
            $table->string('submission_id', 11);
            $table->string('student_id', 11);
            $table->string('teacher__id', 11);
            $table->string('grade');
            $table->string('marks');
            $table->string('comments');
            $table->string('status', 3)->default(1);
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
        Schema::dropIfExists('grading');
    }
}
