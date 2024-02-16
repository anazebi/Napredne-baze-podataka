<?php

session_start();

class LogoutController
{
    public function index()
    {
        session_unset();
        session_abort();
        require_once __DIR__ . '/../view/login_index.php';
    }
}

?>
