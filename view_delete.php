<?php 

require_once('controller.php');

$todo = new controller('post_todo');
$result = $todo->setID($_GET['id']);
$id = isset($result['id']) ? $result['id'] : '';
$title = isset($result['title']) ? $result['title'] : '';
$content = isset($result['content']) ? $result['content'] : '';

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
        <input type="hidden" name="action" value="delete">
        <p>タイトル：</p>
        <?php echo $title ?>
        <input type="hidden" name="tutle" value="<?php echo $title ?>">
        <p>本文：</p>
        <?php echo $content ?>
        <input type="hidden" name="content" value="<?php echo $content ?>">
        <br>
        <input type="submit" value="削除">
    </form>
</body>
</html>