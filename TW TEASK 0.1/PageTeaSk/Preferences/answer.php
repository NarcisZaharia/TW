<?php
session_start();
$email = $_SESSION['email'];
$line1 = $_SESSION['line1'];


$con = mysqli_connect('localhost' , 'root', '');
mysqli_select_db($con , 'login');
$reg2 = 'select anscorrect from tests where question =\''.$line1[1].'\'';
$result = mysqli_query($con , $reg2);
$result = $result->fetch_array();
$result = $result[0];

$reg7 = 'select question from tests';
$result3 = mysqli_query($con , $reg7);
//$question = $result3;
$result4 = $result3->fetch_array();
//$result4 = $result4[0];
//echo $result3;


$name = $_POST ['name'];
$name1 = $_POST ['name1'];

$reg3 = 'select anscorrect from tests where question =\''.$name1.'\'';
$result1 = mysqli_query($con , $reg3);
$result1 = $result1->fetch_array();
$result1 = $result1[0];
//echo $result1;
//echo $name;
//echo $reg3;

while ($result4 = mysqli_fetch_row($result3))
{
    if ($name1 === $result4[0])
    {
//                    echo $name1;
        if($name == $result1)
        {
//                        echo $name;
            $reg2='update users set points = points+1 where email =\''.$email.'\'';
            mysqli_query($con ,$reg2);
            //echo $email;
            //echo $name1;
            //echo $result1;
            //echo "<br>";
            //echo $name;
            //'update userstests set email = \''.$email.'\'';
            //'update userstests set answer = \''.$result1.'\'';
            $ins = "insert into userstests(email , question) values ('$email', '$name1')";
            mysqli_query($con , $ins);
            echo "<script type='text/javascript'>
                            window.location='Preferences.php';
                            </script>";
        }
        else
        {
            $reg2='update users set points = points-1 where email =\''.$email.'\'';
            mysqli_query($con ,$reg2);
            //echo $result;
            //echo "<br>";
            //echo $name;
            //'insert into userstests (email , question) values ('$email' , '$name1')';
            $ins = "insert into userstests (email , question) values ('$email' , '$name1')";
            mysqli_query($con , $ins);
            echo "<script type='text/javascript'>
                            window.location='Preferences.php';
                            </script>";
        }
    }
}
?>