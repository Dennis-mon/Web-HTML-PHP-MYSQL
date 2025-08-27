<?php

    setcookie('recordarme');
    setcookie('recordarme', '', time() - 42000, '/');

    setcookie('tiempo');
    setcookie('tiempo', '', time() - 42000, '/');

    $_SESSION = array();
    if(isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
    session_destroy();

    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'index.php';
    header("Location: http://$host$uri/$extra");
    exit;

