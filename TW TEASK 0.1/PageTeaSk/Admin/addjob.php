<?php

session_start();

$con = mysqli_connect('localhost' , 'root', '');

mysqli_select_db($con , 'login');

$name = $_POST ['event'];
$company = $_POST ['company'];
$type = $_POST ['type'];
$href = $_POST ['href'];


	$reg = "insert into jobs (name, company, type, href) values ('$name' , '$company' , '$type' , '$href')";
	mysqli_query($con , $reg);
	
	echo 
		"<script type='text/javascript'>
		window.location='AdminTeask.php';
		</script>";

?>


