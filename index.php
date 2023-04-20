<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todo</title>
</head>
<body>
    <table>
        <tr>
            <th>No</th>
            <th>タイトル</th>
            <th>内容</th>
            <th>投稿日時</th>
        </tr>

        <?php foreach(getAllTodo() as $column); ?>
        <tr>
            <td><?php echo $column['id'] ?></td>
            <td><?php echo $column['title'] ?></td>
            <td><?php echo $column['content'] ?></td>
            <td><?php echo $column['date'] ?></td>
        </tr>
    </table>  
</body>
</html>