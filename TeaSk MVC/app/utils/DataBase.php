<?php


class DataBase
{
    private static $host = "localhost";
    private static $user = "root";
    private static $password ="";
    private static $dbname = "login";

    public static function getConection()
    {
        return mysqli_connect(self::$host, self::$user, self::$password, self::$dbname);
    }

    public static function isUserEmailRegistered($email)
    {
        $con = self::getConection();
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $stmt = $con->prepare("Select email from `users` where email like ? limit 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->fetch())
        {
            $stmt->free_result();
            $stmt->close();
            return true;
        }
        else {
            echo $stmt->error;
            $stmt->free_result();
            $stmt->close();
            return false;
        }

    }

    public static function GetUserPassword($email)
    {

        $con = self::getConection();
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $stmt = $con->prepare("Select password from `users` where email like ? limit 1");
        $stmt->bind_param("s", $email);
        $stmt->bind_result($pass);
        $stmt->execute();
        if ($stmt->fetch())
        {
            $stmt->free_result();
            $stmt->close();
            return $pass;
        }
        else {
            echo $stmt->error;
            $stmt->free_result();
            $stmt->close();
            return '';
        }

    }

    public static function getUser($email)
    {
        $con = self::getConection();
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $stmt = $con->prepare("Select firstname, lastname, email, password, isAdmin, imagename, image, points, TokenGithub from `users` where email like ? limit 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $user_params = array();
        $stmt->bind_result($user_params['firstname'], $user_params['lastname'], $user_params['email'], $user_params['password'], $user_params['isAdmin'], $user_params['imagename'], $user_params['image'], $user_params['points'], $user_params['TokenGithub']);

        if ($result = $stmt->fetch())
        {
            $stmt->close();
            return $user_params;
        }
        else {
            echo $stmt->error;
            $stmt->close();
            return '';
        }
    }

    public static function insertJob($name, $company, $type, $link)
    {
        $con = self::getConection();
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $stmt = $con->prepare("Insert into jobs (name, company, type, href) values (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $company, $type, $link);
        $stmt->execute();
    }

    public static function insertTest($type, $question, $ans1, $ans2, $ans3, $ans4, $anscorrect)
    {
        $con = self::getConection();
        if ($con->connect_error) {
            die("Connection failed: ". $con->connect_error);
        }
        $stmt = $con->prepare("Insert into tests (type, question, ans1, ans2, ans3, ans4, anscorrect) values (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $type, $question, $ans1, $ans2, $ans3, $ans4, $anscorrect);
        $stmt->execute();
    }

    public static function isQuestionInDatabase($question)
    {
        $con = self::getConection();
        if ($con->connect_error) {
            die("Connection failed: ". $con->connect_error);
        }
        $stmt = $con->prepare ("Select question from tests where question like ?");
        $stmt->bind_param("s", $question);
        $stmt->execute();
        if($stmt->fetch())
            return true;
        else return false;
    }

    public static function getQuestionAnswer($question)
    {
        $con = self::getConection();
        if ($con->connect_error) {
            die("Connection failed: ". $con->connect_error);
        }
        $stmt = $con->prepare ("Select anscorrect from tests where question like ?");
        $stmt->bind_param("s", $question);
        $stmt->bind_result($correct);
        $stmt->execute();
        $stmt->fetch();
        return$correct;
    }
}