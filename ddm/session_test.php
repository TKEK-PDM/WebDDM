<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    ini_set('session.save_path', '/var/www/html/ddm/ci_sessions'); 
    session_start();
    $_SESSION['test'] = 'Hello Session';
    echo session_id();

?>