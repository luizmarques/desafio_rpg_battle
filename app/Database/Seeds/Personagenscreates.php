<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class Personagenscreates extends Seeder
{
	public function run()
	{
		//inserção de personagens
		$model = model('personagens');
		
		$model->insert([
			'personagem' => Uuid::uuid4(),
			'classe'  => 'Guerreiro',
			'natureza' => '1',
			'forca' => '4',
			'defesa' => '3',
			'agilidade' => '3',
			'fddano' => '4',
			'fqdano' => '2',
			'pdv' => '12',
		]);
		$model->insert([
			'personagem' => Uuid::uuid4(),
			'classe'  => 'Bárbaro',
			'natureza' => '1',
			'forca' => '6',
			'defesa' => '1',
			'agilidade' => '3',
			'fddano' => '6',
			'fqdano' => '2',
			'pdv' => '13',
		]);
		$model->insert([
			'personagem' => Uuid::uuid4(),
			'classe'  => 'Paladino',
			'natureza' => '1',
			'forca' => '2',
			'defesa' => '5',
			'agilidade' => '1',
			'fddano' => '4',
			'fqdano' => '2',
			'pdv' => '15',
		]);
		$model->insert([
			'personagem' => Uuid::uuid4(),
			'classe'  => 'Morto-Vivo',
			'natureza' => '2',
			'forca' => '4',
			'defesa' => '0',
			'agilidade' => '1',
			'fddano' => '4',
			'fqdano' => '2',
			'pdv' => '25',
		]);
		$model->insert([
			'personagem' => Uuid::uuid4(),
			'classe'  => 'Orc',
			'natureza' => '2',
			'forca' => '6',
			'defesa' => '2',
			'agilidade' => '2',
			'fddano' => '8',
			'fqdano' => '1',
			'pdv' => '20',
		]);
		$model->insert([
			'personagem' => Uuid::uuid4(),
			'classe'  => 'Kobold',
			'natureza' => '2',
			'forca' => '4',
			'defesa' => '2',
			'agilidade' => '4',
			'fddano' => '2',
			'fqdano' => '3',
			'pdv' => '20',
		]);
	}
}
