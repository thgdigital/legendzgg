<?php

namespace App\Repositories;
use App\Models\Jogador;


/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 24/09/2018
 * Time: 15:02
 */
class JogadorRepository extends AbstractRepository
{
    public $model;

    public function __construct(Jogador $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }

    public function findAllOrder(){

        return $this->model->with('order')->orderBy('updated_at', 'desc')->get();
    }
    public function findIdOrder($id){

        return $this->model->where(['id'=> $id])->with('order')->orderBy('updated_at', 'desc')->get();
    }

}