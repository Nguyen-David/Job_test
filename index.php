<?php

//$string = '21-11-2015';
//$pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
//$replace = 'Month: $2, Day: $1, Year: $3';
//echo preg_replace($pattern,$replace,$string);
//die;


// Front controller

// 1 Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

// Начало сесии

session_start();

// 2 Подключение файлов системы

define('ROOT',dirname(__FILE__));

require_once ("SxGeo.php");


require_once (ROOT.'/Components/Autoload.php');//Подключение автозагрузки

require_once (ROOT.'/Components/Router.php');



// 3 Установка соединение с БД
require_once (ROOT.'/Components/Db.php');

// 4 Вызов router

$router = new Router();
$router->run();