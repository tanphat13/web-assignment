<?php

use app\core\Application; 

class m0001_users{
    public function up(){
        $db = Application::$app->db;
        $sql_command = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                fullname VARCHAR(255) NOT NULL,
                gender VARCHAR(255) NOT NULL,
                phone INT NOT NULL,
                status TINYINT NOT NULL,
                password VARCHAR(512) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($sql_command);
    }
    public function down(){ 
        echo "Applied migration";

    }



}




?>