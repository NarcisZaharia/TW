<?php


class Settings extends Controller
{
    public function index($data = '')
    {
        if (!isset($_SESSION['user']))
        {
            $_SESSION['user'] = $this->model('User');
            session_start();
        }
        $this->view('Settings/index', $data);
    }

    public function changePhoto()
    {
        if (isset($_POST['submit']))
        {
            $filename = addslashes($_FILES['img']['name']);
            $tmpname = addslashes(@file_get_contents($_FILES['img']['tmp_name']));
            $filetype = addslashes($_FILES['img']['type']);
            $filesize = addslashes($_FILES['img']['size']);
            $array = array('jpg','jpeg');
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!empty($filename))
            {
                if (in_array($ext, $array))
                {
                    $_SESSION['user'] = $this->model('User');
                    session_start();
                    $_SESSION['user']->setImageName($filename);
                    $_SESSION['user']->setImage($tmpname);
                    $_SESSION['user']->updateDatabase();
                    $this->index();
                }
            }
        }
        else $this->index(['error' => 'No submit']);
    }

    public function changePassword()
    {
        if (isset($_POST['oldPass']) && isset($_POST['newPass']))
        {
            $oldPass = md5($_POST['oldPass']);
            $_SESSION['user'] = $this->model('User');
            session_start();
            if ($oldPass !== $_SESSION['user']->getPassword())
            {
                echo $_SESSION['user']->getPassword()." ".$oldPass;
                $this->index(['error' => 'Old password doesn\'t match']);
            }
            else
            {
                $newPass = $_POST['newPass'];
                if (!$this->checkPassword($newPass))
                    $this->index(['error' => 'New password is too short']);
                else
                {
                    $newPass = md5($newPass);
                    $_SESSION['user']->setPassword($newPass);
                    $_SESSION['user']->updateDatabase();
                    $this->index();
                }
            }
        }
    }

    private function checkPassword($password)
    {
        if (strlen($password)>5)
            return true;
        else return false;
    }
}