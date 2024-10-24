<?php


use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];


$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password, 1, 255)) {
    $errors['password'] = 'Please provide a password at least 7 characters';
}

if (!empty($errors)) {
    return view('registration\create.view.php',
        ['errors' => $errors]);
}

$db = \Core\App::resolve(Database::class);

$result = $db->query("SELECT * FROM users WHERE email = :email", [
    'email' => $email,
])->find();


if ($result) {
    header("Location: /");
    exit();
} else {
    $db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);
    login([
        'email' => $email,
    ]);
    header("Location: /");
    exit();
}

