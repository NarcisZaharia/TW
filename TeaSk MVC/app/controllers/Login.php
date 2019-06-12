<?php


class Login extends Controller
{
    public function index($data = '')
    {
        $this->view('Login+Register/index', $data);
    }

    public function checkLogin()
    {
        if (!DataBase::isUserEmailRegistered($_POST['email'])) {
            $this->index(['error' => 'Email is not registered']);
        }
        $password = DataBase::getUserPassword($_POST['email']);
        if ($password !== md5($_POST['password'])) {
            $this->index(['error' => 'Wrong Password']);
        } else {
            $user = DataBase::getUser($_POST['email']);
            session_start();
            $_SESSION['user'] = $this->model('User', $user);
//        echo "<img src=\"data:image/jpg;base64,".base64_encode($_SESSION['user']->getImage())."\" alt=\"avatar\" id=\"avatar\" class = \"avatarstyle\"/>";
//        var_dump($_SESSION['user']);
            header('Location: http://localhost/TeaSk%20MVC/public/home');

        }


    }

}