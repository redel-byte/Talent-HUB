<?php

namespace App\Models;

use App\Core\Database;
use App\Core\Hashpassword;
use App\Core\Validator;



namespace App\Models;

abstract class User
{
  protected int $id;
  protected string $fullname;
  protected string $email;
  protected string $password;
  protected string $phone_number;
  protected int $role_id;
}
