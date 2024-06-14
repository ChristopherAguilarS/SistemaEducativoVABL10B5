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
        Schema::create('detalle_movimiento_caja_chicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('movimiento_caja_chica_id')->nullable(); 
            $table->foreign('movimiento_caja_chica_id')->references('id')->on('movimiento_caja_chicas');
            $table->decimal('monto', $precision = 8, $scale = 2)->nullable();
            $table->date('fecha_emision');
            $table->string('documento')->nullable();
            $table->string('nro_documento')->nullable();
            $table->string('ruta_documento')->nullable();
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
        Schema::dropIfExists('detalle_movimiento_caja_chicas');
    }
};
