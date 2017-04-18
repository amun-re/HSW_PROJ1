<?php
include_once 'functions/mysql.php';
include_once 'functions/functions.php';

sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

include "templates/overview_template_head.php";
if (login_check($mysqli) == true) 
{
 include "templates/overview_template_body.php";
}
else
{
 include "templates/noaccess_template_body.php";	
}
include "templates/overview_template_food.php";
 ?>