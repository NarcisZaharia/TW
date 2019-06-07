<?php

session_start();

$con = mysqli_connect('localhost' , 'root', '');

mysqli_select_db($con , 'login');

$type = $_POST ['type'];
$question = $_POST ['question'];
$ans1 = $_POST ['ans1'];
$ans2 = $_POST ['ans2'];
$ans3 = $_POST ['ans3'];
$ans4 = $_POST ['ans4'];
$anscorrect = $_POST ['anscorrect'];

	$reg = "insert into tests (type, question, ans1, ans2, ans3, ans4, anscorrect) values ('$type' , '$question' , '$ans1' , '$ans2' , '$ans3' , '$ans4' , '$anscorrect')";
	mysqli_query($con , $reg);
	
	echo 
		"<script type='text/javascript'>
		window.location='AdminTeask.php';
		</script>";

?>
