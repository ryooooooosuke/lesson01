<?php
    require_once('../Database.php');
    require_once('./Post.php');

    $db = Database::dbConnect();

    $id = $_GET['id'];
    if (empty($id)) {
        exit('IDが不正です');
    }

    if ($id) {
        try {
            $Post = new Post($db);
            $Post->delete($id);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    header("location: index.php");
    exit();
?>
