<?php

namespace TecStore;

use Illuminate\Database\Eloquent\Model;

class imagen extends Model
{
    public $table = "imagen";
    protected $fillable = [
        'id_producto','url', 'alt'
    ];
    public $timestamps = false;
}
