<?php
    require('../../Database.php');
    $db = Database::dbConnect();

    try {
        $sql = 'CREATE TABLE post (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            content VARCHAR(255) NOT NULL,
            create_date DATETIME,
            update_date TIMESTAMP
        )';
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
