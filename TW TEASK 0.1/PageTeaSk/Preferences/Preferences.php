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
	<link rel="stylesheet" href="Preferences.css">
	<title>Preferences - TeaSk</title>
	<meta charset="UTF-8">
	
	<?php

		//afisare imagine si date utilizator
		$email = $_SESSION['email'];
		$con = mysqli_connect('localhost' , 'root', '');
		mysqli_select_db($con , 'login');

		$s = 'select firstname,lastname,email,password from users where email =\''.$email.'\'';
		$result = mysqli_query($con , $s);

		$line = $result->fetch_array();
		$res = mysqli_query($con , "SELECT * FROM users where email = '$line[2]'");
			
		while($row = mysqli_fetch_array($res))
			$displ = $row['image'];
			
		$photo = '<img src="data:image/jpg;base64,'.base64_encode( $displ ).'" alt="avatar" id="avatar" class = "avatarstyle"/>';
		$_SESSION['photo'] = $photo;
			
	?>
	
</head>
<body>
    <a href = "../MainPage/TeaskMain.php"><h1><b>TeaSk (Technical Skill Enhancer)</b></h1></a>
  <div id="content">
  
    <?php
    //afisare joburi
	echo "<table border = 1>";

	foreach($ret = $html->find('a[class=display-none]') as $e)
        echo "<th><br><font size = 6 color = #6753b1> - </font>
                <a href = $e->href><font size = 5 color = #6753b1> $e->innertext </font></a>
                <font size = 6 color = #6753b1> - </font><br><br></th>";

    foreach($ret = $html1->find('a[class=truncate-2-line show-detail-in-modal card-link]') as $e)
        echo "<th><br><font size = 6 color = #6753b1> - </font>
                <a href = $e->href><font size = 5 color = #6753b1> $e->innertext </font></a>
                <font size = 6 color = #6753b1> - </font><br><br></th>";

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
		<div class = "harddiv">
		
			<div class="styleleft scrollbar" id ="contentleft">
			<?php

            //afisare teste
            $con = mysqli_connect('localhost' , 'root', '');
            mysqli_select_db($con , 'login');

            $s1 = 'select type,question,ans1,ans2,ans3,ans4,anscorrect from tests where question not in (select question from userstests where email =\''.$email.'\') order by type asc';
            $result1 = mysqli_query($con , $s1);

			while($line1 = mysqli_fetch_row($result1))
                echo "<table border = 1><th>
                        <form action = 'answer.php' method = 'POST'>
                        <font size = 5 color = purple>$line1[0]</font><br><br>
                        <font size = 5 color = purple>$line1[1]</font><br><br>
                        <font size = 5 color = purple>$line1[2]</font><br>
                        <font size = 5 color = purple>$line1[3]</font><br>
                        <font size = 5 color = purple>$line1[4]</font><br>
                        <font size = 5 color = purple>$line1[5]</font><br>
                        </form></th></table><br>";
			?>
			
			</div>
			<div id ="contentright">
			<font size = "5" color = "red">Points: </font>
			
			<?php
			//afisare puncte
			$con = mysqli_connect('localhost' , 'root', '');
			mysqli_select_db($con , 'login');
			$s1 = 'select points from users where email =\''.$email.'\'';
			$result = mysqli_query($con , $s1);
			$line = $result->fetch_array();
			echo "<font size = 5>$line[0]</font>";
			?>

                <form action = "answer.php" method = "POST">
                    <p><label> <font size = "4" color = "purple">Question: </font>
                        </label><input type="name1" id="name1" name="name1" required></p>
                    <p><label> <font size = "4" color = "purple">Answer: </font>
                        </label><input type="name" id="name" name="name" required></p>
                    <input type="submit" value="submit" class="button">
                </form><br><br>


                <?php
			//afisare limbaje github
            if ($_SESSION['accessToken'] != "")
            {
                $URL = 'https://api.github.com/user';
                $authToken = 'Authorization: token '.$_SESSION['accessToken'];
                $userAgent = 'User-Agent: TeaSk';

                $c = curl_init();
                curl_setopt($c, CURLOPT_URL, $URL);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
                $res = curl_exec ($c);
                curl_close ($c);
                $user_data = json_decode($res);

                $c = curl_init ();
                curl_setopt($c, CURLOPT_URL, $user_data->repos_url);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
                $res = curl_exec ($c);
                curl_close ($c);
                $repos_data = json_decode($res);

                $languages = array();
                foreach ($repos_data as $repo)
                {
                    $c = curl_init ();
                    curl_setopt($c, CURLOPT_URL, $repo->languages_url);
                    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
                    $res = curl_exec ($c);
                    curl_close ($c);
                    $langs = json_decode($res);

                    foreach ($langs as $lang_name => $lang_value)
                        $languages[$lang_name] = $lang_value;
                }
                echo "<p>Statistici limbaje github:</p>";
//                asort($languages);
                foreach ($languages as $language_name => $language_value)
                    echo $language_name.": ".$language_value."<br>    ";
            }
			?>

			</div>
		</div>	
		</div>  
	</div>
<!--    <div id="id3" >	-->
<!--      <div id="menuright">-->
<!--          <p>Connect with:</p>-->
<!--          <a href="https://github.com/">GitHub</a><br>-->
<!--          <a href="https://stackoverflow.com/">StackOverflow</a><br>-->
<!--          <a href="https://www.linkedin.com/">Linkedln</a><br>-->
<!--          <a href="https://www.reddit.com/">Reddit</a>-->
<!--      </div>-->
<!--    </div>-->
  </main>  
</body>
</html>


