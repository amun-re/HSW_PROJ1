<?php
include_once 'functions/mysql.php';
include_once 'functions/functions.php';

sec_session_start();
 
include "templates/overview_template_head.php";
$login = login_check($mysqli);
if ($login) 
{
	echo '<body><div>';
	
	include "templates/overview_template_body.php";
	$page = "";
	if(isset($_GET['page']))
	 $page = $_GET['page'];
	
	$pageFunc = getPageFunctions($page);
	
	$dataArray = getPageData($page,$mysqli);
	if($pageFunc != "") include getPageFunctions($page);
	include getTemplate($page);
	echo "</div></body>";
}
else
{
 include "templates/noaccess_template_body.php";	
}
include "templates/overview_template_food.php";
 ?>