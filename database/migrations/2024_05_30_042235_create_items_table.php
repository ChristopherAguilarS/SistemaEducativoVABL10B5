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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('codigo');
            $table->text('descripcion');
            $table->unsignedInteger('familia_adquisicion_id')->nullable();  
            $table->foreign('familia_adquisicion_id')->references('id')->on('familia_adquisicions');
            $table->boolean('estado');
            $table->string('codigo_seace');
            $table->unsignedInteger('unidad_medida_id')->nullable();  
            $table->foreign('unidad_medida_id')->references('id')->on('unidad_medidas');
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
        Schema::dropIfExists('items');
    }
};
