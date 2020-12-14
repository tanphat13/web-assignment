<?php
    use app\core\Application;

    class m0009_add_event_image {
        public function up() {
            $db = Application::$app->db;
            $sql_command = "INSERT INTO `images` (`image_id`, `product_id`, `link`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES 
            (NULL, NULL, './assets/bsale-pk-1-12.jpg', CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL),
            (NULL, NULL, './assets/deal-ct-1-12_1.jpg', CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL),
            (NULL, NULL, './assets/sale-ss-1-12.jpg', CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL),
            (NULL, NULL, './assets/ipxsm-26-11.jpg', CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL)
             ;";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            $db = Application::$app->db;
            $sql_command = "DELETE FROM `images` WHERE `images`.`image_id` = 36;
            DELETE FROM `images` WHERE `images`.`image_id` = 37;
            DELETE FROM `images` WHERE `images`.`image_id` = 38;
            DELETE FROM `images` WHERE `images`.`image_id` = 39;
            ";
            $db->pdo->exec($sql_command);
        }
    }
?>