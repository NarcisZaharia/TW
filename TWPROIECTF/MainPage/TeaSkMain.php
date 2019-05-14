<?php

session_start();

?>

<!DOCTYPE html>

<html lang = "ro">
<head>
	<link rel="stylesheet" href="TeaSkMain.css">
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
	  <p class = "h1"><b>Welcome <?php echo $_SESSION ['email']; ?></b></p>
      <img src="PHOTOS/Me.png" alt="avatar" id="avatar" class = "avatarstyle">
      <div id="menuleft">
          <h2><b>Menu:</b></h2>
          <p><a href = "../SettingsPage/SettingsPage.html"><b>Settings</b></a></p>
          <p><b>Preferences</b></p>
		   <p><a href = "logout.php"><b>Logout</b></a></p>
      </div>
    </div >
    <div id="id2" class = "margintop50">
		<div class = "harddiv">
			<div class = "hardtext"><img src="PHOTOS/amio.png" alt="amio" class="hardnews"><br><b>Analist QA<br>Stagiu platit</b></div>
            <div class = "hardtext"><img src="PHOTOS/spark.png" alt="spark" class="hardnews"><br><b>Conferinta pentru ceva<br>Ora 9:00, Sambata, 23 martie</b></div>
            <div class = "hardtext"><img src="PHOTOS/thales.png" alt="thales" class="hardnews"><br><b>Developer Full Stack<br>Practica de vara</b></div>
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


