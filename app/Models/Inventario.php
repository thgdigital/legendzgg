<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    //
    protected $fillable = [ 'send', 'compra', 'is_liberado', 'username', 'jogador_id', 'item_id', 'user_id'];
}
