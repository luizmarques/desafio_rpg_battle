<?php

namespace App\Models;

use CodeIgniter\Model;

class CombateLogs extends Model
{
	protected $table = 'combate_logs';
	protected $primaryKey= 'combate_log';
	protected $allowedFields = ['combate_logs', 'dano', 'partida', 'personagem'];
}