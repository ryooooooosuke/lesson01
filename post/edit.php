<?php
    require('../db_connect.php');
    $db = dbConnect();

    $id = $_GET['id'];
    if (empty($id)) {
        exit('IDが不正です');
    }

    if (!empty($_POST['update'])) {
        try {
            $content = $_POST['content'];
            $sql = "UPDATE post SET content = :content WHERE id = :id";
            //実行準備
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':content', $content, PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    $id = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM post WHERE id = :id');
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        exit('TODOが存在しません。');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>TODOアプリ編集画面</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">TODO編集画面</h1>
        <div class="m-5">
            <h2 class="mx-auto">TODOアプリ</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <textarea class="w-100" name="content" rows="3" value=""><?php echo $post['content']; ?></textarea>
                </div>
                <div class="text-center">
                    <a href="index.php" class="btn btn-secondary">戻る</a>
                    <button type="submit" class="btn btn-primary" name="update" value="1">更新</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
