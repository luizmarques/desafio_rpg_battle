<?php

namespace App\Controllers;

use \App\Libraries\Oauth;
use \OAuth2\Request;
use CodeIgniter\API\ResponseTrait;

class User extends BaseController
{
	use ResponseTrait;

	public function login()
	{
		$oauth = new Oauth();
		$request = new Request();
		$response = $oauth->server->handleTokenRequest($request->createFromGlobals());
		$code = $response->getStatusCode();
		$body = $response->getResponseBody();

		return $this->respond(json_decode($body), $code);
	}
}
 