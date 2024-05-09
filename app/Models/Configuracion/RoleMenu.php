<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='role_menus';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'role_id',
        'menu_id',
        'created_by',
        'created_at'
    ];
}
