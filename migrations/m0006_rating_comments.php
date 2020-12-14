<?php
    use app\core\Application;

    class m0006_rating_comments {
        public function up() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE products ADD rating FLOAT NULL;
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
                CREATE TABLE comments (
                    comment_id INT AUTO_INCREMENT PRIMARY KEY,
                    product_id INT NOT NULL,
                    user_id INT NOT NULL,
                    is_answer INT NOT NULL,
                    answer_id INT NULL,
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
                ALTER TABLE comments ADD CONSTRAINT user_comment FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
                    ADD CONSTRAINT product_comment FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    ADD CONSTRAINT answer_comment FOREIGN KEY (answer_id) REFERENCES comments(comment_id) ON DELETE CASCADE ON UPDATE CASCADE;
                ";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE products DROP rating;
                DROP TABLE ratings;
                DROP TABLE comments;
            ";
            $db->pdo->exec($sql_command);
        }
    }
?>