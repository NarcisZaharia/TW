<?php

session_start();

$con = mysqli_connect('localhost' , 'root', '');

mysqli_select_db($con , 'login');

$firstname = $_POST ['firstname'];
$lastname = $_POST ['lastname'];
$email = $_POST ['email'];
$password = $_POST ['password'];

$s = "select * from users where email = '$email' ";

$result = mysqli_query($con , $s);

$num = mysqli_num_rows($result);

if($num == 1)
{		
		echo 
		"<script type='text/javascript'>alert('Email already exist!');
		window.location='TeaSkRL.html';
		</script>";

}
else
{
	$reg = "insert into users (firstname , lastname , email , password) values ('$firstname' , '$lastname' , '$email' , '$password')";
	mysqli_query($con , $reg);
	
	echo 
		"<script type='text/javascript'>alert('Register succsessfuly!');
		window.location='TeaSkRL.html';
		</script>";
}

?>


