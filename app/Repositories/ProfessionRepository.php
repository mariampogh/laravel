<?php

namespace Laravel\Repositories;

use Laravel\Contract\ProfessionContract;
use Laravel\Profession;


class ProfessionRepository implements ProfessionContract  
{
	
	private $model;

    public function __construct(Profession $model)
    {
        $this->model = $model;
    }
    public function getById($id)
    {
        return $this->model->find($id)->with('questions')->first();
    }

}