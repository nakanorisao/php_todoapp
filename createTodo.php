<?php
require_once('connectDB.php');

// 共通化できなさそうなものをdbcから移してくる
Class createTodo extends connectDatabase
{
    protected $table_name = 'todo_post';

    public function todoCreate($todo){  
        $sql = "INSERT INTO `{$this->table_name}`(title, content) VALUES (:title, :content)";
        $dbh = $this->dbConnect();
        $dbh->beginTransaction(); 

        try{
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $todo->title ,PDO::PARAM_STR);
        $stmt->bindValue(':content', $todo->content ,PDO::PARAM_STR);
        $stmt->execute();
        $dbh->commit(); 
        echo 'Todoを登録しました！';
        } catch(PDOException $e){
         exit($e->getMessage());
        }
    } 
}

?>