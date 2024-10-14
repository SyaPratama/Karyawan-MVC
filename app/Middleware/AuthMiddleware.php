<?php

namespace karyawanmvc\Middleware;

class AuthMiddleware implements Middleware
{
    public function before(): void
    {
        if (!isset($_SESSION["LOGGED"])) {
            header("Location: /");
            exit();
        }
    }
}
