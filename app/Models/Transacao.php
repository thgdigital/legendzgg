<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    //
    protected $fillable = [
        "status", "order_id"
    ];

    public  function  order(){

        return $this->belongsTo('App\Models\OrderPedido', 'order_id');
    }

    public  function  credit(){

        return $this->hasOne('App\Models\Credit', 'transacao_id');
    }

}

