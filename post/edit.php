<?php
    require_once('../Database.php');
    require_once('../Utils.php');
    require_once('./Post.php');

    $db = Database::dbConnect();
    $id = $_GET['id'];

    if (empty($id)) {
        exit('IDが不正です');
    }

    $Post = new Post($db);

    if (!empty($_POST['update'])) {
        try {
            $content = Utils::h($_POST['content']);
            $Post->update($content, $id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    $TargetPost = $Post->getById($id);

    if (!$TargetPost) {
        exit('TODOが存在しません。');
    }
?>

<!DOCTYPE html>
<html lang="ja">
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
                    <textarea class="w-100" name="content" rows="3" value=""><?php echo $TargetPost['content']; ?></textarea>
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
