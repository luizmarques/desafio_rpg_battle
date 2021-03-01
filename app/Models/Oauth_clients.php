<?php 
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class Oauth_clients extends Model
{
    protected $table = 'oauth_clients';
    protected $allowedFields = ['client_id', 'client_secret', 'redirect_uri','grant_types','scope'];
}