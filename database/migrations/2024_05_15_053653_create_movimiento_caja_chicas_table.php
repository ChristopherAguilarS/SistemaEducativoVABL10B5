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
        Schema::create('movimiento_caja_chicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('caja_chica_id')->nullable(); 
            $table->foreign('caja_chica_id')->references('id')->on('caja_chicas');
            $table->date('fecha');
            $table->integer('tipo_movimiento');
            $table->string('descripcion');
            $table->unsignedInteger('categoria_movimiento_id')->nullable(); 
            $table->foreign('categoria_movimiento_id')->references('id')->on('categoria_movimiento_caja_chicas');
            $table->decimal('monto', $precision = 8, $scale = 2)->nullable();
            $table->unsignedInteger('indicador_id'); 
            $table->foreign('indicador_id')->references('id')->on('indicadores');
            $table->integer('responsable_id')->nullable();  
            $table->foreign('responsable_id')->references('id')->on('rrhh_personas');         
            $table->integer('tipo_desembolso');
            $table->string('nro_desembolso')->nullable();
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
        Schema::dropIfExists('movimiento_caja_chicas');
    }
};
