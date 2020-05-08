<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piloti extends Model
{   protected $primaryKey = 'idpiloti';
    public $timestamps =false;
    protected $fillable = [
        'tipavion',
        'modelavion',
        'codangajat',
    ];
}
