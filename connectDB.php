<?php

class connectDatabase
{
    protected $table_name;

    function __construct($table_name){
        $this->table_name = $table_name;
    }

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
        
     // データベースから全部取ってくる
     public function getAll(){
        $dbh= $this->dbConnect();
        $sql = "SELECT * FROM `{$this->table_name}`";
        $stmt = $dbh->query($sql);
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
            $stmt = $dbh->prepare("SELECT * FROM `{$this->table_name}` Where id = :id");                      
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

?>




