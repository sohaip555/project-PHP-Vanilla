<?php


use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404): void
{
    http_response_code($code);

    require base_path("views\\".$code.".php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN): bool
{
    if (!$condition) {
        abort($status);
    }

    return true;
}


function base_path($path): string
{
    return BASE_PATH.$path;
}

function view($path, $attributes = []): void
{
    extract($attributes);

    require base_path('views\\'.$path);
}

function login($user): void
{
    $_SESSION['user'] = [
        'email' => $user['email'],
    ];

    session_regenerate_id(true);
}

function logout(): void
{
    $_SESSION = array();
    session_destroy();

    $params = session_get_cookie_params();

    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'],
        $params['httponly']);
}


function redirect($path)
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}