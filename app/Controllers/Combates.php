<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Partidas as PartidasModel;
use App\Models\Personagens as PersonagensModel;
use App\Models\Iniciativas as IniciativasModel;
use App\Models\CombateLogs as CombateLogsModel;
use App\Models\Rankings as RankingsModel;
use Ramsey\Uuid\Uuid;
use App\Traits\UserTrait;
use Ds\Queue;

class Combates extends ResourceController
{
	use UserTrait;
	
	protected $modelName = 'App\Models\CombateLogs';
	protected $format = 'json';
	
	/**
	 * Atacar adversário.
	 * 
     * @return JsonResponse
     */
	public function atacar(){
		$user = $this->getUserByToken($this->request);

		$partidasModel = new PartidasModel();
		$partida = $partidasModel->where(['username' => $user['user_id'], "finalizada" => 0])->findAll(); 
		if(count($partida))
		{
			$iniciativasModel = new IniciativasModel();
			$combateLogsModel = new CombateLogsModel();
			$personagensModel = new PersonagensModel();
			$rankingsModel = new RankingsModel();

			/**
			 * 
			 * Consuta iniciativas roladas.
			 * 
			*/
			$iniciativa = $iniciativasModel->where("partida", $partida[0]['partida'])->findAll();
			if(!count($iniciativa)) {
				return $this->fail(json_encode(["message" => "Não existe iniciativa rolada para a partida"]));
			}

			$monstro = $personagensModel->where('personagem', $partida[0]["monstro"])->findAll()[0];
			$heroi = $personagensModel->where('personagem', $partida[0]["heroi"])->findAll()[0];
			
			/**
			 * 
			 * Ordena iniciativas para definir o primeiro atacante.
			 * Realiza o ataque de acordo com as iniciativas.
			 * Calcula dano recebido nos turnos anteriores
			 * Ordena e manipula um array para gerir os ataques até que um dos adversários chegue a 0 Pdv.
			 * Cria um registro de todos os ataques no Combat_Log.
			 * Manipula e registra o Ranking dos jogadores.
			 * Imprime em tela o resultado do combate e rankgs para o jogador.
			 * 
			*/
			$filaAtaque = [];
			$iniciativa[0]["ordem"] == 1 ? array_push($filaAtaque, $heroi, $monstro) : array_push($filaAtaque, $monstro, $heroi);
			
			$atacante = 0;
			$defensor = 1;
			$combateLog = [];
			$rodada = 1;
			
			while($filaAtaque[$atacante]["pdv"] > 0 && $rodada <= 2) {
				$danoDefensor = $combateLogsModel->getDanoAplicado($partida[0]['partida'], $filaAtaque[$atacante]["personagem"]);
				$filaAtaque[$defensor]["pdv"] -= $danoDefensor;
				
				$ataque = $filaAtaque[$atacante]["forca"] + $filaAtaque[$atacante]["agilidade"] + rand(1, 10);
				$defesa = $filaAtaque[$defensor]["defesa"] + $filaAtaque[$defensor]["agilidade"] + rand(1, 10);

				if($ataque > $defesa) {
					$dano =$filaAtaque[$atacante]["forca"];
					
					for($i = 0; $i < $filaAtaque[$atacante]["fqdano"]; $i++) {
						$dano += rand(1, $filaAtaque[$atacante]["fddano"]);
					}
					$filaAtaque[$defensor]["pdv"] -= $dano;

				} else {
					$dano = 0;
				}
					
				$combateLogsModel->insert([
					"combate_log" => Uuid::uuid4(),
					"partida" => $partida[0]['partida'],
					"personagem" => $filaAtaque[$atacante]["personagem"],
					"dano" => $dano,
					"username" => $user['user_id']
				]);

				$combateLog[] = [
					"atacante" => $filaAtaque[$atacante]["classe"],
					"ataque" => $ataque,
					"defesa" => $defesa,
					"dano" => $dano,
					"pdv do defensor" => $filaAtaque[$defensor]["pdv"]
				];

				$aux = $atacante;
				$atacante = $defensor;
				$defensor = $aux;
				$rodada++;
			}
			
			if($filaAtaque[$atacante]["pdv"] <= 0) {
				$partidasModel->update($partida[0]["partida"], ["finalizada" => 1]);

				$ganhador = $filaAtaque[$defensor];
				$ranking = $rankingsModel->where('username', $user['user_id'])->findAll(); 
	
				if($filaAtaque[$defensor]["natureza"] == 1){
					$rodadas = $combateLogsModel->getRodadas($partida[0]['partida']);
					if(count($ranking)) {
						$rankingsModel->update($ranking[0]["ranking"],[
							"pontuacao" => $ranking[0]["pontuacao"] + (100 - $rodadas)
						]);
					} else {
						$rankingsModel->insert([
							"ranking" => Uuid::uuid4(),
							"pontuacao" => 100 - $rodadas,
							"username" => $user['user_id']
						]);
					}
	
					$response["message"] = "O jogador ganhou a partida!";
				} else {
					if(!count($ranking)) {
						$rankingsModel->insert([
							"ranking" => Uuid::uuid4(),
							"pontuacao" => 0,
							"username" => $user['user_id']
						]);
					}

					$response["message"] = "O jogador perdeu a partida!";
				}
			} else {
				$response["message"] = "Role seu ataque novamente!";
			}

			$response["combate_log"] = $combateLog;

			return $this->respondCreated($response);
		} else {
			return $this->fail(json_encode(["message" => "Não existe partida iniciada para o usuário"]));
		}
	}
}