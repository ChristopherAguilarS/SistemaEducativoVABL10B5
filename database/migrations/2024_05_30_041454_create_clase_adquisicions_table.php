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
        Schema::create('clase_adquisicions', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('codigo');
            $table->text('descripcion');
            $table->unsignedInteger('grupo_adquisicion_id')->nullable();  
            $table->foreign('grupo_adquisicion_id')->references('id')->on('grupo_adquisicions');
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
        Schema::dropIfExists('clase_adquisicions');
    }
};
