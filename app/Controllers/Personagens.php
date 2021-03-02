<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Personagens extends ResourceController
{
	protected $modelName = 'App\Models\Personagens';
	protected $format = 'json';

	public function herois()
	{
		$personagens = $this->model->where('natureza', 1)->findAll();
		return $this->respond($personagens);
	}
	
	public function monstros()
	{
		$personagens = $this->model->where('natureza', 2)->findAll();
		return $this->respond($personagens);
	}

	public function todos()
	{
		$personagens = $this->model->findAll();
		return $this->respond($personagens);
	}
}
