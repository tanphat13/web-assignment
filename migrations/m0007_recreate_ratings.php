<?php
    use app\core\Application;

    class m0007_recreate_ratings {
        public function up() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE users CHANGE created_by created_by INT NULL,
                CHANGE phone phone VARCHAR(11) NOT NULL;
            DROP TABLE ratings;
                CREATE TABLE ratings (
                    rating_id INT AUTO_INCREMENT PRIMARY KEY,
                    product_id INT NOT NULL,
                    user_id INT NOT NULL,
                    rate INT NOT NULL,
                    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                    created_by INT NULL,
                    updated_at TIMESTAMP NULL,
                    updated_by INT NULL,
                    deleted_at TIMESTAMP NULL,
                    deleted_by INT NULL
                    )ENGINE=INNODB;
                ALTER TABLE `ratings` ADD CONSTRAINT `user_rating` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; 
                ALTER TABLE `ratings` ADD CONSTRAINT `product_rating` FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE `mobile_shop`.`ratings` ADD UNIQUE `rate_once_time` (`user_id`(4), `product_id`(4));
                ";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE users CHANGE created_by created_by INT NOT NULL,
                CHANGE phone phone INT NOT NULL;
                CREATE TABLE ratings (
                    rating_id INT AUTO_INCREMENT PRIMARY KEY,
                    product_id INT NOT NULL,
                    user_id INT NOT NULL,
                    rate FLOAT NOT NULL,
                    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                    created_by INT NULL,
                    updated_at TIMESTAMP NULL,
                    updated_by INT NULL,
                    deleted_at TIMESTAMP NULL,
                    deleted_by INT NULL
                    )ENGINE=INNODB;
                ALTER TABLE ratings ADD UNIQUE (product_id, user_id),
                ADD CONSTRAINT user_rating FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
                ADD CONSTRAINT product_rating FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE ON UPDATE CASCADE;
                DROP TABLE ratings;";
            $db->pdo->exec($sql_command);
        }
    }
?>