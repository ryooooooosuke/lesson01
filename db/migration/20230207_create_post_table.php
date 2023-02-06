<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require('db_connect.php');
        $db = dbConnect();

        try {
            $sql = 'CREATE TABLE post (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                content VARCHAR(255) NOT NULL,
                create_date TIMESTAMP,
                update_date DATETIME
            )';
            $stmt = $db->prepare($sql);
            $stmt->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    ?>
</body>
</html>
