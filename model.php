<?php
require_once('connectDatabase.php');

class getPost {
    private $dbh; 
    private $table_name;

    function __construct($table_name){
        $this->table_name = $table_name;
        $connect = new connectDatabase();
        $this->dbh = $connect->dbConnect();
    }

    public function getAlltodo(){
        $dbh = $this->dbh;
        $sql = "SELECT * FROM `{$this->table_name}`";
        $stmt = $dbh->query($sql);
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        $dbh = null;
        return $result;
    }

    // IDから一つとってくる
    public function getById($id) {
        $dbh = $this->dbh;
        $stmt = $dbh->prepare("SELECT * FROM `{$this->table_name}` WHERE id = :id");                      
        $stmt-> bindValue(':id', (int)$id, PDO::PARAM_INT); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $result;
    }
}

class createPost {
    private $dbh; 
    
    private $table_name;

    function __construct($table_name){
        $this->table_name = $table_name;
        $connect = new connectDatabase();
        $this->dbh = $connect->dbConnect();
    }

    public function postCreate($post){  
        $dbh = $this->dbh;
        $sql = "INSERT INTO `{$this->table_name}`(title, content) VALUES (:title, :content)";
        $dbh->beginTransaction(); 

        try{
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $post['title'] ,PDO::PARAM_STR);
        $stmt->bindValue(':content', $post['content'] ,PDO::PARAM_STR);
        $stmt->execute();
        $dbh->commit(); 
        $dbh = null;
        } catch(PDOException $e){
         exit($e->getMessage());
        }
    } 
}

class updatePost {
    private $dbh; 
    
    private $table_name;

    function __construct($table_name){
        $this->table_name = $table_name;
        $connect = new connectDatabase();
        $this->dbh = $connect->dbConnect();
    }

    public function postUpdate($post){
        $dbh = $this->dbh;
        $sql = "UPDATE `{$this->table_name}` SET title = :title, content = :content WHERE id = :id";
        $dbh->beginTransaction(); 

        try{
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $post['title'] ,PDO::PARAM_STR);
        $stmt->bindValue(':content', $post['content'] ,PDO::PARAM_STR);
        $stmt->bindValue(':id', $post['id'] ,PDO::PARAM_INT);
        $stmt->execute();
        $dbh->commit(); 
        $dbh = null;
        } catch(PDOException $e){
         exit($e->getMessage());
        }   
    }
}

class deletePost{
    private $dbh; 
    
    private $table_name;

    function __construct($table_name){
        $this->table_name = $table_name;
        $connect = new connectDatabase();
        $this->dbh = $connect->dbConnect();
    }
    public function postDelete($id){
        $dbh = $this->dbh;
        
        try {
            $sql = "DELETE FROM `{$this->table_name}` WHERE id = :id";
            $dbh->beginTransaction();
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit(); 
            $dbh = null;
        } catch(PDOException $e){
            exit($e->getMessage());
        }   
    }
}






