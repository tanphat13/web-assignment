<?php
    use app\core\Application;

    class m0011_add_user_product_item {
        public function up() {
            $db = Application::$app->db;

            $sql_command = "
            INSERT INTO branches (branch_id, branch_address, branch_phone) 
            VALUES (1, '288 Duong 3 thang 2', '0937058859'),
            (2, '4B Cong Hoa', '0937058859'),
            (3, '5 Nguyen Kiem, Go Vap', '0937058859');
            INSERT INTO users (id,email,fullname,phone,status,password,role,branch_id, gender) 
            VALUES (1, 'ngonguyenthuan2302@gmail.com', 'Ngo Nguyen Thuan','0123638265',1, '$2y$10$hgz0.zAnVAO08tPANIsAb.I9hh2p187my/.EkOHQLD7u8C6SqrK0q', 'user', NULL,'Male' ),
            (2, 'staff1@gmail.com', 'Hoang Long','0366318261',1, '$2y$10$PY/V9GUdiYgPiGNcA19O2eghkuw03fhuonzI/a2WZrIj4vUyo7DSm', 'staff'',1, 'Male' ),            
            (3, 'admin@mobile.com', 'admin','0988888888',1, '$2y$10$VPm6/L3T5w4o6E31CBexU.VlGSgZO2p2SkaJRGPUKNiOQAZLkUCFW', 'admin',1, 'Male' );


            INSERT INTO products_items (product_id, serial_number, branch_id, item_status)
            VALUES (1, 00001, 1, 'IN STOCK'),
            (1, 00002, 3, 'IN STOCK'),
            (2, 00003, 2, 'IN STOCK'),
            (2, 00004, 1, 'IN STOCK'),
            (3, 00005, 2, 'IN STOCK'),
            (3, 00006, 1, 'IN STOCK'),
            (4, 00007, 3, 'IN STOCK'),
            (4, 00008, 2, 'IN STOCK'),
            (5, 00009, 2, 'IN STOCK'),
            (5, 00010, 1, 'IN STOCK'),
            (6, 00011, 3, 'IN STOCK'),
            (6, 00012, 3, 'IN STOCK'),
            (7, 00013, 2, 'IN STOCK'),
            (7, 00014, 1, 'IN STOCK'),
            (8, 00015, 1, 'IN STOCK'),
            (8, 00016, 3, 'IN STOCK'),
            (9, 00017, 1, 'IN STOCK'),
            (9, 00018, 2, 'IN STOCK'),
            (10, 00019, 1, 'IN STOCK'),
            (10, 00020, 3, 'IN STOCK'),
            (11, 00021, 3, 'IN STOCK'),
            (11, 00022, 2, 'IN STOCK'),
            (12, 00023, 1, 'IN STOCK'),
            (12, 00024, 2, 'IN STOCK'),
            (13, 00025, 3, 'IN STOCK'),
            (13, 00026, 1, 'IN STOCK'),
            (14, 00027, 2, 'IN STOCK'),
            (14, 00028, 1, 'IN STOCK'),
            (15, 00029, 1, 'IN STOCK'),
            (15, 00030, 3, 'IN STOCK'),
            (16, 00031, 2, 'IN STOCK'),
            (16, 00032, 3, 'IN STOCK'),
            (17, 00033, 3, 'IN STOCK'),
            (17, 00034, 3, 'IN STOCK'),
            (18, 00035, 2, 'IN STOCK'),
            (18, 00036, 2, 'IN STOCK'),
            (19, 00037, 1, 'IN STOCK'),
            (19, 00038, 3, 'IN STOCK'),
            (20, 00039, 1, 'IN STOCK'),
            (20, 00040, 3, 'IN STOCK'),
            (21, 00041, 3, 'IN STOCK'),
            (21, 00042, 2, 'IN STOCK'),
            (22, 00043, 2, 'IN STOCK'),
            (22, 00044, 1, 'IN STOCK'),
            (23, 00045, 3, 'IN STOCK'),
            (23, 00046, 3, 'IN STOCK'),
            (24, 00047, 1, 'IN STOCK'),
            (24, 00048, 2, 'IN STOCK'),
            (25, 00049, 1, 'IN STOCK'),
            (25, 00050, 3, 'IN STOCK'),
            (26, 00051, 3, 'IN STOCK'),
            (26, 00052, 2, 'IN STOCK'),
            (27, 00053, 1, 'IN STOCK'),
            (27, 00054, 3, 'IN STOCK'),
            (28, 00055, 2, 'IN STOCK'),
            (28, 00056, 1, 'IN STOCK'),
            (29, 00057, 2, 'IN STOCK'),
            (29, 00058, 2, 'IN STOCK'),
            (30, 00059, 3, 'IN STOCK'),
            (30, 00060, 3, 'IN STOCK'),
            (31, 00061, 1, 'IN STOCK'),
            (31, 00062, 2, 'IN STOCK'),
            (32, 00063, 2, 'IN STOCK'),
            (32, 00064, 3, 'IN STOCK'),
            (33, 00065, 1, 'IN STOCK'),
            (33, 00066, 3, 'IN STOCK'),
            (34, 00067, 2, 'IN STOCK'),
            (34, 00068, 3, 'IN STOCK'),
            (35, 00069, 1, 'IN STOCK'),
            (35, 00070, 2, 'IN STOCK');

            ALTER TABLE addresses DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE comments DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE branches DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE images DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE orders DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE orders_products DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE products DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE products_items DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE ratings DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
            ALTER TABLE users DROP created_by, DROP updated_by, DROP updated_at, DROP deleted_by, DROP deleted_at;
            ALTER TABLE products_items ADD CONSTRAINT product_item FOREIGN KEY (product_id) REFERENCES products`(product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
            ALTER TABLE images ADD CONSTRAINT product_image FOREIGN KEY (product_id) REFERENCES products`(product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
            DELIMITER $$
                CREATE DEFINER=`root`@`localhost` PROCEDURE get_order_in_process`(IN in_user` INT)
                BEGIN
                    SELECT o1.order_id, o1.delivery_date, o1.order_status, o1.order_method, o1.created_at, o1.order_note, o2.total_price FROM ((SELECT * FROM orders o WHERE o.user_id = in_user AND (o.order_status = 'PENDING' OR o.order_status = 'DELIVERING') ORDER BY o.created_at) o1 JOIN (SELECT op.order_id, SUM(p.product_price) as total_price FROM orders_products op JOIN products p ON op.product_id = p.product_id GROUP BY op.order_id) o2 ON o1.order_id = o2.order_id);
                END$$
            DELIMITER ;
                DELIMITER $$
                CREATE DEFINER=`root`@`localhost` PROCEDURE get_done_order`(IN in_user` INT)
                BEGIN
                    SELECT o1.order_id, o1.delivery_date, o1.order_status, o1.order_method, o1.created_at, o1.order_note, o2.total_price FROM ((SELECT * FROM orders o WHERE o.user_id = in_user AND (o.order_status = 'CANCEL' OR o.order_status = 'DONE') ORDER BY o.created_at) o1 JOIN (SELECT op.order_id, SUM(p.product_price) as total_price FROM orders_products op JOIN products p ON op.product_id = p.product_id GROUP BY op.order_id) o2 ON o1.order_id = o2.order_id);
                END$$
            DELIMITER ;

            


            ";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            echo "Applied migration";
        }
    }
?>