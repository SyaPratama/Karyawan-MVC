<?php

namespace karyawanmvc\Middleware;

class AuthMiddleware implements Middleware
{
    public function before(): void
    {
        $BASEURL = $GLOBALS["BASEURL"];
        if (!isset($_SESSION["LOGGED"]) && isset($_GET["url"])) {
            header("Location: $BASEURL");
            exit();
        }
    }
}
