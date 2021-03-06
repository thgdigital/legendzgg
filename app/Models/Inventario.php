<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Inventario extends Model
{
    //
    protected $fillable = [ 'send', 'compra', 'is_liberado', 'invocador', 'jogador_id', 'item_id', 'user_id'];

    function  jogador(){

        return $this->belongsTo('App\Models\Jogador', 'jogador_id');
    }

    function  items(){

        return $this->belongsTo('App\Models\Item', 'item_id');
    }
}
