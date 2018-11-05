<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    //
    protected $fillable = [
        "name","imagem", "num_rifias", "valor_rifa", "valor_venda", "valor_rp",  "valor_credito", "valor_essencia","resgatavel", "status", "tipo_items_id"
    ];

    public function rifas(){

        return $this->belongsToMany(Rifa::class, 'rifa_items')->withTimestamps();

    }
    public function jogadors(){

        return $this->belongsToMany(Jogador::class, 'items_jogador', 'items_id')->withTimestamps()->withPivot('numeber');

    }

    function  tipo(){

        return $this->belongsTo('App\Models\TipoItem', 'tipo_items_id');
    }

    function  vencedor($number){

        return $this->belongsToMany(Jogador::class, 'items_jogador', 'items_id')->wherePivot('numeber', $number);
    }

}
