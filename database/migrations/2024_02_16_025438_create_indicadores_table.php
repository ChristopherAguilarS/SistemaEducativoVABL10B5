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
        Schema::create('indicadores', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('actividad_operativa_id'); 
            $table->foreign('actividad_operativa_id')->references('id')->on('actividades_operativas');
            $table->string('codigo');
            $table->string('descripcion');
            $table->decimal('meta', $precision = 8, $scale = 2);
            $table->decimal('meta_ejecutada', $precision = 8, $scale = 2);
            $table->decimal('porcentaje_avance', $precision = 5, $scale = 2);
            $table->unsignedInteger('responsable_id')->nullable(); 
            $table->foreign('responsable_id')->references('id')->on('responsables');
            $table->string('bienes_servicios')->nullable();
            $table->string('tareas');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('monto_asignado', $precision = 8, $scale = 2)->nullable();
            $table->decimal('monto_ejecutado', $precision = 8, $scale = 2)->nullable();
            $table->decimal('saldo', $precision = 8, $scale = 2)->nullable();
            $table->decimal('monto_pia', $precision = 8, $scale = 2)->nullable();
            $table->integer('aumento_disminucion');
            $table->decimal('monto_pim', $precision = 8, $scale = 2)->nullable();
            $table->boolean('estado');            
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            /*$table->increments('id');
            $table->unsignedInteger('actividad_operativa_id'); 
            $table->foreign('actividad_operativa_id')->references('id')->on('actividades_operativas');
            $table->string('codigo');
            $table->string('descripcion');
            $table->string('meta');
            $table->string('responsables');
            $table->string('bienes_servicios');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('presupuesto', $precision = 10, $scale = 2);
            $table->unsignedInteger('sub_generica_nivel_1_id'); 
            $table->foreign('sub_generica_nivel_1_id')->references('id')->on('sub_genericas_nivel_1');
            $table->unsignedInteger('centro_costo_id'); 
            $table->foreign('centro_costo_id')->references('id')->on('centro_costos');
            $table->boolean('estado');            
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicadores');
    }
};
