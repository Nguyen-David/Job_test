<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routespath = ROOT.'/config/routes.php';

        $this->routes = include($routespath);


    }

    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI']))
            return trim($_SERVER['REQUEST_URI'], '/');

    }


    public function run()
    {

        //Получить строку запроса
        $uri = $this->getURI();


        //Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPatern => $path) {

            //Сравнить Uripattern i uri
            if(preg_match("~$uriPatern~", $uri)) {
                $internalRoute = preg_replace("~$uriPatern~",$path,$uri);


                //Если есть совпадения определить какой  контроллер
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                //Подключение файл класса
                $controllerFile = ROOT . '/controllers/' .
                    $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }


                //и action обрабатывает запрос
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject,$actionName), $parameters);
                if($result !=null){
                    break;
                }
            }

        }
    }
}