<?php
include_once 'functions/mysql.php';
include_once 'functions/functions.php';

sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

include "templates/overview_template.php";
?>