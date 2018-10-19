<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rifa extends Model
{
    //
    protected $fillable = [
        "name", "date_inicio", "date_fim", "categoria_id"
    ];

    public function items() {

        return $this->belongsToMany(Item::class, 'rifa_items')->withTimestamps();

    }

    public  function  categorias(){

        return $this->belongsTo('App\Models\Categoria', 'categoria_id');
    }
}
