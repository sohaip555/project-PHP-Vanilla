<?php

namespace Core\middlerware;

class Guest
{


    public function handle()
    {
        if ($_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}


