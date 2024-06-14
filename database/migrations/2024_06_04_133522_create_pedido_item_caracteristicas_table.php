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
        Schema::create('pedido_item_caracteristicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pedido_item_id')->nullable();  
            $table->foreign('pedido_item_id')->references('id')->on('pedido_items');
            $table->integer('tipo_caracteristica');
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
        Schema::dropIfExists('pedido_item_caracteristicas');
    }
};
