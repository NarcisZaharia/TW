<?php

require_once '../app/init.php';


$app = new App();

//require_once(ROOT.DS.'lib'.DS.'init.php');

//$router = new Router($_SERVER['REQUEST_URI']);

//echo "<pre>";
//print_r('Route: '.$router->getRoute().PHP_EOL);
//print_r('Language: '.$router->getLanguage().PHP_EOL);
//print_r('Controller: '.$router->getController().PHP_EOL);
//print_r('Method prefix: '.$router->getMethodPrefix().$router->getAction().PHP_EOL);
//echo "Params: ";
//print_r($router->getParams());

//App::run($_SERVER['REQUEST_URI']);


//require_once 'Routes.php';
//
//function __autoload($class_name)
//{
//    if (file_exists('./classes/'.$class_name.'.php'))
//        require_once './classes/'.$class_name.'.php';
//    else if (file_exists('./Controllers/'.$class_name.'.php'))
//        require_once './Controllers/'.$class_name.'.php';
//
//}