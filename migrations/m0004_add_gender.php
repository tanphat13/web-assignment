<?php
    use app\core\Application;

    class m0004_add_gender {
        public function up() {
            $db = Application::$app->db;
        $sql_command = "ALTER TABLE users ADD gender VARCHAR(10) NOT NULL;";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE users DROP gender;";
            $db->pdo->exec($sql_command);
        }
    }
?>