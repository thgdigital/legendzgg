<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    //
    protected $fillable = [
         'status', 'tipo','item_id'
    ];

    public function items() {
        return $this->belongsTo(Item::class, 'item_id');;


    }
    public function jogador() {
        return $this->belongsToMany(Jogador::class, 'jogador_loja', 'loja_id', 'loja_id')->withPivot('valor_credito', 'valor_resgate', 'valor_essencia')->withTimestamps();


    }
}
