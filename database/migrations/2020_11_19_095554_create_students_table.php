<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_type');
            $table->string('full_name');
            $table->string('father_name');
            $table->string('gender');
            $table->string('city');
            $table->string('teacher_name');
            $table->string('class_name');
            $table->string('dob');
            $table->string('student_id');
            $table->integer('sponsored')->default(0);
            $table->text('personal_statement');
            $table->string('profile_picture');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
