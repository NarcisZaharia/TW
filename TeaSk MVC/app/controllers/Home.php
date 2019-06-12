<?php


class Home extends Controller
{
    public function index($data = '')
    {
        if (!isset($_SESSION['user']))
        {
            $_SESSION['user'] = $this->model('User');
            session_start();
        }
        if (!isset($_SESSION['user']))
            header('Location: http://localhost/TeaSk MVC/public/login');
        $_SESSION['ScrapperJobs'] = $this->getScrapperJobs();
        $_SESSION['DBJobs'] = $this->getDBJobs();
        $this->view('home/index', $data);
    }

    public function GithubCallback()
    {
        $_SESSION['user'] = $this->model('User');
        session_start();
        $code = $_GET['code'];
        if ($code == "")
            $this->index(['msg' => 'Loging in with Github didn\'t work']);
        else {
            define('URL', 'https://github.com/login/oauth/access_token');
            define('CLIENT_ID', '2bab198cc3ef8092fc31');
            define('CLIENT_SECRET', '0bf148757c876b2e081854ab8e673eac88c9b060');

            $postParams = ['client_id' => CLIENT_ID, 'client_secret' => CLIENT_SECRET, 'code' => $code];

            $c = curl_init ();
            curl_setopt($c, CURLOPT_URL, URL);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_POST, 1);
            curl_setopt($c, CURLOPT_POSTFIELDS, $postParams);
            curl_setopt($c, CURLOPT_HTTPHEADER, array('Accept: application/json'));
            $res = curl_exec ($c);
            curl_close ($c);
            $data = json_decode($res);
            if ($data->access_token != "")
            {
                $_SESSION['user']->setTokenGithub($data->access_token);
                $_SESSION['user']->updateDatabase();
                $this->index(['msg' => 'Login with github succesful']);
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: http://localhost/TeaSk MVC/public/login');
    }

    public function getScrapperJobs()
    {
        $jobScrapper = $this->model('ScrapperJobs');
        return $jobScrapper->getJobs();
    }

    public function getDBJobs()
    {
        if (isset($_GET['page']))
            $page = $_GET['page'];
        else $page = 0;
        if (isset($_GET['title']))
            $title = '%'.$_GET['title'].'%';
        else $title = '%';
        if (isset($_GET['type']))
            $type = '%'.$_GET['type'].'%';
        else $type = '%';
        $_SESSION['page'] = $page;
        $DBJobs = $this->model('DBJobs', ['page' => $page, 'title' => $title, 'type' => $type]);
        return $DBJobs->getJobs();
    }
}