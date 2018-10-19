<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $fillable = [
        "name","slug"
    ];

    public function rifas(){

        return $this->belongsTo('App\Models\Rifa', 'categoria_id');

    }
}
