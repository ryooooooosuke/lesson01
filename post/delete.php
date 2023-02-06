<?php
    require('../db_connect.php');
    $db = dbConnect();

    $id = $_GET['id'];
    if (empty($id)) {
        exit('IDが不正です');
    }

    if ($id) {
        try {
            $sql = "DELETE FROM post WHERE id = :id";
            $stmt = $db-> prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    header("location: index.php");
    exit();
?>
