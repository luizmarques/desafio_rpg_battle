<?php

namespace App\Models;

use CodeIgniter\Model;

class Personagens extends Model
{	
	protected $table = 'personagens';
	protected $primaryKey= 'personagem';
	protected $allowedFields = ['personagem', 'classe', 'natureza','forca','defesa','agilidade','fddano','fqdano','pdv'];
}
