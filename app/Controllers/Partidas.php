<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Partidas extends ResourceController
{
	protected $modelName = 'App\Models\Partidas';
	protected $format = 'json';
	
	//Iniciar uma partida.
	/*public function iniciar($nick, heroi)
	{
		helper(["form"]);

		$rules = [
			'partida' => 'required',
			'nick' => 'required',
			'finalizada' => 'required',
			'heroi' => 'required',
			'monstro' => 'required',
			'username' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErros());
		}else{
			$data = [
				'partida' => $this->request->getVar('partida'),
				'nick' => $this->request->getVar('nick'),
				'finalizada' => $this->request->getVar('finalizada'),
				'heroi' => $this->request->getVar('heroi'),
				'monstro' => $this->request->getVar('monstro'),
				'username' => $this->request->getVar('username'),
			];
			$partida = $this->model->insert($data);
			$data['partida'] = 'prtida';
			return $this->respondeCreated('$data');
		}
	}*/
}