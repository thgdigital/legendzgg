<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saque extends Model
{
    //
    protected $fillable = [
        'status', 'saque', 'jogador_id', 'type', 'admin_id'
    ];

    function  jogador(){

        return $this->belongsTo('App\Models\Jogador', 'jogador_id');
    }
    function admin(){

        return $this->belongsTo('App\User', 'admin_id');
    }
}
