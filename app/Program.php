<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{   protected $primaryKey = 'idprogram';
    public $timestamps =false;
    protected $fillable = [
        'codpilot',
        'codsteward',
        'codavion',
        'codruta',
    ];
}
