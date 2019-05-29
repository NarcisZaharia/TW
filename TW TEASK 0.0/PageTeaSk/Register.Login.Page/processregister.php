<?php

session_start();

$con = mysqli_connect('localhost' , 'root', '');

mysqli_select_db($con , 'login');

$firstname = $_POST ['firstname'];
$lastname = $_POST ['lastname'];
$email = $_POST ['email'];
$password = $_POST ['password'];


if((strlen($password)>3)&&(preg_match('/^[A-Z][a-z]+$/u',$firstname))&&(preg_match('/^[A-Z][a-z]+$/u',$lastname)))
{

$s = " select * from users where email = '$email' ";

$result = mysqli_query($con , $s);

$num = mysqli_num_rows($result);


if($num == 1)
{		
		echo 
		"<script type='text/javascript'>alert('Email already exist!');
		window.location='TeaSkRL.php';
		</script>";

}
else
{
	$reg = "insert into users (firstname , lastname , email , password, imagename, image) values ('$firstname' , '$lastname' , '$email' , '$password', '', '')";
	mysqli_query($con , $reg);
	
	echo 
		"<script type='text/javascript'>alert('Register succsessfuly!');
		window.location='TeaSkRL.php';
		</script>";
}

}

else
	
{
	echo 
		"<script type='text/javascript'>alert('Password must be at least 4 characters + FirstName and LastName must start with Big Letter and be valid');
		window.location='TeaSkRL.php';
		</script>";
}	

?>


