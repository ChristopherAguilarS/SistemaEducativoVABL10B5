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
        Schema::create('grupo_adquisicions', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('codigo');
            $table->text('descripcion');
            $table->unsignedInteger('tipo_adquisicion_id')->nullable();  
            $table->foreign('tipo_adquisicion_id')->references('id')->on('tipo_adquisicions');
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
        Schema::dropIfExists('grupo_adquisicions');
    }
};
