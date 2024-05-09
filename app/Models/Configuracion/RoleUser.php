<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table='role_user';
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'role_id',
        'user_id',
        'created_by',
        'created_at'
    ];
}
