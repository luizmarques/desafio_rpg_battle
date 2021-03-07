<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Oauthcreates extends Seeder
{
	/**
	 * inserção da aplicação cliente do auth.
	 * inserção do usuario para o cliente cadastrado acima.
	 * 
	 * @return JsonResponse
	*/
	public function run()
	{
		
		$client = model('Oauth_clients');
		
		$client->insert([
			'client_id'  => 'testclient',
			'client_secret' => 'testsecret',
			'grant_types' => 'password',
			'scope' => 'app',
		]);
		
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
