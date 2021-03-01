<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Oauthcreates extends Seeder
{
	public function run()
	{
		//inserção da aplicação cliente do auth
		$client = model('Oauth_clients');
		
		$client->insert([
			'client_id'  => 'testclient',
			'client_secret' => 'testsecret',
			'grant_types' => 'password',
			'scope' => 'app',
		]);
		
		//inserção do usuario para o cliente cadastrado acima
		$model = model('Oauth_users');
		
		$model->insert([
			'username'  => 'luiz',
			'password' => sha1('password'),
			'first_name' => 'luiz',
			'last_name' => 'marques',
			'email' => 'luiz_alak@hotmail.com',
			'email_verified' => 1,
			'scope' => 'app',
		]);
	}
}
