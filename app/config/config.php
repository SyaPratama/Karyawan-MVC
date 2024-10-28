<?php

$url = $_SERVER["PHP_SELF"];
if ($url !== "/index.php") {
    $servername = $_SERVER["SERVER_NAME"];
    $url = rtrim($url, 'public/index.php');
    $GLOBALS["BASEURL"]  = "http://$servername" . $url;
} else {
    $servername = $_SERVER["SERVER_NAME"];
    $GLOBALS["BASEURL"]  = "http://$servername";
}
