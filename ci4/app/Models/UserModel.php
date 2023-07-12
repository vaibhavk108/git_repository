<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

 protected $table = 'employee_details';

 protected $primaryKey = 'id';

 protected $allowedFields = ['name','address','salary'];






}?>