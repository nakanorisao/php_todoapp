<?php

require_once('createTodo.php');
$todos = $_POST;

$todo = new createTodo('post_todo');
$todo->title = $_POST['title']; // タイトルの代入
$todo->content = $_POST['content']; // コンテンツの代入
$todo->todoValidate($todos);
$todo->todoUpdate($todos);

?>