<?php

namespace App\Repositories;
use App\Models\Loja;

/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 24/09/2018
 * Time: 15:02
 */
class LojaRepository extends AbstractRepository
{
    public $model;

    public function __construct(Loja $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }



}