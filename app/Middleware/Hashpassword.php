<?php

namespace App\Middleware;

class Hashpassword
{
    public string $password_hached;
  
    public function __construct($password)
    {
        $this->password_hached = password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function getHashedPassword(): string
    {
        return $this->password_hached;
    }
    
    public function checkPassword($password): bool
    {
        return password_verify($password, $this->password_hached);
    }
}
