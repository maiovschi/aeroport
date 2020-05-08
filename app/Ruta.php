<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{    protected $primaryKey = 'idruta';
    public $timestamps =false;
    protected $fillable = [
        'orasdecolare',
        'orasaterizare',
        'oradecolare',
        'oraaterizare',
        
    ];
}
