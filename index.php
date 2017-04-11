<?php
session_start();
include "functions/mysql.php";

$showFormular = false; //Variable ob das Registrierungsformular anezeigt werden soll
var_dump($_POST);
if(isset($_POST['register']) || (isset($_POST['submit']) && $_POST['submit'] == "Registrieren"))
{
	$showFormular = true;
}
if(!isset($_POST['register']) && isset($_POST['submit']) && $_POST['submit'] == "Login")
{
	$showFormular = false;
}
if(isset($_POST['register']) && $_POST['register'] == "true") 
 {
  $error = false;
  $email = $_POST['email'];
  $passwort = $_POST['passwort'];
  $passwort2 = $_POST['passwort2'];
  
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
   $error = true;
   }  
   if(strlen($passwort) == 0) {
    echo 'Bitte ein Passwort angeben<br>';
    $error = true;
   }
 
 if($passwort != $passwort2) {
 echo 'Die Passwörter müssen übereinstimmen<br>';
 $error = true;
 }
 
 //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
 if(!$error) { 
 $statement = $pdo->prepare("SELECT id FROM users WHERE email = :email");
 $result = $statement->execute(array('email' => $email));
 $user = $statement->fetch();
 
 if($user !== false) {
 echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
 $error = true;
 } 
 }
 
 //Keine Fehler, wir können den Nutzer registrieren
 if(!$error) { 
 $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
 
 $statement = $pdo->prepare("INSERT INTO users (email, passwort) VALUES (:email, :passwort)");
 $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash));
 
 if($result) { 
 echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
 $showFormular = false;
 } else {
 echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
 }
 } 
}


include "templates/login_template_head.php";
include "templates/login_template_body.php";
include "templates/login_template_food.php";
?>