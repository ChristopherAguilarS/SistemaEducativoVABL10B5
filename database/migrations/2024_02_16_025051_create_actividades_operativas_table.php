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
        Schema::create('actividades_operativas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->text('descripcion');
            $table->unsignedInteger('accion_estrategica_priorizada_id'); 
            $table->foreign('accion_estrategica_priorizada_id')->references('id')->on('accion_estrategica_priorizadas');
            $table->decimal('monto_asignado', $precision = 8, $scale = 2)->nullable();
            $table->decimal('monto_ejecutado', $precision = 8, $scale = 2)->nullable();
            $table->decimal('saldo', $precision = 8, $scale = 2)->nullable();
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
        Schema::dropIfExists('actividades_operativas');
    }
};
