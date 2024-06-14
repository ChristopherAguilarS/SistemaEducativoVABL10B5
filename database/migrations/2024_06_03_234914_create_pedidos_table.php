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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_pedido');
            $table->integer('tipo_pedido');           
            $table->unsignedInteger('requerimiento_id'); 
            $table->foreign('requerimiento_id')->references('id')->on('requerimientos');
            $table->date('fecha');
            $table->bigInteger('proveedor_id'); 
            $table->foreign('proveedor_id')->references('id')->on('log_catalogo_proveedores');
            $table->string('descripcion');
            $table->decimal('sub_total', $precision = 8, $scale = 2)->nullable();
            $table->decimal('impuestos', $precision = 8, $scale = 2)->nullable();
            $table->decimal('total', $precision = 8, $scale = 2)->nullable();
            $table->boolean('igv');
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
        Schema::dropIfExists('pedidos');
    }
};
