<?php 

require_once('controller.php');

// 4/21作業中
// $todo = new controller('post_todo');
// $todo->update($_GET['id']);

// $id = $result['id'];
// $title = $result['title'];
// $content = $result['content'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditTodo</title>
</head>
<body>
    <h2>編集</h2>
    <form action="controller.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <p>タイトル：</p>
        <input type="text" name="title" value="<?php echo $title ?>">
        <p>本文：</p>
        <textarea name="content" id="content" cols="30" rows="10"><?php echo $content ?></textarea>
        <br>
        <input type="submit" value="送信">
    </form>
</body>
</html>