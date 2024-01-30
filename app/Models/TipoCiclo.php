<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCiclo extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'estado',
        'created_by',
        'updated_by'
    ];
}