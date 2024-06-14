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
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id')->nullable();  
            $table->foreign('item_id')->references('id')->on('items');
            $table->unsignedInteger('pedido_id')->nullable();  
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->decimal('cantidad_solicitada', $precision = 8, $scale = 2)->nullable();
            $table->decimal('cantidad_presupuestada', $precision = 8, $scale = 2)->nullable();
            $table->decimal('precio_unitario', $precision = 8, $scale = 2)->nullable();
            $table->decimal('importe', $precision = 8, $scale = 2)->nullable();
            $table->text('descripcion');
            $table->text('observaciones');
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
        Schema::dropIfExists('pedido_items');
    }
};
