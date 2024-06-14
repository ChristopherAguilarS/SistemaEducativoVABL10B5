<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClaseAdquisicion extends Model
{
    use HasFactory;
    public function grupo(): BelongsTo
    {
        return $this->belongsTo('App\Models\GrupoAdquisicion', 'grupo_adquisicion_id', 'id');
    }
}
