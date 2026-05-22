<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Valoracion extends Model {
    protected $table = 'valoracion';
    
    protected $fillable = ['idpelicula', 'comment'];

    function pelicula(): BelongsTo {
        return $this->belongsTo('App\Models\Pelicula', 'idpelicula');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}