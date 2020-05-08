<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angajati extends Model
{   protected $primaryKey = 'idangajat';
    public $timestamps =false;
    protected $fillable = [
        'nume',
        'prenume',
        'cnp',
        'dataangajarii',
        'salariu',
        'functie'
    ];
}
