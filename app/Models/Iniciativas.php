<?php

namespace App\Models;

use CodeIgniter\Model;

class Iniciativas extends Model
{
	protected $table = 'iniciativas';
	protected $primaryKey= 'iniciativa';
	protected $allowedFields = ['iniciativa', 'ordem', 'partida'];
}