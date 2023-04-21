<?php
require_once('controller.php');

$todos = new controller('post_todo');
$todos->index();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo</title>
</head>
<body>
<a href="view_new.php">新規作成</a>
    <table>
        <tr>
            <th>タイトル</th>
            <th>内容</th>
            <th>投稿日時</th>
            <th>更新日時</th>
        </tr>
        <?php foreach($todos->index() as $column){ ?>
        <tr>
            <td><a href="/php_todoapp/view_update_form.php?id=<?php if(isset($column)){echo $column['id'];} ?>">
                <?php if(isset($column)){echo $column['title'];} ?></a></td>
            <td><?php if(isset($column)){echo $column['content'];} ?></td>
            <td><?php if(isset($column)){echo $column['created_at'];} ?></td>
            <td><?php if(isset($column)){echo $column['updated_at'].PHP_EOL;}  ?></td>
            <td><a href="/php_todoapp/controller.php?id=<?php if(isset($column)){echo $column['id'];}?>">削除</a></td>
        </tr>
    </table>  
    <?php } ?>
</body>
</html>

