<?php

namespace App\Repositories;

use App\Models\Rifa;

/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 24/09/2018
 * Time: 15:02
 */
class RifaRepository extends AbstractRepository
{
    public $model;

    public function __construct(Rifa $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        return $this->model->all();
    }



}