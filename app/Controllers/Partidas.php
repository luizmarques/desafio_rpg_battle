<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Personagens as PersonagensModel;
use Ramsey\Uuid\Uuid;
use App\Traits\UserTrait;

class Partidas extends ResourceController
{
	use UserTrait;
	
	protected $modelName = 'App\Models\Partidas';
	protected $format = 'json';
	
	//Iniciar uma partida.
	public function iniciar(){
		helper(["form"]);
		
		$rules = [
			'nick' => 'required',
			'heroi' => 'required',
		];

		if(!$this->validate($rules)){
			return $this->fail($this->validator->getErrors());
		}else{
			
			$user = $this->getUserByToken($this->request);
			if(!count($this->model->where(['username' => $user['user_id'], "finalizada" => 0])->findAll()))
			{
				$personagensModel = new PersonagensModel();
				$monstros = $personagensModel->where('natureza', 2)->findAll();
				$monstro = $monstros[rand(0,count($monstros) - 1)]['personagem'];

				$partida = Uuid::uuid4();
				$data = [
					'partida' => $partida,
					'nick' => $this->request->getVar('nick'),
					'heroi' => $this->request->getVar('heroi'),
					'monstro' => $monstro,
					"username" => $user['user_id']
				];

				$this->model->insert($data);
				$data['partida'] = $partida;
				return $this->respondCreated($data);

			} else {
				return $this->fail(json_encode(["message" => "Já existe partida iniciada para o usuário"]));
			}
			
		}
	}
}