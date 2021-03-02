<?php

namespace App\Models;

use CodeIgniter\Model;

class Rankings extends Model
{
	protected $table = 'rankings';
	protected $primaryKey= 'ranking';
	protected $allowedFields = ['ranking', 'pontuacao', 'username'];
}