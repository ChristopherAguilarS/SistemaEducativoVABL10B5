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
        Schema::create('accion_estrategica_priorizadas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',6);
            $table->text('descripcion');
            $table->unsignedInteger('objetivo_estrategico_id'); 
            $table->foreign('objetivo_estrategico_id')->references('id')->on('objetivo_estrategicos');
            $table->decimal('monto_asignado', $precision = 8, $scale = 2)->nullable();
            $table->decimal('monto_ejecutado', $precision = 8, $scale = 2)->nullable();
            $table->decimal('saldo', $precision = 8, $scale = 2)->nullable();
            $table->boolean('estado');
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accion_estrategica_priorizadas');
    }
};
