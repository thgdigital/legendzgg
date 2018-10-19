<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    //
    protected $fillable = [
         'status', 'tipo'
    ];

    public function items() {
        return $this->belongsToMany(Item::class, 'items_loja')->withTimestamps();


    }
}
