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
            $table->unsignedInteger('cuenta_id')->nullable(); 
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            $table->string('descripcion');
            $table->string('comprobante')->nullable();  
            $table->date('fecha');          
            $table->integer('tipo');
            $table->unsignedInteger('categoria_id'); 
            $table->foreign('categoria_id')->references('id')->on('categoria_movimiento_caja_chicas');            
            $table->string('descripcion_categoria')->nullable();
            $table->decimal('monto', $precision = 8, $scale = 2)->nullable();
            $table->unsignedInteger('movimiento_apertura_id')->nullable(); 
            $table->foreign('movimiento_apertura_id')->references('id')->on('movimiento_caja_chicas'); 
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
