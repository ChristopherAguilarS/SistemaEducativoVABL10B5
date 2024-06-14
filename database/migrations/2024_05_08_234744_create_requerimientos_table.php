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
        Schema::create('requerimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_requerimiento');
            $table->integer('responsable_id'); 
            $table->foreign('responsable_id')->references('id')->on('rrhh_personas');
            $table->unsignedInteger('indicador_id'); 
            $table->foreign('indicador_id')->references('id')->on('indicadores');
            $table->integer('tipo_pedido');
            $table->integer('tipo_consumo');
            $table->integer('folios');
            $table->date('fecha_registro_requerimiento');
            $table->date('fecha_aprobacion_requerimiento');
            $table->text('descripcion');
            $table->text('comentarios');
            $table->boolean('estado_proceso');
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
        Schema::dropIfExists('requerimientos');
    }
};
