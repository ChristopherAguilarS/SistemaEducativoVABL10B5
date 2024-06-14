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
        Schema::create('detalle_asiento_contables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion')->nullable();
            $table->unsignedInteger('asiento_id'); 
            $table->foreign('asiento_id')->references('id')->on('asiento_contables');
            $table->unsignedInteger('cuenta_id'); 
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            $table->decimal('monto', $precision = 8, $scale = 2)->nullable();
            $table->boolean('tipo');
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
        Schema::dropIfExists('detalle_asiento_contables');
    }
};
