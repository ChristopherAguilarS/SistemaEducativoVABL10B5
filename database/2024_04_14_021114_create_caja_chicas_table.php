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
            $table->date('fecha');
            $table->string('concepto');            
            $table->unsignedInteger('tipo_registro_id'); 
            $table->foreign('tipo_registro_id')->references('id')->on('tipo_registros');
            $table->decimal('monto', $precision = 8, $scale = 2);
            $table->string('beneficiario',300);
            $table->string('comprobante',300);
            $table->string('url',300);
            $table->unsignedInteger('cuenta_id'); 
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
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
        Schema::dropIfExists('caja_chicas');
    }
};
