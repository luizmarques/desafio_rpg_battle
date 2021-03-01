<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthTable extends Migration
{
	public function up()
	{
		// oauth_clients
		$this->forge->addField([
			'client_id' => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,

			],
			'client_secret' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
			],
			'redirect_uri' => [
				'type' => 'VARCHAR',
				'constraint' => '2000',
			],
			'grant_types' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
			],
			'user_id' => [
				'type' => 'VARCHAR',
				'constraint' => '80',
			],
		]);

		$this->forge->addKey('client_id', true);
		$this->forge->createTable('oauth_clients');

		// oauth_access_tokens
		$this->forge->addField([
			'access_token' => [
				'type' => 'varchar',
				'constraint' => 40,
				'null' => false,

			],
			'client_id' => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,
			],
			'user_id' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'expires' => [
				'type' => 'TIMESTAMP',
				'null' => false,
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
			],
		]);

		$this->forge->addKey('access_token', true);
		$this->forge->createTable('oauth_access_tokens');

		// oauth_authorization_codes
		$this->forge->addField([
			'authorization_code' => [
				'type' => 'varchar',
				'constraint' => 40,
				'null' => false,

			],
			'client_id' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'user_id' => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,
			],
			'redirect_uri' => [
				'type' => 'varchar',
				'constraint' => 2000,
			],
			'expires' => [
				'type' => 'TIMESTAMP',
				'null' => false,
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
			],
			'id_token' => [
				'type' => 'VARCHAR',
				'constraint' => '1000',
			],
		]);

		$this->forge->addKey('authorization_code', true);
		$this->forge->createTable('oauth_authorization_codes');

		//Oauth_refresh_tokens
		$this->forge->addField([
			'refresh_token' => [
				'type' => 'varchar',
				'constraint' => 40,
				'null' => false,

			],
			'client_id' => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,
			],
			'user_id' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'expires' => [
				'type' => 'TIMESTAMP',
				'null' => false,
			],
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
			],
		]);

		$this->forge->addKey('refresh_token', true);
		$this->forge->createTable('oauth_refresh_tokens');

		//oauth_users
		$this->forge->addField([
			'username' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'password' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'first_name' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'last_name' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'email' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'email_verified' => [
				'type' => 'BOOLEAN',
			],			
			'scope' => [
				'type' => 'VARCHAR',
				'constraint' => '4000',
			],
		]);

		$this->forge->addKey('username', true);
		$this->forge->createTable('oauth_users');

		//Oauth_scopes
		$this->forge->addField([
			'scope' => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,
			],
			'is_default' => [
				'type' => 'BOOLEAN',
			],
		]);

		$this->forge->addKey('scope', true);
		$this->forge->createTable('oauth_scopes');

		//Oauth_jwt
		$this->forge->addField([
			'client_id' => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,
			],
			'subject' => [
				'type' => 'varchar',
				'constraint' => 80,
			],
			'public_key' => [
				'type' => 'varchar',
				'constraint' => 2000,
				'null' => false,
			],
		]);

		$this->forge->createTable('oauth_jwt');

	}

	public function down()
	{
		//Não é necessário para o projeto até aqui
	}
}