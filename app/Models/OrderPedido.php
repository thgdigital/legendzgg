<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPedido extends Model
{
    //
    protected $fillable = [
        "rua","endereco", "cep", "bairro", "cidade", "estado", "jogador_id", "code", "valor_total","typePedido"
    ];

    function  jogador(){

        return $this->belongsTo('App\Models\Jogador', 'jogador_id');
    }
    function transacao(){

        return $this->hasOne('App\Models\Transacao', 'order_id');
    }
}
