<?php

namespace App\Models\Academico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $table = 'postulantes';
    protected $fillable = [
        'id',
        'nombres',
        'ape_pat',
        'ape_mat',
        'tipo_documento',
        'nro_documento',
        'telefono',
        'sexo',
        'correo_electronico',
        'nombre_institucion_formadora',
        'pais_id_formadora',
        'departamento_id_formadora',
        'provincia_id_formadora',
        'distrito_id_formadora',
        'tipo_funcion',
        'ubicacion_institucion_formadora',
        'año_egreso',
        'carrera_profesional_id',
        'ejerce_docencia',
        'modalidad_nivel',
        'nombre_institucion_trabaja',
        'pais_id_trabajo',
        'departamento_id_trabajo',
        'provincia_id_trabajo',
        'distrito_id_trabajo',
        'nombrado',
        'escala_magisterial',
        'otro_trabajo',
        'certificado_estudios',
        'ruta_certificado_estudios',
        'copia_titulo',
        'ruta_copia_titulo',
        'copia_dni',
        'ruta_copia_dni',
        'declaracion_jurada',
        'ruta_declaracion_jurada',
        'tipo_comprobante_pago',
        'nro_comprobante_pago',
        'fecha_emision_comprobante_pago',
        'monto_comprobante_pago',
        'ruta_comprobante_pago',
        'programa_estudio_id',
        'estado',
        'created_by',
        'updated_by'
    ];
}
