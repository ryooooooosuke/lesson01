<?php
    require_once('../Database.php');
    require_once('../Utils.php');
    require_once('./Post.php');

    $db = Database::dbConnect();
    $Post = new Post($db);

    if (!empty($_POST['submit_button'])) {
        try {
            $content = Utils::h($_POST['content']);
            $Post->create($content);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    $Posts = $Post->getAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>TODOアプリ</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">TODO一覧、登録画面</h1>
        <div class="m-5">
            <h2 class="mx-auto">TODOアプリ</h2>
            <form action="" method="POST">
                <label for="content"></label>
                <div class="form-group">
                    <textarea class="w-100" name="content" rows="3" placeholder="ここにTODOを入力"></textarea>
                </div>
                <div class="mt-2 text-center">
                    <button type="submit" class="btn btn-primary" name="submit_button" value="1">作成</button>
                </div>
            </form>
            <?php if(!empty($Posts)): ?>
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>メモ内容</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($Posts as $Post): ?>
                            <tr class="border-bottom">
                                <td><?php echo $Post['content']; ?></td>
                                <td><a href="edit.php?id=<?php echo $Post['id']; ?>" class="btn btn-primary">編集</a></td>
                                <td><a href="delete.php?id=<?php echo $Post['id']; ?>" class="btn btn-danger">削除</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>TODOはありません</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
