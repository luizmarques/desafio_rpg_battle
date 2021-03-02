<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabelasrpg extends Migration
{
	public function up()
	{
		//personagens
		$this->forge->addField([
			'personagem'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'natureza' => [
				'type' => 'int',
				'null' => false,
			],
			'classe'  => [
				'type' => 'varchar',
				'constraint' => 45,
				'null' => false,
			],
			'forca'  => [
				'type' => 'int',
				'null' => false,
			],
			'agilidade'  => [
				'type' => 'int',
				'null' => false,
			],
			'defesa'  => [
				'type' => 'int',
				'null' => false,
			],
			'pdv'  => [
				'type' => 'int',
				'null' => false,
			],
			'fddano'  => [
				'type' => 'int',
				'null' => false,
			],
			'fqdano'  => [
				'type' => 'int',
				'null' => false,
			],
		]);
		$this->forge->addKey('personagem', true);
		$this->forge->createTable('personagens');

		//partidas
		$this->forge->addField([
			'partida'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'nick'  => [
				'type' => 'varchar',
				'constraint' => 45,
				'null' => false,
			],
			'finalizada'  => [
				'type' => 'TINYINT(1)',
			],
			'heroi'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'monstro'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'username'  => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,
			],

		]);
		$this->forge->addForeignKey('heroi', 'personagens', 'personagem');
		$this->forge->addForeignKey('monstro', 'personagens', 'personagem');
		$this->forge->addForeignKey('username', 'oauth_users', 'username');
		$this->forge->addKey('partida', true);
		$this->forge->createTable('partidas');

		//iniciativas
		$this->forge->addField([
			'iniciativa'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'ordem'  => [
				'type' => 'int',
				'null' => false,
			],
			'partida'  => [
				'type' => 'varchar',
				'constraint' => 45,
				'null' => false,
			],
			
		]);
		$this->forge->addForeignKey('partida', 'partidas', 'partida');
		$this->forge->addKey('iniciativa', true);
		$this->forge->createTable('iniciativas');

		//rankings
		$this->forge->addField([
			'ranking'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'pontuacao'  => [
				'type' => 'int',
				'null' => false,
			],
			'username'  => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,
			],
			
		]);
		$this->forge->addForeignKey('username', 'oauth_users', 'username');
		$this->forge->addKey('ranking', true);
		$this->forge->createTable('rankings');

		//combate_log
		$this->forge->addField([
			'combate_log'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'partida'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'personagem'  => [
				'type' => 'varchar',
				'constraint' => 36,
				'null' => false,
			],
			'dano'  => [
				'type' => 'int',
				'null' => false,
			],
			'username'  => [
				'type' => 'varchar',
				'constraint' => 80,
				'null' => false,
			],
			
		]);
		$this->forge->addForeignKey('partida', 'partidas', 'partida');
		$this->forge->addForeignKey('personagem', 'personagens', 'personagem');
		$this->forge->addForeignKey('username', 'oauth_users', 'username');
		$this->forge->addKey('combate_log', true);
		$this->forge->createTable('combate_logs');

	}

	public function down()
	{
		//
	}
}
