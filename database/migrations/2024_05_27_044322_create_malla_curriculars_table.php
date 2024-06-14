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
        Schema::create('malla_curriculars', function (Blueprint $table) {
            $table->increments('id');             
            $table->string('descripcion')->nullable();
            $table->unsignedInteger('programa_estudio_id')->nullable(); 
            $table->foreign('programa_estudio_id')->references('id')->on('programa_estudios');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
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
        Schema::dropIfExists('malla_curriculars');
    }
};
