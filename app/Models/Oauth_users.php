<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class Oauth_users extends Model
{
    protected $table = 'oauth_users';

    protected $allowedFields = ['username', 'password', 'first_name', 'last_name', 'email', 'email_verified', 'scope'];
}