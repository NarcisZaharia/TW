<?php


class Register extends Controller
{
    public function index($data = '')
    {
        $this->view('Login+Register/index', $data);
    }

    public function checkRegister()
    {
        if ($this->checkPassword($_POST['password'])) {
            $user = $this->model('User', ['email' => $_POST['email']]);
            if (DataBase::isUserEmailRegistered($user->getEmail()))
            {
                $this->index(['error' => 'Email is already taken']);
            }
            else {
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setPassword(md5($_POST['password']));
                $user->insertInDatabase();
                session_start();
                $_SESSION['user'] = $user;
                header('Location: http://localhost/TeaSk%20MVC/public/home/index/'.$_POST['email']);
            }
        }
        else {
            $this->index(['error' => 'Password is too short']);
        }
    }

    private function checkPassword($password)
    {
        if (strlen($password)>5)
            return true;
        else return false;
    }
}