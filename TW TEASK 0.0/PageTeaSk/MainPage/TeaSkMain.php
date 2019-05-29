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
	<link rel="stylesheet" href="TeaSkMain.css">
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
			
			$photo = '<img src="data:image/jpg;base64,'.base64_encode( $displ ).'" alt="avatar" id="avatar" class = "avatarstyle"/>';
			//echo "<br>";
			//echo $photo;
			
			$_SESSION['photo'] = $photo;
			
	?>
	
	<?php

		//afisare joburi
		//echo $_SESSION['email'];

		$con = mysqli_connect('localhost' , 'root', '');
		mysqli_select_db($con , 'login');
		
		//
		$s1 = 'select name,company,type,href from jobs order by name asc';
		$result1 = mysqli_query($con , $s1);
		
		//	$data= $result->fetch_array()[3];
		$line1 = $result1->fetch_array();
		
			/*while($line1 = mysqli_fetch_row($result1))
		{
			echo "<table border = 1>";
			echo "<th>";
			echo "<a href = $line1[3]>
			 $line1[0]
			 <br>
			 $line1[1]
			 <br>
			 $line1[2]
			 </a>";
			echo "</th>";
			echo "</table>";
			echo "<br>";
		}*/
				
			//$res1 = mysqli_query($con , "SELECT * FROM jobs where email = '$line1'");
			
			//$line1 = $result1->fetch_array();
			//while($row = $s1->fetch_assoc())
			//{
				/*
			echo "<table border = 1>";
			echo "<th>";
			echo "<a href = $line1[3]>
			 $line1[0]
			 <br>
			 $line1[1]
			 <br>
			 $line1[2]
			 </a>";
			echo "</th>";
			echo "</table>";
			*/
			//}
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
		  <p><a href = "TeaSkMain.php"><b>TeaSk</b></a></p>
          <p><a href = "../SettingsPage/SettingsPage.php"><b>Settings</b></a></p>
          <p><b>Preferences</b></p>
		   <p><a href = "logout.php"><b>Logout</b></a></p>
      </div>
    </div >
    <div id="id2" class = "margintop50">
		<div class = "harddiv">
		
			<div class="styleleft scrollbar" id ="contentleft">
			<?php  

			while($line1 = mysqli_fetch_row($result1))
		{
			echo "<table border = 1>";
			echo "<th>";
			echo "<a href = $line1[3]>
			 <font size = 5 color = purple>$line1[0]</font>
			 <br>
			 <font size = 5 color = purple>$line1[1]</font>
			 <br>
			 <font size = 5 color = purple>$line1[2]</font>
			 </a>";
			echo "</th>";
			echo "</table>";
			echo "<br>";
		}
			?>
			</div>
			
		</div>
		
		<div class = "harddiv">
			
			<div class = "hardtext"><img src="PHOTOS/amio.png" alt="amio" class="hardnews"><br><b>Full Stack Developer<br>Stagiu platit</b></div>
            <div class = "hardtext"><img src="PHOTOS/spark.png" alt="spark" class="hardnews" ><br><b>Conferinta<br>Ora 9:00, sambata</b></div>
            <div class = "hardtext"><img src="PHOTOS/thales.png" alt="thales" class="hardnews"><br><b>QA Analist<br>Practica de vara</b></div>
			
		</div>  
	</div>
    <div id="id3"  >	
      <div id="menuright">
          <p>Connect with:</p>
          <a href="https://github.com/">GitHub</a><br>
          <a href="https://stackoverflow.com/">StackOverflow</a><br>
          <a href="https://www.linkedin.com/">Linkedln</a><br>
          <a href="https://www.reddit.com/">Reddit</a>
      </div>
    </div>
  </main>  
</body>
</html>


