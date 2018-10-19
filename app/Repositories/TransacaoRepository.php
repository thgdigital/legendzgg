<?php

namespace App\Repositories;
use App\Models\Transacao;

/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 24/09/2018
 * Time: 15:02
 */
class TransacaoRepository extends AbstractRepository
{
    public $model;

    public function __construct(Transacao $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function findOrder(){

        return $this->model->with('order.jogador')->orderBy('updated_at', 'desc')->get();
    }

}