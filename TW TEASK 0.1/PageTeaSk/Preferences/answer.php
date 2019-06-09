<?php
session_start();
$email = $_SESSION['email'];

$con = mysqli_connect('localhost' , 'root', '');
mysqli_select_db($con , 'login');

$reg7 = 'select question, anscorrect from tests';
$result3 = mysqli_query($con , $reg7);


$name = $_POST ['name'];
$name1 = $_POST ['name1'];

while ($result4 = mysqli_fetch_row($result3))
{
    if ($name1 === $result4[0])
    {
        if($name == $result4[1])
        {
            $reg2='update users set points = points+1 where email =\''.$email.'\'';
            mysqli_query($con ,$reg2);

            $ins = "insert into userstests(email , question) values ('$email', '$name1')";
            mysqli_query($con , $ins);
            echo "<script type='text/javascript'>
                    alert('Ai raspuns corect');
                    window.location='Preferences.php';                           
                    </script>";
        }
        else
        {
            $reg2='update users set points = points-1 where email =\''.$email.'\'';
            mysqli_query($con ,$reg2);
            $ins = "insert into userstests (email , question) values ('$email' , '$name1')";
            mysqli_query($con , $ins);
            echo "<script type='text/javascript'>
                    alert('Ai raspuns gresit');
                    window.location='Preferences.php';
                    </script>";
        }
    }
}
echo "<script type='text/javascript'>
        alert('Nu exista aceasta intrebare');
        window.location='Preferences.php';
        </script>";

?>