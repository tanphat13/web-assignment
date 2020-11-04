<?php
    use app\core\Application;

    class m0003_add_foreign_key {
        public function up() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE addresses ADD CONSTRAINT user_address FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE ;
                ALTER TABLE orders ADD CONSTRAINT user_order FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE orders_products ADD CONSTRAINT order_identify FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE orders_products ADD CONSTRAINT product_identify FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE orders_products ADD CONSTRAINT item_identify FOREIGN KEY (serial_number) REFERENCES products_items(serial_number) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE products_items ADD CONSTRAINT product_item FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE products_items ADD CONSTRAINT item_branch FOREIGN KEY (branch_id) REFERENCES branches(branch_id) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE images ADD CONSTRAINT product_image FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE ON UPDATE CASCADE;
                ALTER TABLE users ADD CONSTRAINT staff_branch FOREIGN KEY (branch_id) REFERENCES branches(branch_id) ON DELETE CASCADE ON UPDATE CASCADE;
            ";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            $db = Application::$app->db;
            $sql_command = "ALTER TABLE users DROP FOREIGN KEY staff_branch;
                ALTER TABLE addresses DROP FOREIGN KEY user_address;
                ALTER TABLE orders DROP FOREIGN KEY user_order;
                ALTER TABLE orders_products DROP FOREIGN KEY order_identify;
                ALTER TABLE orders_products DROP FOREIGN KEY product_identify;
                ALTER TABLE orders_products DROP FOREIGN KEY item_identify;
                ALTER TABLE products_items DROP FOREIGN KEY product_item;
                ALTER TABLE products_items DROP FOREIGN KEY item_branch;
                ALTER TABLE images DROP FOREIGN KEY product_image;
            ";
            $db->pdo->exec($sql_command);
        }
    }
?>