<!DOCTYPE html>
<html lang = "ro">
<head>
    <link rel="stylesheet" href="http://localhost/TeaSk%20MVC/public/css/admin.css">
    <title>TeaSk - admin page</title>
    <meta charset="UTF-8">
</head>
<body>
<main>
    <div id="id1">
        <p class = "h1"><b><font color = "purple">Welcome:</font> <?php echo $_SESSION['user']->getEmail()."</b></p>
                        <img src=\"data:image/jpg;base64,".base64_encode($_SESSION['user']->getImage())."\" alt=\"avatar\" id=\"avatar\" class = \"avatarstyle\"/>";
                ?>
            </b></p>
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
        <p><b><font color = "red" size = "6">Add JOBS/EVENTS</font></b></p><br><br>

        <form action="http://localhost/TeaSk%20MVC/public/admin/AddJob" method = "POST">
            <div style = "text-align:right;" class = "styleregister">
                <p><label>Event name: </label><input type="text" name="event" required></p>
                <p><label>Company:  </label><input type="text" name="company" required></p>
                <p><label>Type of job/event: </label><input type="text" name="type" required></p>
                <p><label>Href to site: </label><input type="text" name="href" required></p>
            </div>
            <input type="submit" value="ADD" class="button">
            <br><br>
        </form>
    </div>
    <div id="id3" class = "margintop50">
        <p><b><font color = "red" size = "6">Add Test</font></b></p><br><br>
        <form action="http://localhost/TeaSk%20MVC/public/admin/AddTest" method = "POST">
            <div style = "text-align:right;" class = "styleregister">
                <p><label>Question Type: </label><input type="name" name="type" required></p>
                <p><label>Question:  </label><input type="name" name="question" required></p>
                <p><label>Answer 1: </label><input type="name" name="ans1" required></p>
                <p><label>Answer 2: </label><input type="name" name="ans2" required></p>
                <p><label>Answer 3: </label><input type="name" name="ans3" required></p>
                <p><label>Answer 4: </label><input type="name" name="ans4" required></p>
                <p><label>Correct Answer: </label><input type="name" name="anscorrect" required></p>
            </div>
            <input type="submit" value="ADD" class="button">
        </form>
    </div>
    </div>
</main>
</body>
</html>