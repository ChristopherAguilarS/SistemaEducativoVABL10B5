<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamiliaAdquisicion extends Model
{
    use HasFactory;
    public function clase(): BelongsTo
    {
        return $this->belongsTo('App\Models\ClaseAdquisicion', 'clase_adquisicion_id', 'id');
    }
}
