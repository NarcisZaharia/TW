<?php


class Admin extends Controller
{
    public function index()
    {
        $_SESSION['user'] = $this->model('User');
        session_start();
        if (!isset($_SESSION['user']))
            header('Location: http://localhost/TeaSk MVC/public/login');
        $this->view('Admin/index');
    }

    public function AddJob()
    {
        if (isset($_POST['event']) && isset($_POST['company']) && isset($_POST['type']) && isset($_POST['href']))
        {
            DataBase::insertJob($_POST['event'], $_POST['company'], $_POST['type'], $_POST['href']);
        }
        $this->index();
    }

    public function AddTest()
    {
        if (isset($_POST['type']) && isset($_POST['question']) && isset($_POST['ans1']) && isset($_POST['ans2']) && isset($_POST['ans3']) && isset($_POST['ans4']) && isset($_POST['anscorrect']))
        {
            DataBase::insertTest($_POST['type'], $_POST['question'], $_POST['ans1'], $_POST['ans2'], $_POST['ans3'], $_POST['ans4'], $_POST['anscorrect']);
        }
        $this->index();
    }
}