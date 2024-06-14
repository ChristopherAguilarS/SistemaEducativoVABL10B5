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
        Schema::create('curso_requisitos', function (Blueprint $table) {
            $table->increments('id');             
            $table->string('descripcion')->nullable();
            $table->integer('ciclo')->nullable(); 
            $table->integer('creditos')->nullable();
            $table->unsignedInteger('programa_estudio_id')->nullable();  
            $table->foreign('programa_estudio_id')->references('id')->on('programa_estudios');
            $table->unsignedInteger('curso_equivalencia_id')->nullable();  
            $table->foreign('curso_equivalencia_id')->references('id')->on('cursos');
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
        Schema::dropIfExists('curso_requisitos');
    }
};
