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
        Schema::create('indicador_pim_s', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('indicador_id')->nullable();  
            $table->foreign('indicador_id')->references('id')->on('indicadores');
            $table->string('resolucion')->nullable();
            $table->string('ubicacion_resolucion',500)->nullable();            
            $table->text('descripcion');
            $table->date('fecha');
            $table->decimal('importe', $precision = 8, $scale = 2)->nullable();
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
        Schema::dropIfExists('indicador_pim_s');
    }
};
