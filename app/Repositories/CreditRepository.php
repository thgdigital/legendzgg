<?php

namespace App\Repositories;
use App\Models\Credit;


/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 24/09/2018
 * Time: 15:02
 */
class CreditRepository extends AbstractRepository
{
    public $model;

    public function __construct(Credit $model)
    {
        $this->model = $model;
    }



}