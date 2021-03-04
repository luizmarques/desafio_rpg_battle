<?php

namespace App\Models;

use CodeIgniter\Model;

class Oauthaccesstoken extends Model
{
	protected $table = 'oauth_access_tokens';
	protected $primaryKey= 'access_token';
    protected $allowedFields = ['access_token', 'client_id', 'user_id', 'scope'];
}
