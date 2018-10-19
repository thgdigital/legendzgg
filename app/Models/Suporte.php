<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suporte extends Model
{
    //
    protected $fillable = [ 'topico', 'outro', 'status', 'detalhe', 'jogador_id'];

    public function jogador(){

        return $this->belongsTo(Jogador::class, 'jogador_id');
    }
}
