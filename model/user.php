<?php

class User extends DBconnect{
    
    private $userId;
    private $userName;
    private $userSurname;
    private $userEmail;
    private $userPassword;
    private $roleId;

    public function setUserId($email){

        $query = $this->connect()->prepare("SELECT user_id FROM users WHERE user_email= :email");
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $fetchResult = $query->fetch();

        $this->userId = $fetchResult['user_id'];
    }

    public function setUserName($id){

        $query = $this->connect()->prepare("SELECT user_name FROM users WHERE user_id= :id");
        $query->bindValue(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $fetchResult = $query->fetch();

        $this->userName = $fetchResult['user_name'];
    }

    public function setUserSurname(){
        
    }

    public function setUserEmail(){
        
    }

    public function setUserPassword(){
        
    }

    public function setRoleId(){
        
    }


    public function getUserId(){
        return $this->userId;
    }

    public function getUserName(){
        return $this->userName;
    }

    public function getUserSurname(){
        
    }

    public function getUserEmail(){
        
    }

    public function getUserPassword(){
        
    }
    
    public function getRoleId(){
        
    }

}
