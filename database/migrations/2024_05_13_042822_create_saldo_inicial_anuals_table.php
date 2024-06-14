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
        Schema::create('saldo_inicial_anuals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('año'); 
            $table->unsignedInteger('cuenta_id'); 
            $table->foreign('cuenta_id')->references('id')->on('cuentas');
            $table->decimal('saldo_inicial_debe', $precision = 8, $scale = 2)->nullable();
            $table->decimal('saldo_inicial_haber', $precision = 8, $scale = 2)->nullable();
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
        Schema::dropIfExists('saldo_inicial_anuals');
    }
};
