<?php

session_start();
if(!isset($_SESSION['email']))
{
	header('location:../index.php');
}

?>

<!DOCTYPE html>
<html lang = "ro">
<head>
	<link rel="stylesheet" href="SettingsPage.css">
	<title>TEASK</title>	
	<meta charset="UTF-8">
</head>
<body>
  <a href = "../MainPage/TeaskMain.php"><h1><b>TeaSk (Technical Skill Enhancer)</b></h1></a>
  <div id="content">
    <img src="PHOTOS/amio.png" alt="amio" class="scrollbar">
    <img src="PHOTOS/spark.png" alt="spark" class="scrollbar">
    <img src="PHOTOS/thales.png" alt="thales" class="scrollbar">
    <img src="PHOTOS/amio.png" alt="amio" class="scrollbar">
    <img src="PHOTOS/spark.png" alt="spark" class="scrollbar">
    <img src="PHOTOS/thales.png" alt="thales" class="scrollbar">
    <img src="PHOTOS/amio.png" alt="amio" class="scrollbar">
    <img src="PHOTOS/spark.png" alt="spark" class="scrollbar">
    <img src="PHOTOS/thales.png" alt="thales" class="scrollbar">
    <img src="PHOTOS/amio.png" alt="amio" class="scrollbar">
    <img src="PHOTOS/spark.png" alt="spark" class="scrollbar">
    <img src="PHOTOS/thales.png" alt="thales" class="scrollbar">
    <img src="PHOTOS/amio.png" alt="amio" class="scrollbar">
    <img src="PHOTOS/spark.png" alt="spark" class="scrollbar">
    <img src="PHOTOS/thales.png" alt="thales" class="scrollbar">
    <img src="PHOTOS/amio.png" alt="amio" class="scrollbar">
    <img src="PHOTOS/spark.png" alt="spark" class="scrollbar">
    <img src="PHOTOS/thales.png" alt="thales" class="scrollbar">
  </div>
  <main>
    <div id="id1">
	  <p class = "h1"><b><?php echo $_SESSION ['email']; ?></b></p>
      <img src="PHOTOS/Me.png" alt="avatar" id="avatar" class = "avatarstyle">
      <div id="menuleft">
          <h2><b>Menu:</b></h2>
		  <p><a href = "../MainPage/TeaSkMain.php"><b>TeaSk</b></a></p>
          <p><a href = "../SettingsPage/SettingsPage.php"><b>Settings</b></a></p>
          <p><b>Preferences</b></p>
		   <p><a href = "logout.php"><b>Logout</b></a></p>
      </div>
    </div >
    <div id="id2" class = "margintop50">
		<p><b>SETARI CONT!</b></p>
	</div>
    <div id="id3"  >
      <div id="menuright">
        <p>Connect with:</p>
        <a href="">GitHub</a><br>
        <a href="">StackOverflow</a><br>
        <a href="">Linkedln</a><br>
        <a href="">Reddit</a>
      </div>
    </div>
  </main>  
</body>
</html>