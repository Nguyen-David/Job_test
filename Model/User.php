<?php
/**
 * Created by PhpStorm.
 * User: Lenovo Z570
 * Date: 14.05.2018
 * Time: 21:18
 */

class User
{
    public static function saveData($email,$message,$city,$browser,$device,$ip){
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (email,message,city,browser,device,ip)'
            .' VALUES (:email,:message,:city,:browser,:device,:ip)';

        $result =  $db->prepare($sql);
        $result->bindParam(':email',$email,PDO::PARAM_STR);
        $result->bindParam(':message',$message,PDO::PARAM_STR);
        $result->bindParam(':city',$city,PDO::PARAM_STR);
        $result->bindParam(':browser',$browser,PDO::PARAM_STR);
        $result->bindParam(':device',$device,PDO::PARAM_STR);
        $result->bindParam(':ip',$ip,PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getUsersInfo(){
        $db = Db::getConnection();
        $usersList = array();

        $result = $db->query('SELECT * FROM user'
        .' ORDER by id ASC');

        $i = 0;
        while ($row = $result->fetch()){
            $usersList[$i]['id'] = $row['id'];
            $usersList[$i]['email'] = $row['email'];
            $usersList[$i]['message'] = $row['message'];
            $usersList[$i]['city'] = $row['city'];
            $usersList[$i]['browser'] = $row['browser'];
            $usersList[$i]['device'] = $row['device'];
            $usersList[$i]['ip'] = $row['ip'];

            $i++;
        }

        return $usersList;

    }

    public static function edit($id,$message){
        $db = Db::getConnection();

        echo $message;
        echo '<br/>'.$id;

        $sql = "UPDATE user 
            SET message = :message 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->bindParam(':message',$message,PDO::PARAM_STR);


        return $result->execute();

    }


    public static function checkEmail($email)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }



}