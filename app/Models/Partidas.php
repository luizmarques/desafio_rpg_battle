<?php

namespace App\Models;

use CodeIgniter\Model;

class Partidas extends Model
{
	protected $table = 'partidas';
	protected $primaryKey= 'partida';
	protected $allowedFields = ['partida', 'nick', 'finalizada','heroi','monstro','username'];
}