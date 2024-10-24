<?php

namespace Core;

class Authenticator
{

    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query("SELECT * from users where email = :email",
            [':email' => $email])->find();


        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);

                return true;
            }
        }
    }


    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'],
            $params['httponly']);

//        print_r($_SESSION);
//
//        Session::destroy();
    }
}