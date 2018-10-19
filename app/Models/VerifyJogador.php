<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyJogador extends Model
{
    //
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\Jogador', 'jogador_id');
    }
}
