<?php

include("http://localhost/TeaSk%20MVC/public/dom-scrapper/simple_html_dom.php");
include "../public/dom-scrapper/simple_html_dom.php";

class ScrapperJobs
{
    private $jobs = [];

    public function __construct()
    {
        require_once("http://localhost/TeaSk%20MVC/public/dom-scrapper/simple_html_dom.php");
        $html = file_get_html('https://www.meetup.com/find/tech/');
        $html1 = file_get_html('https://www.bestjobs.eu/ro/locuri-de-munca?keyword=IT&location=');

        foreach($ret = $html->find('a[class=display-none]') as $e)
            $jobs[$e->innertext] = $e->href;
        foreach($ret = $html1->find('a[class=truncate-2-line show-detail-in-modal card-link]') as $e)
            $jobs[$e->innertext] = $e->href;
        $this->jobs = $jobs;
    }

    public function getJobs()
    {
        return $this->jobs;
    }
}




