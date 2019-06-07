<?php

session_start();

$con = mysqli_connect('localhost' , 'root', '', 'login');

$email = $_GET ['email'];
$password = $_GET ['password'];
$password = md5($password);

$s = "select * from users where email = '$email' && password = '$password'";

$result = mysqli_query($con , $s);
$num = mysqli_num_rows($result);

if ($num == 1)
{
	$_SESSION['email'] = $email;
	echo
    "<script type='text/javascript'>
		window.location='../Views/TeaSkMain.php';
		</script>";
}
else
{
	echo 
		"<script type='text/javascript'>
		alert('Wrong email/password!');
		window.location='../Views/TeaSkRL.php';
		</script>";
}

?>