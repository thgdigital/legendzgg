<?php

namespace App\Repositories;
use App\Models\Inventario;

/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 24/09/2018
 * Time: 15:02
 */
class InventariosRepository extends AbstractRepository
{
    public $model;

    public function __construct(Inventario $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public  function jogadorItems($idJogador){

      return $this->model->with(['jogador','items'])->where(['jogador_id'=> $idJogador]);

  }

}