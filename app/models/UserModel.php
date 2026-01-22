<?php
namespace App\Models;

// use App\Core\Database;
use App\Middleware\Hashpassword;
use App\Middleware\Validator;
use App\Models\User;
use App\Repositories\UserRepository;

class UserModel extends User
{
    private ?int $id = null;
    private string $email;
    private string $password;  
    private UserRepository $userRepository;
    
    public function __construct($pdo)
    {
        $this->userRepository = new UserRepository($pdo);
    }
    public function findByEmail($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }
    public function create($email, $password, $phone_number, $role = 'candidate', $firstName = '', $lastName = '')
    {
      // Validate email and ensure it doesn't already exist
      if (!Validator::validateEmail($email) || $this->findByEmail($email)) {
        return false;
      }

      $hashedPassword = (new Hashpassword($password))->getHashedPassword();
      return $this->userRepository->createWithRole($email, $hashedPassword, $phone_number, $role, $firstName, $lastName);
    }
       
    public function verify(string $email, string $password): bool
    {
      return $this->userRepository->verifyPassword($email, $password);
    }
}

