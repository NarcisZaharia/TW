<?php


class Preferences extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user']))
        {
            $_SESSION['user'] = $this->model('User');
            session_start();
        }
        if (!isset($_SESSION['user']))
            header('Location: http://localhost/TeaSk MVC/public/login');
        $_SESSION['tests'] = $this->getTests();
        $_SESSION['top'] = $this->getTop();
        $this->view('Preferences/index');
    }

    public function answerQuestion()
    {
        $_SESSION['user'] = $this->model('User');
        session_start();
        if (isset($_POST['questionName']) && isset($_POST['answer'])) {
            $question = $_POST['questionName'];
            $answer = $_POST['answer'];
            if (DataBase::isQuestionInDatabase($question)) {
                $goodAnswer = DataBase::getQuestionAnswer($question);
                $type = DataBase::getQuestionType($question);
                if ($goodAnswer === $answer) {
                    $_SESSION['user']->incrementPoints($type);
                    $_SESSION['user']->updateUsertests($question);
                    $this->index();
                } else {
                    if ($_SESSION['user']->getTotalPoints() > 0) {
                        $_SESSION['user']->decrementPoints();
                        $_SESSION['user']->updateUsertests($question);
                        $this->index();
                    }
                }
            }
            else $this->index();
        }
    }

    public function getTests()
    {
        if (isset($_GET['page']))
            $page = $_GET['page'];
        else $page = 0;
        if (isset($_GET['question']))
            $question = '%'.$_GET['question'].'%';
        else $question = '%';
        if (isset($_GET['type']))
            $type = '%'.$_GET['type'].'%';
        else $type = '%';
        $_SESSION['page'] = $page;
        $tests = $this->model('Tests', ['page' => $page, 'question' => $question, 'type' => $type, 'email' => $_SESSION['user']->getEmail()]);
        return $tests->getQuestions();
    }

    public function getTop()
    {
        $con = DataBase::getConection();
        if ($con->connect_error)
            die("Couldn't connect : ". $con->connect_error);
        $stmt = $con->prepare("Select distinct email, sum(points) from userpoints group by email order by sum(points) desc limit 3");
        $top = [];
        $stmt->execute();
        for ($i = 0; $i <3; $i++)
        {
            $stmt->bind_result($top['email'.$i], $top['points'.$i]);
            $stmt->fetch();
        }
        return $top;
    }
}