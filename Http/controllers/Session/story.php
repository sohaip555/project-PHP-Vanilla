<?php


use Core\Authenticator;
use Core\Session;
use Http\forms\LoginForm;


$email = $_POST['email'];
$password = $_POST['password'];
$errors = [];
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);


$signedIn = (new Authenticator())->attempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) {
    $form->error(
        'email', 'No matching account found for that email address and password.'
    )->throw();
}

Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $_POST['email']
]);

redirect('/');





