<!DOCTYPE html>

<html lang = "ro">
<head>
    <link rel="stylesheet" href="http://localhost/TeaSk%20MVC/public/css/Preferences.css">
    <title>TeaSk - Preferences</title>
	<meta charset="UTF-8">
</head>
<body>
    <a href = "../MainPage/TeaskMain.php"><h1><b>TeaSk (Technical Skill Enhancer)</b></h1></a>
  <main>
    <div id="id1">
	  <p class = "h1"><b><font color = "purple">Welcome:</font> <?php echo $_SESSION['user']->getFirstname()."</b></p>";
              if (null !== $_SESSION['user']->getTokenGithub())
                  echo "<img src='".$_SESSION['user']->getGithubImage()."' alt='avatar' id='avatar' class = 'avatarstyle'/>";
              ?>
      <div id="menuleft">
          <h2><b>Menu:</b></h2>
          <p><a href = "http://localhost/TeaSk%20MVC/public/home"><b>TeaSk</b></a></p>
          <p><a href = "http://localhost/TeaSk%20MVC/public/settings"><b>Settings</b></a></p>
          <p><a href = "http://localhost/TeaSk%20MVC/public/preferences"><b>Preferences</b></a></p>
          <?php
          if ($_SESSION['user']->isUserAdmin())
              echo "<p><a href = \"http://localhost/TeaSk%20MVC/public/admin\"><b>Admin Page</b></a></p>";
          ?>
          <p><a href = "http://localhost/TeaSk%20MVC/public/home/logout"><b>Logout</b></a></p>
      </div>
    </div >
    <div id="id2" class = "margintop50">
        <form action="http://localhost/TeaSk%20MVC/public/preferences" method="get">
            <label>Search question title</label><input type="text" name="question">
            <label>Search question type</label><input type="text" name="type">
            <button type="submit">Search</button>
        </form>
		<div class = "harddiv">

			<div class="styleleft scrollbar" id ="contentleft">
			<?php

            //afisare teste

            if (isset($_SESSION['tests']))
            {
                for ($i=0; $i<5; $i++)
                {
                    if (!isset($_SESSION['tests']['type'.$i]))
                        break;
                    echo "<table border = 1><th>
                        <font size = 5 color = purple>". $_SESSION['tests']['type'.$i] ."</font><br><br>
                        <font size = 5 color = purple>". $_SESSION['tests']['question'.$i] ."</font><br><br>
                        <font size = 5 color = purple>". $_SESSION['tests']['ans1'.$i] ."</font><br>
                        <font size = 5 color = purple>". $_SESSION['tests']['ans2'.$i] ."</font><br>
                        <font size = 5 color = purple>". $_SESSION['tests']['ans3'.$i] ."</font><br>
                        <font size = 5 color = purple>". $_SESSION['tests']['ans4'.$i] ."</font><br>
                        </th></table><br>";
                }
            }
            if ($_SESSION['page'] > 0)
                echo "<form action='http://localhost/TeaSk%20MVC/public/preferences' method='get'>
                    <input type='hidden' name='page' value='" . ($_SESSION['page'] - 1) . "'>
                    <button type='submit'>Previous page</button>
                    </form>";

            echo "<form action='http://localhost/TeaSk%20MVC/public/preferences' method='get'>
                <input type='hidden' name='page' value='" . ($_SESSION['page'] + 1) . "'>
                <button type='submit'>Next page</button>
                </form>";


            ?>
            </div>

			<div id ="contentright">
			<font size = "5" color = "red">Points: <?php echo $_SESSION['user']->getTotalPoints(); ?></font>

                <form action = "http://localhost/TeaSk%20MVC/public/preferences/answerQuestion" method = "POST">
                    <p><label> <font size = "4" color = "purple">Question: </font>
                        </label><input type="name1" id="name1" name="questionName" required></p>
                    <p><label> <font size = "4" color = "purple">Answer: </font>
                        </label><input type="name" id="name" name="answer" required></p>
                    <input type="submit" value="submit" class="button">
                </form><br><br>


                <?php
                //afisare top
                echo "<p>Top 3 utilizatori cu cel mai mare scor:</p>";

                for ($i=0; $i<3; $i++) {
                    if (isset($_SESSION['top']['email' . $i]) && isset($_SESSION['top']['points' . $i]))
                        echo $_SESSION['top']['email' . $i] . " cu " . $_SESSION['top']['points' . $i] . " puncte<br>";
                }
			    //afisare limbaje github
                if (null !== $_SESSION['user']->getTokenGithub()) {
                    $languages = $_SESSION['user']->getGithubLanguages();
                    echo "<p>Statistici limbaje github:</p>";
                    foreach ($languages as $language_name => $language_value)
                        echo $language_name . ": " . $language_value . "<br>    ";
                }

                ?>
			</div>
		</div>
		</div>
	</div>
  </main>
</body>
</html>
