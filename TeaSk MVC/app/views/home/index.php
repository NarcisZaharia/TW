<!DOCTYPE html>

<html lang = "ro">
<head>
    <link rel="stylesheet" href="http://localhost/TeaSk%20MVC/public/css/Home.css">
	<title>TEASK</title>
	<meta charset="UTF-8">
</head>
<body>
    <a href = "http://localhost/TeaSk%20MVC/public/home"><h1><b>TeaSk (Technical Skill Enhancer)</b></h1></a>
    <div id="content">

      <table border = 1>
        <?php
        foreach($_SESSION['ScrapperJobs'] as $job_name => $job_link)
                echo "<th><br>
                        <font size = 6 color = #6753b1> - </font>
                        <a href = $job_link><font size = 5 color = #6753b1> $job_name </font></a>
                        <font size = 6 color = #6753b1> - </font>
                        <br><br></th>";
        ?>
        </table>
    </div>

    <main>
        <?php
            if (isset($data['msg']))
            {
            echo "<script>alert('".$data['msg']."');</script>";
            }
            ?>
        <div id="id1">
          <p class = "h1"><b><font color = "purple">Welcome:</font>
                  <?php echo $_SESSION['user']->getFirstname()."</b></p>";
                  if ($_SESSION['user']->getTokenGithub())
                      echo "<img src=\"".$_SESSION['user']->getGithubImage()."\" alt='avatar' id='avatar' class = 'avatarstyle'/>"; ?>
                  <div id="menuleft">
                      <h2><b>Menu:</b></h2>
                    <p><a href = "http://localhost/TeaSk%20MVC/public/home"><b>TeaSk</b></a></p>
                    <p><a href = "http://localhost/TeaSk%20MVC/public/settings"><b>Settings</b></a></p>
                    <p><a href = "http://localhost/TeaSk%20MVC/public/preferences"><b>Preferences</b></a></p>
                    <?php
                        if ($_SESSION['user']->isUserAdmin())
                        {
                            echo "<p><a href = \"http://localhost/TeaSk%20MVC/public/admin\"><b>Admin Page</b></a></p>";
                        }
                    ?>
            <p><a href = "http://localhost/TeaSk%20MVC/public/home/logout"><b>Logout</b></a></p>
        </div>
        </div>

        <div id="id2" class = "margintop50">
            <form action="http://localhost/TeaSk%20MVC/public/home" method="get">
                <label>Search title</label><input type="text" name="title">
                <label>Search type</label><input type="text" name="type">
                <button type="submit">Search</button>
            </form>
            <div class = "harddiv">
                <div class="styleleft" id ="contentleft">
                    <?php
                        //afisare joburi din baza de date
                        if (isset($_SESSION['DBJobs']))
                        {
                            for ($i=0; $i<10; $i++)
                            {
                                if (!isset($_SESSION['DBJobs']['href'.$i]))
                                    break;
                                if ($i == 5)
                                {
                                    echo "</div><div class=\"styleleft\" id =\"contentleft\">";
                                }
                                echo "<table border = 1>";
                                echo "<th>";
                                echo "<a href = '".$_SESSION['DBJobs']['href'.$i]."'>
                                        <font size = 5 color = purple>".$_SESSION['DBJobs']['name'.$i]."</font><br>
                                        <font size = 5 color = purple>".$_SESSION['DBJobs']['company'.$i]."</font><br>
                                        <font size = 5 color = purple>".$_SESSION['DBJobs']['type'.$i]."</font></a>";
                                echo "</th>";
                                echo "</table>";
                                echo "<br>";
                            }
                        }
                    ?>
                </div>
            </div>

            <?php
            if ($_SESSION['page']>0)
                echo "<form action='http://localhost/TeaSk%20MVC/public/home' method='get'>
                    <input type='hidden' name='page' value='".($_SESSION['page']-1)."'>
                    <button type='submit'>Previous page</button>
                    </form>";

            echo "<form action='http://localhost/TeaSk%20MVC/public/home' method='get'>
                <input type='hidden' name='page' value='".($_SESSION['page']+1)."'>
                <button type='submit'>Next page</button>
                </form>";
            ?>
        </div>

        <div id="id3">
            <?php
            if ($_SESSION['user']->getTokenGithub() != "")
            {
                echo "<div id='menuright'><p>Connected with Github as: <a href='".$_SESSION['user']->getGithubHref()."'> ".$_SESSION['user']->GetGithubLogin()."</a></p>";

                echo "<p>Following: </p>";
                $following = $_SESSION['user']->getGithubFollowing();
                foreach ($following as $following_login => $following_link)
                    echo "<a href=\"".$following_link."\">".$following_login."</a><br>";

                echo "<p>Followers: </p>";
                $followers = $_SESSION['user']->getGithubFollowers();
                foreach ($followers as $follower_login => $follower_link)
                    echo "<a href=\"".$follower_link."\">".$follower_login."</a><br>";
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


