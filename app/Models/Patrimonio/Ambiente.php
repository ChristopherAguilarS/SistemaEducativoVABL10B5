<?php

namespace App\Models\Patrimonio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='log_ambientes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'nombre',
        'catalogo_tipo_ambiente_id',
        'catalogo_pabellon_id',
        'catalogo_piso_id',
        'estado_conservacion',
        'catalogo_uso_ambiente_id',
        'aforo',
        'largo',
        'ancho',
        'alto',
        'area',
        'tipo_uso',
        'puertas',
        'ventanas',
        'catalogo_tipo_techo_id',
        'catalogo_tipo_piso_id',
        'luces_emergencia',
        'alarmas',
        'extintores',
        'escritorios_total',
        'escritorios_buenos',
        'escritorios_regulares',
        'escritorios_malos',
        'sillas_total',
        'sillas_buenos',
        'sillas_regulares',
        'sillas_malos',
        'carpetas_total',
        'carpetas_buenos',
        'carpetas_regulares',
        'carpetas_malos',
        'armarios_total',
        'armarios_buenos',
        'armarios_regulares',
        'armarios_malos',
        'proyectores_total',
        'proyectores_buenos',
        'proyectores_regulares',
        'proyectores_malos',
        'pizarras_total',
        'pizarras_buenos',
        'pizarras_regulares',
        'pizarras_malos',
        'otros_total',
        'otros_buenos',
        'otros_regulares',
        'otros_malos',
        'estado',
        'observaciones',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];  
}
