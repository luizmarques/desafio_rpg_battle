# Desafio Desenvolvedor - RPG Battle.

## Objetivo

Criar uma simulação de um combate de RPG entre Heróis e Monstros.

## Instalação

- Executar no terminar com a pasta do projeto selecionado: `composer install`
- Criar banco de dados chamado "rpg_battle"
- Duplicar arquiv `env` para `.env`
- Configurar usuário de banco de dados nos arquivos `app/Config/Database.php` e `.env`
- Executar no terminar com a pasta do projeto selecionado: `php spark migrate`
- Executar no terminar com a pasta do projeto selecionado: `php spark db:seed Oauthcreates` e  `php spark db:seed Personagenscreates`

## Background

Para teste, foi criado um usuário chamado `teste` com a senha `teste`, outros usuários e senhas podem ser criados e modificando o arquivo `app/Databases/Seeds/Oauthcreates.php` e executando o comando  `php spark db:seed Oauthcreates` novamente.

## Requisição de Login.

> `url_base/public/user/login`

| Metodo  | URI  | Descrição                                                               | Response       |
|---------|------|-------------------------------------------------------------------------|---------------|
| POST    |      | Autenticação de usuários                            | Object         |


### Request
```json
{
    "grant_type": "string (password)",
	"username": "string",
    "password": "string"
} 
```

### Response

#### Status: 200 - OK
```json
{
    "access_token":  "string",
    "expires_in": "integer",
    "token_type": "string",
    "scope": "integer",    
    "refresh_token": "string"
}   
```
## Requisição para iniciar as partidas.

### Endpoint

> `url_base/public/partidas/iniciar`

| Metodo  | URI  | Descrição                                                               | Response       |
|---------|------|-------------------------------------------------------------------------|---------------|
| POST    |      | Iniciar partida                            | Object         |


### Request
```json
{
    "nick": "GordinH",
    "heroi": "d13cf4a5-c502-464c-aae4-3ab0c79fb24c"
}
```
### Response

#### Status: 201 - OK
```json
{
    "partida": "guid",
    "nick": "string",
    "heroi": "guid",
    "monstro": "guid",
    "username": "string"
}
```
#### Status: 400 - OK
```json
{
    "status": "integer",
    "error": "integer",
    "messages": {
        "error": "string"
    }
}
```

## Requisição das iniciativas.

### Endpoint

> `url_base/public/iniciativas/iniciar`

| Metodo  | URI  | Descrição                                                               | Response       |
|---------|------|-------------------------------------------------------------------------|---------------|
| POST    |      | Gerar iniciativas                            | Object         |


### Response

#### Status: 201 - OK
```json
{
    "ordem": "integer",
    "partida": "guid",
    "iniciativa": "guid",
    "heroi_iniciativa": "integer",
    "monstro_iniciativa": "integer"
}
```
#### Status: 400 - OK
```json
{
    "status": "integer",
    "error": "integer",
    "messages": {
        "error": "string"
    }
}
```

## Requisição dos combates.

### Endpoint

> `url_base/public/combates/atacar`

| Metodo  | URI  | Descrição                                                               | Response       |
|---------|------|-------------------------------------------------------------------------|---------------|
| POST    |      | Execução dos combates                          | Object         |


### Response

#### Status: 201 - OK
```json
{
    "message": "string",
    "combate_log": "array"
}
```
#### Status: 400 - OK
```json
{
    "status": "integer",
    "error": "integer",
    "messages": {
        "error": "string"
    }
}
```
## Consulta aos personagens

### Endpoint

> `url_base/public/personagens/(todos/herois/monstros)`

| Metodo  | URI  | Descrição                                                               | Response       |
|---------|------|-------------------------------------------------------------------------|---------------|
| GET    |      | Consulta os personagens (todos/herois/monstros) no banco de dados   | Object         |


### Response

#### Status: 200 - OK
```json
{
	"personagem": "guid",
	"natureza": "integer",
	"classe": "string",
	"forca": "integer",
	"agilidade": "integer",
	"defesa": "integer",
	"pdv": "integer",
	"fddano": "integer",
	"fqdano": "integer"
},
```