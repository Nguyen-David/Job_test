<?php


spl_autoload_register(function($class_name)
{
    // Масив с папками для автозгрузкии
    $array_paths = array(
        '/Model/',
        '/Components/',
        '/Controllers/'
    );

    //Ищем подходящий файл
    foreach ($array_paths as $path){
        $path = ROOT . $path . $class_name .'.php';
        if(is_file($path)){
            include_once  $path;
        }
    }
});