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
        Schema::create('caja_chicas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_creacion');
            $table->string('descripcion')->nullable();
            $table->string('decreto')->nullable();
            $table->string('ruta_decreto')->nullable();
            $table->integer('responsable_id')->nullable(); 
            $table->foreign('responsable_id')->references('id')->on('rrhh_personas');
            $table->unsignedInteger('año_academico_id'); 
            $table->foreign('año_academico_id')->references('id')->on('año_academicos');
            $table->decimal('monto_inicial', $precision = 8, $scale = 2)->nullable();
            $table->integer('fuente_financiamiento');
            $table->string('comprobante')->nullable();
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
