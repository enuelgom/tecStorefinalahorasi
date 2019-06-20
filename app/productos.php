<?php

namespace TecStore;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    protected $fillable = [
        'nombre', 'descripcion', 'cantidad', 'precio', 'status', 'id_usuario'
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;
}

