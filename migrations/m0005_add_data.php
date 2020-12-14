<?php
    use app\core\Application;

    class m0005_add_data {
        public function up() {
            $db = Application::$app->db;

            $sql_command = "INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (1,'Iphone 11 64GB',19990000,'Apple','Red',4,64,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (2,'Iphone 11 Pro Max 64GB',29990000,'Apple','Black',4,64,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (3,'Iphone 11 Pro 256GB',30990000,'Apple','Black',4,256,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (4,'Iphone 12 256GB',21990000,'Apple','White',4,256,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (5,'Iphone 12 Mini 64GB',21990000,'Apple','Blue',4,64,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (6,'Samsung Galaxy S20 FE',15990000,'Samsung','Blue',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (7,'Samsung Galaxy Z Fold2 5G',50000000,'Samsung','Gold',12,256,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (8,'Samsung Galaxy Note 20 Ultra 5G',30990000,'Samsung','Gold',12,256,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (9,'Samsung Galaxy S10 Lite',12990000,'Samsung','Blue',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (10,'Samsung Galaxy A21s',4690000,'Samsung','White',3,32,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (11,'OPPO A93',4690000,'Oppo','White',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (12,'OPPO Reno4',8490000,'Oppo','White',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (13,'OPPO Reno4 Pro',11990000,'Oppo','White',8,256,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (14,'OPPO A92',6490000,'Oppo','Purple',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (15,'OPPO Reno3 Pro',8990000,'Oppo','Black',8,256,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (16,'Xiaomi Mi 10T Pro',12990000,'Xiaomi','Black',8,256,'None',24) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (17,'Xiaomi POCO X3',6990000,'Xiaomi','Black',6,128,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (18,'Xiaomi Redmi Note 9 Pro',6490000,'Xiaomi','Black',6,64,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (19,'Xiaomi Redmi Note 9S',5990000,'Xiaomi','Blue-Coral',6,128,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (20,'Xiaomi Redmi Note 8',4490000,'Xiaomi','White',4,64,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (21,'Vivo Y12s 128GB',4290000,'Vivo','Black',4,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (22,'Vivo V20',8490000,'Vivo','Blue Pink',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (23,'Vivo Y20s',4990000,'Vivo','Blue',6,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (24,'Vivo X50',11990000,'Vivo','Black',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (25,'Vivo V19',7990000,'Vivo','Blue',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (26,'Vsmart Aris Pro',8990000,'Vsmart','Green',8,128,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (27,'Vsmart Live 4',4790000,'Vsmart','Black',6,64,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (28,'Vsmart Active 3',3990000,'Vsmart','Purple Ruby',6,64,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (29,'Vsmart Joy 4',3290000,'Vsmart','Black',3,64,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (30,'Vsmart Star 4',2490000,'Vsmart','Black',3,32,'None',18) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (31,'Nokia 8.3 5GB',11990000,'Nokia','Dark Blue',8,128,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (32,'Nokia 2.4',2490000,'Nokia','Black',2,32,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (33,'Nokia C2',1490000,'Nokia','Green',1,16,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (34,'Nokia 5.3',2890000,'Nokia','Black',3,64,'None',12) ;
            INSERT INTO products(product_id, product_name, product_price, product_brand, product_color, product_ram, product_rom, product_spec, warranty) 
            VALUES (35,'Nokia 8.1',6590000,'Nokia','Black',4,64,'None',12) ;
          
            INSERT INTO images(image_id, product_id, link) VALUES (1,1,'./assets/iphone-11-64gb-red.png');
            INSERT INTO images(image_id, product_id, link) VALUES (2,2,'./assets/iphone-11-pro-max-black.png');
            INSERT INTO images(image_id, product_id, link) VALUES (3,3,'./assets/iphone-11-pro-256gb-black.png');
            INSERT INTO images(image_id, product_id, link) VALUES (4,4,'./assets/iphone-12-256gb.png');
            INSERT INTO images(image_id, product_id, link) VALUES (5,5,'./assets/iphone-12-mini-64gb.png');
            INSERT INTO images(image_id, product_id, link) VALUES (6,6,'./assets/samsung-galaxy-s20-fan-edition.png');
            INSERT INTO images(image_id, product_id, link) VALUES (7,7,'./assets/samsung-galaxy-z-fold-2.png');
            INSERT INTO images(image_id, product_id, link) VALUES (8,8,'./assets/samsung-galaxy-note-20-ultra-5g.png');
            INSERT INTO images(image_id, product_id, link) VALUES (9,9,'./assets/samsung-galaxy-s10-lite.png');
            INSERT INTO images(image_id, product_id, link) VALUES (10,10,'./assets/samsung-galaxy-a21s-3gb.png');
            INSERT INTO images(image_id, product_id, link) VALUES (11,11,'./assets/oppo-a93.png');
            INSERT INTO images(image_id, product_id, link) VALUES (12,12,'./assets/oppo-reno4.png');
            INSERT INTO images(image_id, product_id, link) VALUES (13,13,'./assets/oppo-reno4-pro.png');
            INSERT INTO images(image_id, product_id, link) VALUES (14,14,'./assets/oppo-a92.png');
            INSERT INTO images(image_id, product_id, link) VALUES (15,15,'./assets/oppo-reno3-pro.png');
            INSERT INTO images(image_id, product_id, link) VALUES (16,16,'./assets/xiaomi-mi-10t-pro.png');
            INSERT INTO images(image_id, product_id, link) VALUES (17,17,'./assets/xiaomi-poco-x3.png');
            INSERT INTO images(image_id, product_id, link) VALUES (18,18,'./assets/xiaomi-redmi-note-9-pro.png');
            INSERT INTO images(image_id, product_id, link) VALUES (19,19,'./assets/xiaomi-redmi-note-9s.png');
            INSERT INTO images(image_id, product_id, link) VALUES (20,20,'./assets/xiaomi-redmi-note-8.png');
            INSERT INTO images(image_id, product_id, link) VALUES (21,21,'./assets/vivo-y12s-4gb-128gb.png');
            INSERT INTO images(image_id, product_id, link) VALUES (22,22,'./assets/vivo-v20-400-xanh-hong.png');
            INSERT INTO images(image_id, product_id, link) VALUES (23,23,'./assets/vivo-y20s-xanh.png');
            INSERT INTO images(image_id, product_id, link) VALUES (24,24,'./assets/vivo-x50.png');
            INSERT INTO images(image_id, product_id, link) VALUES (25,25,'./assets/vivo-v19-xanh.png');
            INSERT INTO images(image_id, product_id, link) VALUES (26,26,'./assets/vsmart-aris-pro-green.png');
            INSERT INTO images(image_id, product_id, link) VALUES (27,27,'./assets/vsmart-live-4-6gb-den.png');
            INSERT INTO images(image_id, product_id, link) VALUES (28,28,'./assets/vsmart-active-3-6gb-purple-ruby.png');
            INSERT INTO images(image_id, product_id, link) VALUES (29,29,'./assets/vsmart-joy-4-black.png');
            INSERT INTO images(image_id, product_id, link) VALUES (30,30,'./assets/vsmart-star-4-3gb-black.png');
            INSERT INTO images(image_id, product_id, link) VALUES (31,31,'./assets/nokia-83.png');
            INSERT INTO images(image_id, product_id, link) VALUES (32,32,'./assets/nokia-24.png');
            INSERT INTO images(image_id, product_id, link) VALUES (33,33,'./assets/nokia-c2-xanh.png');
            INSERT INTO images(image_id, product_id, link) VALUES (34,34,'./assets/nokia-53-den.png');
            INSERT INTO images(image_id, product_id, link) VALUES (35,35,'./assets/nokia-81-black.png');
            ";
            $db->pdo->exec($sql_command);
        }
        public function down() {
            echo "Applied migration";
        }
    }
?>