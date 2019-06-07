<?php


class User
{
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $imagename;
    private $image;

    public function _construct($firstname, $lastname, $email, $password)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }

    public function insertInDataBase()
    {
        $con = mysqli_connect('localhost' , 'root', '', 'login');
        $reg = "insert into users (firstname , lastname , email , password) values ('$this->firstname' , '$this->lastname' , '$this->email' , '$this->password')";
		mysqli_query($con , $reg);
    }

    public function isUserEmailInDatabase()
    {
        $con = mysqli_connect('localhost' , 'root', '', 'login');
        $s = " select * from users where email = '$this->email' ";
        $result = mysqli_query($con , $s);
        $num = mysqli_num_rows($result);
        if ($num === 0)
            return false;
        else return true;
    }

}

?>