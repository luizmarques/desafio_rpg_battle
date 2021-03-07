<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Rankings extends ResourceController
{
	protected $modelName = 'App\Models\Rankings';
	protected $format = 'json';

	/**
	 * Retona os rankings dos jodores em ordem decrescente.
	 * 
	 * @return JsonResponse
	*/
	public function index()
	{
		$data = $this->model->orderBy('pontuacao', "DESC")->findAll();
		return $this->respond($data);
	}
}
