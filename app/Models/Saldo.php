<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    //
    protected $fillable = [
        "jogador_id","saldo", "essencia"
    ];
}
