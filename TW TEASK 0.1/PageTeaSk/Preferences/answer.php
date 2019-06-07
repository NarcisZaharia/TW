<?php
session_start();
$email = $_SESSION['email'];
$line1 = $_SESSION['line1'];


			$con = mysqli_connect('localhost' , 'root', '');
			mysqli_select_db($con , 'login');
			$reg2 = 'select anscorrect from tests where question =\''.$line1[1].'\'';
			
			$result = mysqli_query($con , $reg2);
			
			$result = $result->fetch_array();
			$result = $result[0];
			$name = $_POST ['name'];

			if($name == $result)
			{
				$reg2='update users set points = points+1 where email =\''.$email.'\'';
				mysqli_query($con ,$reg2);
				//echo $result;
				//echo "<br>";
				//echo $name;
				echo "<script type='text/javascript'>
				window.location='Preferences.php';
				</script>";
			}
			else
			{
				$reg2='update users set points = points-1 where email =\''.$email.'\'';
				mysqli_query($con ,$reg2);
				//echo $result;
				//echo "<br>";
				//echo $name;
				echo "<script type='text/javascript'>
				window.location='Preferences.php';
				</script>";
			}
				
				
			
		
			
			
			
				
				

			

?>