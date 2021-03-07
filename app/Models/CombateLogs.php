<?php

namespace App\Models;

use CodeIgniter\Model;

class CombateLogs extends Model
{
	protected $table = 'combate_logs';
	protected $primaryKey= 'combate_log';
	protected $allowedFields = ['combate_log', 'dano', 'partida', 'personagem', 'username'];

	public function getDanoAplicado($partida, $personagem) {
		$builder = $this->db->table('combate_logs');

		$builder->selectSum("dano")
                ->where(array("partida" => $partida, "personagem" => $personagem));

        $consulta = $builder->get();
        
        return $consulta->getResult()[0]->dano;
	}
	
	public function getRodadas($partida) {
		$builder = $this->db->table('combate_logs');

		$builder->where(["partida" => $partida]);
        $total = $builder->countAllResults('combate_logs');

		return $total;
	}
}