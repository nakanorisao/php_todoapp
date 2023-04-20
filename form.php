<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoForm</title>
</head>
<body>
    <h2>新規作成</h2>
    <form action="post.php" method="POST">
        <p>タイトル：</p>
        <input type="text" name="title">
        <p>本文：</p>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <br>
        <input type="submit" value="送信">
    </form>
</body>
</html>


