<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kids', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->comment('Primer nombre del niño');
            $table->string('second_first_name')->comment('Segundo nombre del niño');
            $table->string('first_surname')->comment('Primer apellido del niño');
            $table->string('second_surname')->comment('Segundo apellido del niño');
            $table->bigInteger('identification_number')->comment('Número de identificación del niño');
            $table->enum('gender', ['masculino','femenino'])->comment('Sexo del niño');
            $table->timestamp('date_of_birth')->comment('Fecha de nacimiento del niño');
            $table->unsignedBigInteger('course_id')->comment('Identificador del curso al que ingresa el niño')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses');
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
        Schema::table('kids', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
        });

        Schema::dropIfExists('kids');
    }
}
