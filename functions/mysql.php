<?php
error_reporting(E_ALL);
/**
 * Das sind die Login-Angaben für die Datenbank
 */  
define("HOST", "localhost");     // Der Host mit dem du dich verbinden willst.
define("USER", "root");    // Der Datenbank-Benutzername. 
define("PASSWORD", "");    // Das Datenbank-Passwort. 
define("DATABASE", "hswproj1");    // Der Datenbankname.
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // NUR FÜR DIE ENTWICKLUNG!!!!
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>