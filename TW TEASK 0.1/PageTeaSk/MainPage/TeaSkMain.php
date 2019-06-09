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
        //afisare imagine
		$email = $_SESSION['email'];
		$con = mysqli_connect('localhost' , 'root', '');
		mysqli_select_db($con , 'login');

		$s = 'select firstname,lastname,email,password from users where email =\''.$email.'\'';
		$result = mysqli_query($con , $s);

		$line = $result->fetch_array();
		$res = mysqli_query($con , "SELECT * FROM users where email = '$line[2]'");
			
		while($row = mysqli_fetch_array($res))
        {
            $displ = $row['image'];
        }
        $photo = '<img src="data:image/jpg;base64,'.base64_encode( $displ ).'" alt="avatar" id="avatar" class = "avatarstyle"/>';
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
		  <p><a href = "TeaSkMain.php"><b>TeaSk</b></a></p>
          <p><a href = "../SettingsPage/SettingsPage.php"><b>Settings</b></a></p>
          <p><a href = "../Preferences/Preferences.php"><b>Preferences</b></a></p>
		   <p><a href = "logout.php"><b>Logout</b></a></p>
      </div>
    </div >
    <div id="id2" class = "margintop50">
        <form action="TeaSkMain.php" method="get">
            <label>Search title</label><input type="text" name="title">
            <label>Search type</label><input type="text" name="type">
            <button type="submit">Search</button>
        </form>
		<div class = "harddiv">
		
			<div class="styleleft" id ="contentleft">
			<?php

            //afisare joburi
            if (isset($_GET['page']))
                $page = $_GET['page'];
            else $page = 0;
            if (isset($_GET['title']))
                $title = '%'.$_GET['title'].'%';
            else $title = '%';
            if (isset($_GET['type']))
                $type = '%'.$_GET['type'].'%';
            else $type = '%';

            $con = mysqli_connect('localhost' , 'root', '');
            mysqli_select_db($con , 'login');
            $con->query("set @row_number:=-1");
            $s1 = "select name, company, type, href from (SELECT (@row_number:=@row_number + 1) AS num, name, company, type, href 
                    FROM jobs where name like '".$title."' and type like '".$type."' 
                    order by name) as ord where num >= ".(10*$page)." and num <".(10*$page+5);
            $result1 = mysqli_query($con , $s1);

            while($line1 = mysqli_fetch_row($result1))
            {
                echo "<table border = 1>";
                echo "<th>";
                echo "<a href = $line1[3]>
                        <font size = 5 color = purple>$line1[0]</font><br>
                        <font size = 5 color = purple>$line1[1]</font><br>
                        <font size = 5 color = purple>$line1[2]</font></a>";
                echo "</th>";
                echo "</table>";
                echo "<br>";
            }
			?>
			</div>

            <div class="styleleft" id ="contentleft">
                <?php

                //afisare joburi
                if (isset($_GET['page']))
                    $page = $_GET['page'];
                else $page = 0;
                $con = mysqli_connect('localhost' , 'root', '');
                mysqli_select_db($con , 'login');
                $con->query("set @row_number:=-1");
                $s1 = "select name, company, type, href from (SELECT (@row_number:=@row_number + 1) AS num, name, company, type, href 
                    FROM jobs where name like '".$title."' and type like '".$type."' 
                    order by name) as ord where num >= ".(10*$page+5)." and num <".(10*$page+10);
                $result1 = mysqli_query($con , $s1);

                while($line1 = mysqli_fetch_row($result1))
                {
                    echo "<table border = 1>";
                    echo "<th>";
                    echo "<a href = $line1[3]>
                        <font size = 5 color = purple>$line1[0]</font><br>
                        <font size = 5 color = purple>$line1[1]</font><br>
                        <font size = 5 color = purple>$line1[2]</font></a>";
                    echo "</th>";
                    echo "</table>";
                    echo "<br>";
                }
                ?>
            </div>
		</div>

        <?php
        if ($page>0)
            echo "<form action='TeaSkMain.php' method='get'>
                    <input type='hidden' name='page' value='".($page-1)."'>
                    <button type='submit'>Previous page</button>
                    </form>";


        echo "<form action='TeaSkMain.php' method='get'>
                <input type='hidden' name='page' value='".($page+1)."'>
                <button type='submit'>Next page</button>
                </form>";

        ?>
        <!--			<div class = "hardtext"><img src="PHOTOS/amio.png" alt="amio" class="hardnews"><br><b>Full Stack Developer<br>Stagiu platit</b></div>-->
<!--            <div class = "hardtext"><img src="PHOTOS/spark.png" alt="spark" class="hardnews" ><br><b>Conferinta<br>Ora 9:00, sambata</b></div>-->
<!--            <div class = "hardtext"><img src="PHOTOS/thales.png" alt="thales" class="hardnews"><br><b>QA Analist<br>Practica de vara</b></div>-->


	</div>

    <div id="id3">

        <?php
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
            $data = json_decode($res);

            echo "<div id='menuright'><p>Connected with Github as: <a href='".$data->html_url."'> ".$data->login."</a></p>";

            $following_url = explode('{', $data->following_url);
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $following_url[0]);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
            $res = curl_exec ($c);
            curl_close ($c);
            $following_data = json_decode($res);
            echo "<p>Following: </p>";
            foreach ($following_data as $following)
            {
                echo "<a href=\"".$following->html_url."\">".$following->login."</a><br>";
            }


            $follower_url = explode('{', $data->followers_url);
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $follower_url[0]);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json', $authToken, $userAgent));
            $res = curl_exec ($c);
            curl_close ($c);
            $follower_data = json_decode($res);
            echo "<p>Followers:</p>";
            foreach ($follower_data as $follower)
            {
                echo "<a href=\"".$follower->html_url."\">".$follower->login."</a><br>";
            }
            echo "</div><br>";
        }

        else
            echo "<div id=\"menuright\">
                      <p>Connect with:</p>
                      <a href=\"https://github.com/login/oauth/authorize?client_id=2bab198cc3ef8092fc31&scope=repo\">GitHub</a><br>
                      <a href=\"https://stackoverflow.com/\">StackOverflow</a><br>
                      <a href=\"https://www.linkedin.com/\">Linkedln</a><br>
                      <a href=\"https://www.reddit.com/\">Reddit</a>
                     </div>";
        ?>
    </div>
  </main>  
</body>
</html>


