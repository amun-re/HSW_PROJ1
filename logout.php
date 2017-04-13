<?php
include_once 'functions/mysql.php';
include_once 'functions/functions.php';
sec_session_start();
 
// Setze alle Session-Werte zurück 
$_SESSION = array();
 
// hole Session-Parameter 
$params = session_get_cookie_params();
 
// Lösche das aktuelle Cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Vernichte die Session 
session_destroy();
header('Location: index.php');
?>