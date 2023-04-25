<?php

class connectDatabase{

    public function dbConnect(){
        $dsn = 'mysql:host=localhost;dbname=todo;charset=utf8';
        $user = 'root';
        $pass = '';
    
        try{
            $dbh = new PDO($dsn,$user,$pass,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);    
        }catch(PDOException $e){
              echo "接続失敗".$e->getMessage();
            exit();
        }
        return $dbh;
    } 
}