<?php

session_start();

$code = "pass12345";

$key = $_POST ['key'];

if ($key == $code)
{
	$_SESSION['key'] = $key;
	echo 
		"<script type='text/javascript'>
		alert('Ok!');
		window.location='../Admin/AdminTeask.php';
		</script>";
}
else
{
		echo 
		"<script type='text/javascript'>
		window.location='../SettingsPage/SettingsPage.php';
		</script>";
}


?>