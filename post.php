<?php

require_once('createTodo.php');
$todos = $_POST;

$todo = new createTodo('post_todo');
$todo->todoValidate($todos);
$todo->todoCreate($todos);

?>