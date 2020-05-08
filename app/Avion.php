<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avion extends Model
{   protected $primaryKey = 'idavion';
    public $timestamps =false;
    protected $fillable = [
        'tipavion',
        'modelavion',
        'numeavion',
    ];
}
