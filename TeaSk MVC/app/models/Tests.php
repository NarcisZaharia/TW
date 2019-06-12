<?php


class Tests
{
    private $questions = [];
    private $page;
    private $question;
    private $type;

    public function __construct($params)
    {
        if (isset($params['page']))
            $this->page = $params['page'];
        if (isset($params['question']))
            $this->question = $params['question'];
        if (isset($params['type']))
            $this->type = $params['type'];
        if (isset($params['email']))
            $email = $params['email'];
        $con = DataBase::getConection();
        $con->query("set @row_number:=-1");
        $stmt = $con->prepare("select type, question, ans1, ans2, ans3, ans4, anscorrect from (SELECT (@row_number:=@row_number + 1) AS num, type, question, ans1, ans2, ans3, ans4, anscorrect 
                                        FROM tests where question like ? and type like ? and question not in (select question from userstests where email = ?) order by question) as ord where num >= ? and num < ?");
        $low_limit = $this->page*5;
        $big_limit = $this->page*5+5;
        $stmt->bind_param("sssii", $this->question, $this->type, $email, $low_limit, $big_limit);
        $i = 0;
        $stmt->bind_result($this->questions['type'.$i], $this->questions['question'.$i], $this->questions['ans1'.$i], $this->questions['ans2'.$i], $this->questions['ans3'.$i], $this->questions['ans4'.$i], $this->questions['anscorrect'.$i]);
        $stmt->execute();
        while ($stmt->fetch()) {
            $i++;
            $stmt->bind_result($this->questions['type'.$i], $this->questions['question'.$i], $this->questions['ans1'.$i], $this->questions['ans2'.$i], $this->questions['ans3'.$i], $this->questions['ans4'.$i], $this->questions['anscorrect'.$i]);
        }
    }

    public function getQuestions()
    {
        return $this->questions;
    }
}