<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    //
    protected $fillable = [
        'valor', 'user_id','transacao_id'
    ];


    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id');
    }
}
