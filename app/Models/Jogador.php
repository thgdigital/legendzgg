<?php

namespace App\Models;

use App\Notifications\JogadorResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Jogador extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'nascimento', 'username','code','verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verifyUser()
    {
        return $this->hasOne('App\Models\VerifyJogador');
    }
    public function saldo()
    {
        return $this->hasOne('App\Models\Saldo');
    }
    public function endereco()
    {
        return $this->hasOne('App\Models\Endereco');
    }
    public function cardCredit()
    {
        return $this->hasOne('App\Models\CardCredit');
    }

    public function suporte()
    {
        return $this->hasOne('App\Models\Suporte');
    }
    public function regastes()
    {
        return $this->hasOne('App\Models\Regaste');
    }
    public function order()
    {
        return $this->hasOne('App\Models\OrderPedido', 'jogador_id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new JogadorResetPasswordNotification($token));
    }

    public function loja(){
        return $this->belongsToMany('App\Models\Loja', 'jogador_loja', 'jogador_id', 'loja_id')->withPivot('valor_credito', 'valor_resgate', 'valor_essencia')->withTimestamps();
    }
}
