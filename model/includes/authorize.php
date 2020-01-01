<?php

class Authorize extends DBconnect{

    public function checkEmail($email){

        $query = $this->connect()->prepare("SELECT user_email FROM users WHERE user_email=:email");
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $fetchResult = $query->rowCount();

        return $fetchResult;
    }

    public function checkPassword($email){

        $query = $this->connect()->prepare("SELECT user_password FROM users WHERE user_email=:email");
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $fetchResult = $query->fetch();

        return $fetchResult;
    }
}