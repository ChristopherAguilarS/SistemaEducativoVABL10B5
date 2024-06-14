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
        Schema::create('tarea_ejecutadas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('indicador_id'); 
            $table->foreign('indicador_id')->references('id')->on('indicadores');
            $table->integer('tipo_requerimiento');
            $table->string('nro_requerimiento');
            $table->string('descripcion');
            $table->integer('tipo_comprobante');
            $table->string('comprobante');         
            $table->decimal('importe', $precision = 8, $scale = 2)->nullable();
            $table->string('nombre_documento_sustento');
            $table->string('ruta_documento_sustento');
            $table->date('fecha_emision_documento');
            $table->unsignedInteger('responsable_id')->nullable(); 
            $table->foreign('responsable_id')->references('id')->on('responsables');
            $table->unsignedInteger('especifica_nivel_2_id'); 
            $table->foreign('especifica_nivel_2_id')->references('id')->on('especificas_nivel_2');          
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
        Schema::dropIfExists('tarea_ejecutadas');
    }
};
