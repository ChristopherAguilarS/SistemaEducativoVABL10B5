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
        Schema::create('programa_estudios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nro_ciclos')->nullable();
            $table->string('descripcion');
            $table->string('nro_resolucion')->nullable();            
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
        Schema::dropIfExists('programa_estudios');
    }
};
