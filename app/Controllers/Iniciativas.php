<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Partidas as PartidasModel;
use App\Models\Personagens as PersonagensModel;
use Ramsey\Uuid\Uuid;
use App\Traits\UserTrait;

class Iniciativas extends ResourceController
{
	use UserTrait;
	
	protected $modelName = 'App\Models\Iniciativas';
	protected $format = 'json';
	
	//Criando Iniciativa.
	public function iniciar(){
		$user = $this->getUserByToken($this->request);

		$partidasModel = new PartidasModel();
		$partida = $partidasModel->where(['username' => $user['user_id'], "finalizada" => 0])->findAll(); 
		if(count($partida))
		{
			if(!count($this->model->where("partida", $partida[0]["partida"])->findAll())) {
				$personagensModel = new PersonagensModel();
				$dadosPersonagens = $personagensModel->findAll();
			
				$monstro = $personagensModel->where('personagem', $partida[0]["monstro"])->findAll()[0];
				$heroi = $personagensModel->where('personagem', $partida[0]["heroi"])->findAll()[0];
				
				$diceMonstro = $diceHeroi = 0;

				while($diceMonstro == $diceHeroi) {
					$diceMonstro = rand(1,10) + $monstro["agilidade"];
					$diceHeroi = rand(1,10) + $heroi["agilidade"];
				}

				if($diceMonstro > $diceHeroi) {
					$ordem = 2;
				} else {
					$ordem = 1;
				}

				$data = [
					"ordem" => $ordem,
					"partida" => $partida[0]["partida"],
					"iniciativa" => Uuid::uuid4()
				];

				$this->model->insert($data);
				$data["heroi_iniciativa"] = $diceHeroi;
				$data["monstro_iniciativa"] = $diceMonstro;

				return $this->respondCreated($data);
			} else {
				return $this->fail(json_encode(["message" => "A iniciativa já foi rolada"]));	
			}
		} else {
			return $this->fail(json_encode(["message" => "Não existe partida iniciada para o usuário"]));
		}
	}
}