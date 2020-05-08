<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Steward extends Model
{   protected $primaryKey = 'idsteward';
    public $timestamps =false;
    protected $fillable = [
        'tipavion',
        'modelavion',
        'codangajat',
    ];
}
