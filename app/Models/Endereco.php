<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{

    //
    protected $fillable = [
        "rua","endereco", "cep", "bairro", "cidade", "estado", "jogador_id"
    ];
}
