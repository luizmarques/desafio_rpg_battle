<?php

namespace App\Traits;

use App\Models\Oauthaccesstoken as OauthaccesstokenModel;

trait UserTrait 
{
	private function getUserByToken($request)
	{
		$token = $request->getHeader("Authorization")->getValue();
		$oauthaccesstokenModel = new OauthaccesstokenModel();
		$user = $oauthaccesstokenModel->find(str_replace('Bearer ' ,  '' , $token));
		return $user;
	}
}