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
            $table->string('course_name')->comment('Nombre del curso');
            $table->string('teacher_responsible')->comment('Nombre del profesor responsable del curso');
            $table->timestamp('start_date')->comment('Fecha de inicio del curso');
            $table->timestamp('date_completion')->comment('Fecha de terminación del curso');
            $table->integer('room_number')->comment('Número del salón donde se imparte el curso');
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
        Schema::dropIfExists('courses');
    }
}
