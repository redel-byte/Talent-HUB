<?php

namespace Youcode\WorkshopMvc\Controllers;

use Youcode\WorkshopMvc\Core\Database;
use Youcode\WorkshopMvc\Models\User;
use Youcode\WorkshopMvc\Core\Validator;

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /systemAuth/login');
  exit();
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password) || !Validator::validateEmail($email)) {
  $_SESSION['error'] = 'Please provide a valid email and password.';
  $_SESSION['old_email'] = $email;
  header('Location: /systemAuth/login');
  exit();
}

$userModel = new User(Database::connection());
$user = $userModel->findByEmail($email);

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['email'] = $user['email'];
  $_SESSION['role'] = $user['role'] ?? 'candidate';
  header('Location: /Dashboard');
  exit();
}

$_SESSION['error'] = 'Invalid email or password.';
$_SESSION['old_email'] = $email;
header('Location: /login');
exit();




