<?php
session_start();
		$email = $_SESSION['email'];
		//echo "<br>";
		$con = mysqli_connect('localhost' , 'root', '');
		mysqli_select_db($con , 'login');
		
		$name = $_POST ['name'];
		$name1 = $_POST ['name1'];
		$pass = "select password from users where email = '$email'";
		$pass = mysqli_query($con , $pass);
		$pass = $pass->fetch_array();
		$pass = $pass[0];
		//echo $pass;
		//echo $name;
		//
		
		if($pass == $name1)
		{
            $s = "UPDATE  users set password = '$name' where email = '$email'";
            $result = mysqli_query($con , $s);

            echo "<script>
                    alert('Parola a fost schimbata');
                    window.location='SettingsPage.php';
                    </script>";
		}
		else 
		{
			echo "<script>
                    alert('Nu ati introdus corect parola curenta');
                    window.location='SettingsPage.php';
                    </script>";
		}
		
?>