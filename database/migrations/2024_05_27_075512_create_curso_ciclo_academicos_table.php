<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('curso_ciclo_academicos', function (Blueprint $table) {
            $table->increments('id');    
            $table->unsignedInteger('ciclo_id')->nullable();  
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->unsignedInteger('curso_id')->nullable();  
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->unsignedInteger('programa_estudio_id')->nullable();  
            $table->foreign('programa_estudio_id')->references('id')->on('programa_estudios');
            $table->integer('turno');
            $table->string('seccion');
            $table->integer('docente_id')->nullable();  
            $table->foreign('docente_id')->references('id')->on('rrhh_personas');
            $table->boolean('estado');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_ciclo_academicos');
    }
};
