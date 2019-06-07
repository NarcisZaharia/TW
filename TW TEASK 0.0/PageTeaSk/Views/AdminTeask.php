<?php

session_start();
if(!isset($_SESSION['photo']))
{
	session_destroy();
	header('location:../index.php');
	exit;
}

?>

<!DOCTYPE html>
<html lang = "ro">
<head>
	<link rel="stylesheet" href="AdminPage.css">
	<title>TEASK</title>	
	<meta charset="UTF-8">
	
</head>
<body>
  <main>
    <div id="id1">
	  <p class = "h1"><b><font color = "purple">Welcome:</font> ADMIN </b></p>
    </div >
	 <div id="id2" class = "margintop50">
		<p><b><font color = "red" size = "6">Add JOBS/EVENTS</font></b></p><br><br>

			<form action="../Controllers/addjob.php" method = "POST">
				<div style = "text-align:right;" class = "styleregister">
					 <p><label>Event name: </label><input type="name" name="event" required></p>
					 <p><label>Company:  </label><input type="name" name="company" required></p>
					 <p><label>Type of job/event: </label><input type="name" name="type" required></p>
					 <p><label>Href to site: </label><input type="name" name="href" required></p>
				</div>
					<input type="submit" value="ADD" class="button">
					<p><a href = "../Controllers/logout.php"><b>Logout</b></a></p>
			</form>
	</div>
	</div>
  </main>  
</body>
</html>