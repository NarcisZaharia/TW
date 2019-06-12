<?php

class Controller
{

    protected function model($model, $params = [])
    {
        if (file_exists('../app/models/'.$model.'.php'))
            require_once '../app/models/'.$model.'.php';
        else throw new Exception('Nu exista modelul dat');
        return new $model($params);
    }

    public function view($view, $data = [])
    {
        if (file_exists('../app/views/'.$view.'.php'))
            require_once '../app/views/'.$view.'.php';
    }

}