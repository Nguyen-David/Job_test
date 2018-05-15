<?php

class SiteController{

    public function actionIndex(){

        $email = '';
        $message = '';

        $result = false;
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $message = $_POST['message'];


            $errors = false;


            $browser =  $_SERVER['HTTP_USER_AGENT'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $tablet = array('ipad','iphone','android','windowsce', 'opera mobi','small');


            foreach ($tablet  as $tabletItem)
            {
                if(strripos($browser,$tabletItem) == false) {
                    $device = 'Мобильная версия';
                }
                else{
                    $device = 'Пк версия';
                }
            }

            $SxGeo = new SxGeo('SxGeoCity.dat');
            $city = $SxGeo->getCityFull($ip)['city']['name_ru'];
            if(!$city){
                $city = 'Локальный сервер';
            }

            if (!User::checkEmail($email)){
                $errors[] = 'Неправильный email';
            }

            if ($errors == false){
                $result = User::saveData($email,$message,$city,$browser,$device,$ip);
            }
        }


        require_once(ROOT . '/view/site/index.php');

        return true;
    }

    public function actionAdmin(){

        $user_data = array();
        $user_data = User::getUsersInfo();

        require_once(ROOT . '/view/admin/admin.php');

        return true;

    }

    public function actionAddAjax($id){
        $message = $_POST['message'];

        $result = User::edit($id,$message);

        return true;

    }

}