<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardCredit extends Model
{
    //
    protected $fillable = [
        "name", "cpf","number","validade","cvv", "bandeira"
    ];

    public  function jogadors(){

        return $this->belongsTo('App\Models\Jogador');
    }
}
