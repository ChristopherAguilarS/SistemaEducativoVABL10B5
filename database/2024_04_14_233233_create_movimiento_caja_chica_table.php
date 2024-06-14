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
        Schema::create('movimiento_caja_chica', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('caja_chica_id'); 
            $table->foreign('caja_chica_id')->references('id')->on('caja_chicas');
            $table->unsignedInteger('indicador_id'); 
            $table->foreign('indicador_id')->references('id')->on('indicadores');
            $table->unsignedInteger('especifica_nivel_2_id'); 
            $table->foreign('especifica_nivel_2_id')->references('id')->on('especificas_nivel_2');
            $table->integer('tipo_comprobante')->nullable();
            $table->string('comprobante')->nullable();
            $table->date('fecha_emision_documento')->nullable();
            $table->date('fecha');          
            $table->integer('tipo');
            $table->unsignedInteger('categoria_id'); 
            $table->foreign('categoria_id')->references('id')->on('categoria_movimiento_caja_chicas');             
            $table->string('descripcion_categoria');  
            $table->decimal('monto', $precision = 8, $scale = 2);
            $table->integer('movimiento_apertura_id')->nullable();
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
        Schema::dropIfExists('movimiento_caja_bancos');
    }
};
