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
		window.location='../Views/AdminTeask.php';
		</script>";
}
else
{
		echo
        "<script type='text/javascript'>
		window.location='../Views/SettingsPage.php';
		</script>";
}


?>