<?php
require_once('model.php');

class Controller{

    private $post;
    
    public function __construct($post){
        $this->post = $post;
    }

    public function todoValidate(){
        if(empty($this->post['title'])){
            exit('タイトルを入力してください');
        }        
        if(mb_strlen($this->post['title']) > 30){
            exit ('タイトルは30文字以下にしてください');
        }
        if(empty($this->post['content'])){
            exit('本文を入力してください');
        }
    }

    public function index(){
        $index = new getPost('post_todo');
        $indexdata = $index->getAlltodo();
        return $indexdata;  
    }

     public function update($post){
         $update = new updatePost('post_todo');
         $updatedata = $update->postUpdate($post);
         return $updatedata;
    }

    public function setID($id){
        $setid = new getPost('post_todo');
        $iddata = $setid->getById($id);
        return $iddata;
    }

    public function delete($id){
        $delete = new deletePost('post_todo');
        $deletedata = $delete->postDelete($id);
        return $deletedata;
    }

    public function create($post){
        $create = new createPost('post_todo');
        $createdata = $create->postCreate($post);
        return $createdata;
    }
}


$post = $_POST;
$controller = new Controller($post);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 新規作成フォームからの送信処理
    if ($_POST['action']  === 'create') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    // 新規作成メソッド
    $controller->todoValidate();
    $controller->create($post);
    header("Location: view_index.php");
  
    // 編集フォームからの送信処理
    } elseif ($_POST['action']  === 'update') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    // 編集メソッド
    $controller->todoValidate();
    $controller->update($post);
    header("Location: view_index.php");

    // 削除処理
  } elseif ($_POST['action']  === 'delete') {
    $id = $_POST['id'];
    $controller->delete($id);
    header("Location: view_index.php");

  }else {
    header("Location: view_index.php");
  }
  
}



