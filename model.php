<?php
require_once('controller.php');

trait connectDatabase
{
    
    protected function dbConnect(){
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

class getPost {
    use connectDatabase;

    private $table_name;


    function __construct($table_name){
        $this->table_name = $table_name;
    }

    public function getAlltodo(){
        $dbh = $this->dbConnect();
        $sql = "SELECT * FROM `{$this->table_name}`";
        $stmt = $dbh->query($sql);
        $stmt->execute();
        $result = $stmt->fetchall(PDO::FETCH_ASSOC);
        $dbh = null;
        return $result;
    }


    // テーブルが変わっても、IDから一つとってくる
    public function getById($id) {
        if(empty($id)){
        exit('idが不正です');
        }
        $dbh = $this->dbConnect();
        $stmt = $dbh->prepare("SELECT * FROM `{$this->table_name}` WHERE id = :id");                      
        $stmt-> bindValue(':id', (int)$id, PDO::PARAM_INT); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$result){
            exit('TODOがありません');
        }
        $dbh = null;
        return $result;
    }

}



class createPost {
    use connectDatabase;
    
    private $table_name;

    function __construct($table_name){
        $this->table_name = $table_name;
    }

    public function postCreate($todos){  
        $dbh = $this->dbConnect();
        $sql = "INSERT INTO `{$this->table_name}`(title, content) VALUES (:title, :content)";
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

}


class updatePost {
    use connectDatabase;
    
    private $table_name;

    function __construct($table_name){
        $this->table_name = $table_name;
    }

    public function postUpdate($post){
        $dbh = $this->dbConnect();
        $sql = "UPDATE `{$this->table_name}` SET title = :title, content = :content WHERE id = :id";
        $dbh->beginTransaction(); 

        try{
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':title', $post['title'] ,PDO::PARAM_STR);
        $stmt->bindValue(':content', $post['content'] ,PDO::PARAM_STR);
        $stmt->bindValue(':id', $post['id'] ,PDO::PARAM_INT);
        $stmt->execute();
        $dbh->commit(); 
        echo 'Todoを更新しました！';
        } catch(PDOException $e){
         exit($e->getMessage());
        }   
    }
}

class deletePost{
        use connectDatabase;
        
        private $table_name;
    
        function __construct($table_name){
            $this->table_name = $table_name;
        }

        public function postDelete($id){
            $dbh = $this->dbConnect();
            $sql = "DELETE FROM `{$this->table_name}` WHERE id = :id";
            $dbh->beginTransaction();

            try {
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            } catch(PDOException $e){
                exit($e->getMessage());
               }   
        }

}



?>




