# Desafio Desenvolvedor - RPG Battle

## Objetivo

Criar uma simulação de um combate de RPG entre Heróis e Monstros.

## Instalação

- Executar no terminar com a pasta do projeto selecionado: `composer install`
- Criar banco de dados chamado "rpg_battle"
- Duplicar arquiv `env` para `.env`
- Configurar usuário de banco de dados nos arquivos `app/Config/Database.php` e `.env`
- Executar no terminar com a pasta do projeto selecionado: `php spark migrate`
- Executar no terminar com a pasta do projeto selecionado: `php spark db:seed Oauthcreates` e  `php spark db:seed Personagenscreates`
- Configurar o Apache(httpd.conf) `DocumentRoot` e `<Directory>` com a pasta do projeto selecionado: ` "raiz do projeto"`

## Background

Para teste, foi criado um usuário chamado `teste` com a senha `teste`, outros usuários e senhas podem ser criados e modificando o arquivo `app/Databases/Seeds/Oauthcreates.php` e executando o comando  `php spark db:seed Oauthcreates` novamente.

## APIs
|     APIs                          | Descrição                                                              																	                     |
|---------------------------------------|------------------------------------------------------------------------------------------------------------------------------|
| users                       | Login com  autenticação `OAuth2`                                          																							 		 |
| personagens                           |  Json com os dados dos Heróis e/ou Monstros                                     																									 		 |
| partidas                               | Cria e inicia a uma partida 												             		 																								 		 |
| iniciativas                           |   Define o primeiro atacante                                 																									 		 |
| combates                              | Json com informações sobre o combate                    																									 		 |
| rankings                           | Json com informações dos Rankings dos jogadores 								 		 |
| combat_logs                           | Json com informações de todos os registros dos combates  																									 								 		 |