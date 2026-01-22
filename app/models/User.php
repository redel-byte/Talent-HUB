<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Hashpassword;
use App\Core\Validator;



namespace App\Models;

abstract class User
{
  public int $id;
  public $fullname;
  public string $email;
  public string $password;
  public string $phone_number;
  public int $role_id;
}
