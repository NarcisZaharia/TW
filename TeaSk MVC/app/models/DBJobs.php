<?php


class DBJobs
{
    private $jobs = [];
    private $page;
    private $title;
    private $type;

    public function __construct($params)
    {
        if (isset($params['page']))
            $this->page = $params['page'];
        if (isset($params['title']))
            $this->title = $params['title'];
        if (isset($params['type']))
            $this->type = $params['type'];
        if (isset($params['user']))
            $user = $params['user'];
        $con = DataBase::getConection();
        $con->query("set @row_number:=-1");
        $stmt = $con->prepare("select name, company, type, href, minPoints from (SELECT (@row_number:=@row_number + 1) AS num, name, company, type, href, minPoints 
                                        FROM jobs where name like ? and type like ? order by name) as ord where num >= ? and num < ?");
        $low_limit = $this->page*10;
        $big_limit = $this->page*10+10;
        $stmt->bind_param("ssii", $this->title, $this->type,$low_limit, $big_limit);
        $i = 0;
        $stmt->bind_result($this->jobs['name'.$i], $this->jobs['company'.$i], $this->jobs['type'.$i], $this->jobs['href'.$i], $minPoints);
        $stmt->execute();
        while ($stmt->fetch()) {
            if ($user->getPoints($this->jobs['type'.$i]) < $minPoints)
            {
                $this->jobs['name'.$i] = '';
                $this->jobs['company'.$i] = '';
                $this->jobs['type'.$i] = '';
                $this->jobs['href'.$i] = '';
            }
            $i++;
            $stmt->bind_result($this->jobs['name' . $i], $this->jobs['company' . $i], $this->jobs['type' . $i], $this->jobs['href' . $i], $minPoints);
        }
    }

    public function getJobs()
    {
        return $this->jobs;
    }
}