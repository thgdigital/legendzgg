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
}
