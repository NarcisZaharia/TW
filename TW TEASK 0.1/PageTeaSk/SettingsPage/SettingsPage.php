<?php

session_start();
if(!isset($_SESSION['email']))
{
	header('location:../index.php');
}

include('../../simple_html_dom.php');

$html = file_get_html('https://www.meetup.com/find/tech/');
$html1 = file_get_html('https://www.bestjobs.eu/ro/locuri-de-munca?keyword=IT&location=');

?>

<!DOCTYPE html>
<html lang = "ro">
<head>
	<link rel="stylesheet" href="SettingsPage.css">
	<title>TEASK</title>	
	<meta charset="UTF-8">
	
	<?php

		//imagine inserare 
		//echo $_SESSION['email'];
		$email = $_SESSION['email'];
		//echo "<br>";
		$con = mysqli_connect('localhost' , 'root', '');
		mysqli_select_db($con , 'login');
		
		//
		$s = 'select firstname,lastname,email,password from users where email =\''.$email.'\'';
		$result = mysqli_query($con , $s);
		
		//	$data= $result->fetch_array()[3];
		$line = $result->fetch_array();
		
		
		if(isset($_POST['submit']))
			{
			$filename = addslashes($_FILES['img']['name']);
			$tmpname = addslashes(@file_get_contents($_FILES['img']['tmp_name']));
			$filetype = addslashes($_FILES['img']['type']);
			$filesize = addslashes($_FILES['img']['size']);
			$array = array('jpg','jpeg');
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!empty($filename))
				{
					if(in_array($ext, $array))
					{
						;
						$reg="UPDATE  users set imagename = '$filename' ,image = '$tmpname' where email = '$line[2]'";
						
						if ($con->query($reg) === TRUE) {
						 //echo "Record updated successfully";
						   } else {
						//echo "Error updating record: " . $con->error;
}
						
					}
						else
					{
						//echo "failed";
					}			
				}
			}
		
		
			$res = mysqli_query($con , "SELECT * FROM users where email = '$line[2]'");
			
			while($row = mysqli_fetch_array($res))
			{
			$displ = $row['image'];
			}
			
			$photo = '<img src="data:image/jpg;base64,'.base64_encode( $displ ).'" alt="avatar12" id="avatar12" class = "avatarstyle"/>';
			//echo "<br>";
			//echo $photo;
			
			$_SESSION['photo'] = $photo;
			
	?>
	
</head>
<body>
  <a href = "../MainPage/TeaskMain.php"><h1><b>TeaSk (Technical Skill Enhancer)</b></h1></a>
  <div id="content">
    
	<?php
	
	echo "<table border = 1>";

	foreach($ret = $html->find('a[class=display-none]') as $e)
{
	echo "<th>";
	echo "<br>";
	echo "<font size = 6 color = #6753b1> - </font>";
	echo "<a href = $e->href><font size = 5 color = #6753b1> $e->innertext </font></a>";
	echo "<font size = 6 color = #6753b1> - </font>";
	echo "<br>";
	echo "<br>";
	echo "</th>";
}


foreach($ret = $html1->find('a[class=truncate-2-line show-detail-in-modal card-link]') as $e)
{
	echo "<th>";
	echo "<br>";
	echo "<font size = 6 color = #6753b1> - </font>";
	echo "<a href = $e->href><font size = 5 color = #6753b1> $e->innertext </font></a>";
	echo "<font size = 6 color = #6753b1> - </font>";
	echo "<br>";
	echo "<br>";
	
	echo "</th>";
}

	echo "</table>";

	?>
	
  </div>
  <main>
    <div id="id1">
	  <p class = "h1"><b><font color = "purple">Welcome:</font> <?php echo $line[0]; ?></b></p>
      <?php echo $photo; ?>
      <div id="menuleft">
          <h2><b>Menu:</b></h2>
		  <p><a href = "../MainPage/TeaSkMain.php"><b>TeaSk</b></a></p>
          <p><a href = "../SettingsPage/SettingsPage.php"><b>Settings</b></a></p>
			<p><a href = "../Preferences/Preferences.php"><b>Preferences</b></a></p>
		   <p><a href = "logout.php"><b>Logout</b></a></p>
      </div>
    </div >
	
    <div id="id2" class = "margintop50">
		<p><b><font color = "red" size = "6">Account settings</font></b></p><br><br>
		<p><b><font size = "3">Upload photo:</font></b></p>
		<form action = "#" method="POST" enctype="multipart/form-data">
		<input type = "file" name = "img"/>
		<input type = "submit" name = "submit" />
		</form>
		<br>		
	</div>
	
    <div id="id3">
      <div id="menuright">
        <p>Connect with:</p>
        <a href="">GitHub</a><br>
        <a href="">StackOverflow</a><br>
        <a href="">Linkedln</a><br>
        <a href="">Reddit</a>
	</div>
			<form action = "adm.php" method="POST">
					<p style = "position:absolute; bottom:0;" ><label> </label><input type="password" name="key" required>
					<input type="submit" value="ADM" class="button">
					</p>
			</form>
    </div>
  </main>  
</body>
</html>