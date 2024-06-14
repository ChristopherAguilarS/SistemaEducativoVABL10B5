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
        Schema::create('postulantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('ape_pat');
            $table->string('ape_mat');
            $table->enum('tipo_documento',['dni','carnet_extranjeria','pasaporte']);
            $table->string('nro_documento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo_electronico')->nullable();
            $table->string('nombre_institucion_formadora');
            $table->integer('pais_id_formadora')->nullable();            
            $table->integer('departamento_id_formadora')->nullable();
            $table->integer('provincia_id_formadora')->nullable();
            $table->integer('distrito_id_formadora')->nullable();
            $table->text('ubicacion_institucion_formadora');
            $table->integer('tipo_funcion')->nullable();
            $table->integer('año_egreso')->nullable();
            $table->integer('carrera_profesional_id')->nullable();
            $table->boolean('ejerce_docencia')->nullable();
            $table->integer('modalidad_nivel')->nullable();            
            $table->string('nombre_institucion_trabaja')->nullable();
            $table->integer('pais_id_trabajo')->nullable();            
            $table->integer('departamento_id_trabajo')->nullable();
            $table->integer('provincia_id_trabajo')->nullable();
            $table->integer('distrito_id_trabajo')->nullable();
            $table->boolean('nombrado')->nullable();
            $table->integer('escala_magisterial')->nullable();
            $table->string('otro_trabajo')->nullable();
            $table->boolean('certificado_estudios')->nullable();
            $table->string('ruta_certificado_estudios')->nullable();
            $table->boolean('copia_titulo')->nullable();
            $table->string('ruta_copia_titulo')->nullable();
            $table->boolean('copia_dni')->nullable();
            $table->string('ruta_copia_dni')->nullable();
            $table->boolean('declaracion_jurada')->nullable();
            $table->string('ruta_declaracion_jurada')->nullable();
            $table->integer('tipo_comprobante_pago')->nullable();
            $table->string('nro_comprobante_pago')->nullable();
            $table->date('fecha_emision_comprobante_pago')->nullable();
            $table->decimal('monto_comprobante_pago', $precision = 8, $scale = 2)->nullable();
            $table->string('ruta_comprobante_pago')->nullable();
            $table->unsignedInteger('programa_estudio_id')->nullable(); 
            $table->foreign('programa_estudio_id')->references('id')->on('programa_estudios');
            $table->unsignedInteger('ciclo_id')->nullable(); 
            $table->foreign('ciclo_id')->references('id')->on('ciclos');
            $table->decimal('nota_examen_escrito', $precision = 4, $scale = 2)->nullable();
            $table->decimal('nota_entrevista', $precision = 4, $scale = 2)->nullable();
            $table->decimal('nota_promedio', $precision = 4, $scale = 2)->nullable();
            $table->boolean('estado');
            $table->boolean('proceso');
            $table->string('comentario')->nullable();
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
        Schema::dropIfExists('postulantes');
    }
};
