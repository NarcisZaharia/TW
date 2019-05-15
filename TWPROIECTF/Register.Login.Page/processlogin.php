<?php

session_start();

$con = mysqli_connect('localhost' , 'root', '');

mysqli_select_db($con , 'login');

$email = $_POST ['email'];
$password = $_POST ['password'];

$s = "select * from users where email = '$email' && password = '$password'";

$result = mysqli_query($con , $s);

$num = mysqli_num_rows($result);

if ($num == 1)
{
	$_SESSION['email'] = $email;
	echo 
		"<script type='text/javascript'>
		window.location='../MainPage/TeaSkMain.php';
		</script>";
}
else
{
	echo 
		"<script type='text/javascript'>
		alert('Wrong email/password!');
		window.location='TeaSkRL.php';
		</script>";
}

?>