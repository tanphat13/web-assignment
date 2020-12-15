<?php
    use app\core\Application;

    class m0010_fix_images_data {
        public function up() {
            $db = Application::$app->db;
            $sql_command = "TRUNCATE images;
            INSERT INTO images(image_id, product_id, link) VALUES (1,1,'/assets/iphone-11-64gb-red.png');
            INSERT INTO images(image_id, product_id, link) VALUES (2,2,'/assets/iphone-11-pro-max-black.png');
            INSERT INTO images(image_id, product_id, link) VALUES (3,3,'/assets/iphone-11-pro-256gb-black.png');
            INSERT INTO images(image_id, product_id, link) VALUES (4,4,'/assets/iphone-12-256gb.png');
            INSERT INTO images(image_id, product_id, link) VALUES (5,5,'/assets/iphone-12-mini-64gb.png');
            INSERT INTO images(image_id, product_id, link) VALUES (6,6,'/assets/samsung-galaxy-s20-fan-edition.png');
            INSERT INTO images(image_id, product_id, link) VALUES (7,7,'/assets/samsung-galaxy-z-fold-2.png');
            INSERT INTO images(image_id, product_id, link) VALUES (8,8,'/assets/samsung-galaxy-note-20-ultra-5g.png');
            INSERT INTO images(image_id, product_id, link) VALUES (9,9,'/assets/samsung-galaxy-s10-lite.png');
            INSERT INTO images(image_id, product_id, link) VALUES (10,10,'/assets/samsung-galaxy-a21s-3gb.png');
            INSERT INTO images(image_id, product_id, link) VALUES (11,11,'/assets/oppo-a93.png');
            INSERT INTO images(image_id, product_id, link) VALUES (12,12,'/assets/oppo-reno4.png');
            INSERT INTO images(image_id, product_id, link) VALUES (13,13,'/assets/oppo-reno4-pro.png');
            INSERT INTO images(image_id, product_id, link) VALUES (14,14,'/assets/oppo-a92.png');
            INSERT INTO images(image_id, product_id, link) VALUES (15,15,'/assets/oppo-reno3-pro.png');
            INSERT INTO images(image_id, product_id, link) VALUES (16,16,'/assets/xiaomi-mi-10t-pro.png');
            INSERT INTO images(image_id, product_id, link) VALUES (17,17,'/assets/xiaomi-poco-x3.png');
            INSERT INTO images(image_id, product_id, link) VALUES (18,18,'/assets/xiaomi-redmi-note-9-pro.png');
            INSERT INTO images(image_id, product_id, link) VALUES (19,19,'/assets/xiaomi-redmi-note-9s.png');
            INSERT INTO images(image_id, product_id, link) VALUES (20,20,'/assets/xiaomi-redmi-note-8.png');
            INSERT INTO images(image_id, product_id, link) VALUES (21,21,'/assets/vivo-y12s-4gb-128gb.png');
            INSERT INTO images(image_id, product_id, link) VALUES (22,22,'/assets/vivo-v20-400-xanh-hong.png');
            INSERT INTO images(image_id, product_id, link) VALUES (23,23,'/assets/vivo-y20s-xanh.png');
            INSERT INTO images(image_id, product_id, link) VALUES (24,24,'/assets/vivo-x50.png');
            INSERT INTO images(image_id, product_id, link) VALUES (25,25,'/assets/vivo-v19-xanh.png');
            INSERT INTO images(image_id, product_id, link) VALUES (26,26,'/assets/vsmart-aris-pro-green.png');
            INSERT INTO images(image_id, product_id, link) VALUES (27,27,'/assets/vsmart-live-4-6gb-den.png');
            INSERT INTO images(image_id, product_id, link) VALUES (28,28,'/assets/vsmart-active-3-6gb-purple-ruby.png');
            INSERT INTO images(image_id, product_id, link) VALUES (29,29,'/assets/vsmart-joy-4-black.png');
            INSERT INTO images(image_id, product_id, link) VALUES (30,30,'/assets/vsmart-star-4-3gb-black.png');
            INSERT INTO images(image_id, product_id, link) VALUES (31,31,'/assets/nokia-83.png');
            INSERT INTO images(image_id, product_id, link) VALUES (32,32,'/assets/nokia-24.png');
            INSERT INTO images(image_id, product_id, link) VALUES (33,33,'/assets/nokia-c2-xanh.png');
            INSERT INTO images(image_id, product_id, link) VALUES (34,34,'/assets/nokia-53-den.png');
            INSERT INTO images(image_id, product_id, link) VALUES (35,35,'/assets/nokia-81-black.png');
            INSERT INTO `images` (`image_id`, `product_id`, `link`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES 
            (NULL, NULL, '/assets/bsale-pk-1-12.jpg', CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL),
            (NULL, NULL, '/assets/deal-ct-1-12_1.jpg', CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL),
            (NULL, NULL, '/assets/sale-ss-1-12.jpg', CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL),
            (NULL, NULL, '/assets/ipxsm-26-11.jpg', CURRENT_TIMESTAMP, NULL, NULL, NULL, NULL, NULL)
             ;";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            $db = Application::$app->db;
            $sql_command = "";
            $db->pdo->exec($sql_command);
        }
    }
?>