<?php

require_once('model.php');


class controller{

    // サニタイズする：未完成
    private $post;
    public function __construct($post){
        $this->post = $post;
    }

    public function sanitize($post){
        $post = htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        return $post;
    }

    // 受け取った情報をサニタイズ：未完成

    //TODOのバリデーション：未完成
    public function todoValidate(){
        if(empty($this->post['title'])){
            exit('タイトルを入力してください');
        }        
        if(mb_strlen($this->post['title']) > 50){
                exit ('タイトルは255文字以下にしてください');
        }
        if(empty($this->post['content'])){
            exit('本文を入力してください');
        }
        }
    

    public function index(){
        $model = new getPost('post_todo');
        $indexdata = $model->getAlltodo();
        return $indexdata;  
    }

    // 4/21作業中
    // public function update(){
    //     $update = new updatePost('post_todo');
    //     $updatedata = $update->postUpdate();
    //     return $updatedata;
    // }


}



?>