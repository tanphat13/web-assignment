<?php
    use app\core\Application;

    class m0008_fix_order_status {
        public function up() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE orders CHANGE order_status order_status SET('PENDING','DELIVERING','DONE','CANCEL') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL;
                ALTER TABLE orders_products DROP INDEX serial_number;
                ALTER TABLE orders_products DROP FOREIGN KEY product_identify;
                ALTER TABLE orders_products DROP FOREIGN KEY order_identify;
                ALTER TABLE orders_products DROP PRIMARY KEY;
                ALTER TABLE orders_products ADD CONSTRAINT product_identify FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE NO ACTION ON UPDATE CASCADE;
                ALTER TABLE orders_products ADD CONSTRAINT order_identify FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE NO ACTION ON UPDATE CASCADE;
                ALTER TABLE orders_products CHANGE serial_number serial_number INT NULL;
                ALTER TABLE products_items CHANGE item_status item_status SET('IN STOCK','SOLD') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL;
            ";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE orders CHANGE order_status order_status VARCHAR(10) NULL DEFAULT NULL;
                ALTER TABLE orders_products ADD INDEX (serial_number);
                ALTER TABLE orders_products CHANGE serial_number serial_number INT NOT NULL;
                ALTER TABLE orders_products ADD PRIMARY KEY (product_id, order_id, serial_number);
                ALTER TABLE products_items CHANGE item_status item_status VARCHAR(20) NOT NULL DEFAULT NULL;
            ";
            $db->pdo->exec($sql_command);
        }
    }
?>