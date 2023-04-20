<?php
require_once('connectDB.php');

class createTodo extends connectDatabase
{
    protected $table_name = 'post_todo';

    public function todoCreate($todos){  
        $sql = "INSERT INTO `{$this->table_name}`(title, content) VALUES (:title, :content)";
        $dbh = $this->dbConnect();
        $dbh->beginTransaction(); 

        try{
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $todos['title'] ,PDO::PARAM_STR);
        $stmt->bindValue(':content', $todos['content'] ,PDO::PARAM_STR);
        $stmt->execute();
        $dbh->commit(); 
        echo 'Todoを登録しました！';
        } catch(PDOException $e){
         exit($e->getMessage());
        }
    } 

    //TODOのバリデーション
    public function todoValidate($todos){
        if(empty($todos['title'])){
            exit('タイトルを入力してください');
        }
    
        if(mb_strlen($todos['title']) > 50){
            exit ('タイトルは255文字以下にしてください');
        }
    
        if(empty($todos['content'])){
            exit('本文を入力してください');
        }
    
    }


    public function todoUpdate($todos){
        $sql = "UPDATE `{$this->table_name}` SET title = :title, content = :content WHERE id = :id";
        $dbh = $this->dbConnect();
        $dbh->beginTransaction(); 

        try{
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $todos['title'] ,PDO::PARAM_STR);
        $stmt->bindValue(':content', $todos['content'] ,PDO::PARAM_STR);
        $stmt->bindValue(':id', $todos['id'] ,PDO::PARAM_INT);
        $stmt->execute();
        $dbh->commit(); 
        echo 'Todoを更新しました！';
        } catch(PDOException $e){
         exit($e->getMessage());
        }   
    }
}


?>