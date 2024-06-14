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
        Schema::create('indicador_ejecutados', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('indicador_id'); 
            $table->foreign('indicador_id')->references('id')->on('indicadores');
            $table->string('descripcion');
            $table->string('comprobante');
            $table->date('fecha_pago');  
            $table->decimal('monto', $precision = 8, $scale = 2)->nullable();
            $table->string('nombre_documento_sustento');
            $table->string('ruta_documento_sustento');
            $table->date('fecha_documento');  
            $table->unsignedInteger('sub_generica_nivel_1_id'); 
            $table->foreign('sub_generica_nivel_1_id')->references('id')->on('sub_genericas_nivel_1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicador_ejecutados');
    }
};
