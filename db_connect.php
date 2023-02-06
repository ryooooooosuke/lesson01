<?php
    require_once('env.php');

    function dbConnect() {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $user = DB_USER;
        $passWord = DB_PASS;
        $dsn = "mysql:dbname=$dbName;host=$host;charset=utf8mb4";

        try {
            $db = new PDO($dsn, $user, $passWord);
        } catch(PDOException $e) {
            echo 'DB接続エラー' . $e->getMessage();
            exit();
        }
        return $db;
    }
?>
