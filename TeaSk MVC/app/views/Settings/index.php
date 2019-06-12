<!DOCTYPE html>
<html lang = "ro">
<head>
    <link rel="stylesheet" href="http://localhost/TeaSk%20MVC/public/css/SettingsPage.css">
    <title>TeaSk - Settings</title>
    <meta charset="UTF-8">

<!--    --><?php
//
//    //imagine inserare
//    //echo $_SESSION['email'];
//    $email = $_SESSION['email'];
//    //echo "<br>";
//    $con = mysqli_connect('localhost' , 'root', '');
//    mysqli_select_db($con , 'login');
//
//    //
//    $s = 'select firstname,lastname,email,password from users where email =\''.$email.'\'';
//    $result = mysqli_query($con , $s);
//
//    //	$data= $result->fetch_array()[3];
//    $line = $result->fetch_array();
//
//
//    if(isset($_POST['submit']))
//    {
//        $filename = addslashes($_FILES['img']['name']);
//        $tmpname = addslashes(@file_get_contents($_FILES['img']['tmp_name']));
//        $filetype = addslashes($_FILES['img']['type']);
//        $filesize = addslashes($_FILES['img']['size']);
//        $array = array('jpg','jpeg');
//        $ext = pathinfo($filename, PATHINFO_EXTENSION);
//        if(!empty($filename))
//        {
//            if(in_array($ext, $array))
//            {
//                ;
//                $reg="UPDATE  users set imagename = '$filename' ,image = '$tmpname' where email = '$line[2]'";
//
//                if ($con->query($reg) === TRUE) {
//                    //echo "Record updated successfully";
//                } else {
//                    //echo "Error updating record: " . $con->error;
//                }
//
//            }
//            else
//            {
//                //echo "failed";
//            }
//        }
//    }
//
//
//    $res = mysqli_query($con , "SELECT * FROM users where email = '$line[2]'");
//
//    while($row = mysqli_fetch_array($res))
//    {
//        $displ = $row['image'];
//    }
//
//    $photo = '<img src="data:image/jpg;base64,'.base64_encode( $displ ).'" alt="avatar12" id="avatar12" class = "avatarstyle"/>';
//    //echo "<br>";
//    //echo $photo;
//
//    $_SESSION['photo'] = $photo;
//
//    ?>

</head>
<body>
<a href = "http://localhost/TeaSk%20MVC/public/home"><h1><b>TeaSk (Technical Skill Enhancer)</b></h1></a>
<main>
    <div id="id1">
        <p class = "h1"><b><font color = "purple">Welcome:</font>
                <?php echo $_SESSION['user']->getEmail()."</b></p>
                        <img src=\"data:image/jpg;base64,".base64_encode($_SESSION['user']->getImage())."\" alt=\"avatar\" id=\"avatar\" class = \"avatarstyle\"/>";
                ?>
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
        <p><b><font color = "red" size = "6">Account settings</font></b></p><br><br>
        <p><b><font size = "3">Upload photo:</font></b></p>
        <form action = "http://localhost/TeaSk%20MVC/public/settings/changePhoto" method="POST" enctype="multipart/form-data">
            <input type = "file" name = "img"/>
            <input type = "submit" name = "submit"/>
        </form>
        <br>

        <form action = "http://localhost/TeaSk%20MVC/public/settings/changePassword" method = "POST">
            <p><b><font size = "3">Change password:</font></b></p>
            <p>
                <label> <font size = "4">Old Password: </font>
                </label><input type="password" id="name1" name="oldPass" required>
                <br>
                <label> <font size = "4">New Password: </font>
                </label><input type="password" id="name" name="newPass" required>
                <br>
                <input type="submit" value="submit" class="button"></p>
        </form>
    </div>
</main>
</body>
</html>