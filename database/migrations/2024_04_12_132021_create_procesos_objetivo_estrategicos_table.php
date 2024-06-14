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
        Schema::create('procesos_objetivo_estrategicos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('proceso_id');
            $table->foreign('proceso_id')->references('id')->on('procesos')->onDelete('cascade');
            $table->unsignedInteger('objetivo_estrategico_id');
            $table->foreign('objetivo_estrategico_id')->references('id')->on('objetivo_estrategicos')->onDelete('cascade');
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
        Schema::dropIfExists('procesos_objetivo_estrategicos');
    }
};
