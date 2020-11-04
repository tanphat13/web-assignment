<?php

use app\core\Application; 

class m0002_create_tables{
    public function up(){
        $db = Application::$app->db;
        $sql_command = "ALTER TABLE users DROP gender, DROP created_at;
            ALTER TABLE users ADD role VARCHAR(10) NULL DEFAULT 'user',
            ADD UNIQUE email (email),
            ADD branch_id INT NULL,
            ADD created_by INT NOT NULL,
            ADD created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            ADD updated_by INT NULL,
            ADD updated_at TIMESTAMP NULL,
            ADD deleted_by INT NULL,
            ADD deleted_at TIMESTAMP NULL;
            CREATE TABLE addresses (
                user_id INT NOT NULL,
                address TEXT NOT NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                created_by INT NULL,
                updated_at TIMESTAMP NULL,
                updated_by INT NULL,
                deleted_at TIMESTAMP NULL,
                deleted_by INT NULL
                )ENGINE=INNODB;
            CREATE TABLE orders (
                order_id INT AUTO_INCREMENT PRIMARY KEY,
                delivery_date TIMESTAMP NULL,
                address TEXT NOT NULL,
                user_id INT NOT NULL,
                order_status VARCHAR(10) NULL,
                order_note TEXT NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                created_by INT NULL,
                updated_at TIMESTAMP NULL,
                updated_by INT NULL,
                deleted_at TIMESTAMP NULL,
                deleted_by INT NULL
                )ENGINE=INNODB;
            CREATE TABLE products (
                product_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                product_name VARCHAR(100) NOT NULL,
                product_price REAL NOT NULL,
                product_brand VARCHAR(20) NOT NULL,
                product_color VARCHAR(30) NOT NULL,
                product_ram INT NOT NULL,
                product_rom INT NOT NULL,
                product_spec TEXT NOT NULL,
                warranty INT NOT NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                created_by INT NULL,
                updated_at TIMESTAMP NULL,
                updated_by INT NULL,
                deleted_at TIMESTAMP NULL,
                deleted_by INT NULL
                )ENGINE=INNODB;
            CREATE TABLE branches (
                branch_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                branch_address TEXT NOT NULL,
                branch_phone VARCHAR(11),
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                created_by INT NULL,
                updated_at TIMESTAMP NULL,
                updated_by INT NULL,
                deleted_at TIMESTAMP NULL,
                deleted_by INT NULL
                )ENGINE=INNODB;
            CREATE TABLE images (
                image_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                product_id INT NULL,
                link TEXT NOT NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                created_by INT NULL,
                updated_at TIMESTAMP NULL,
                updated_by INT NULL,
                deleted_at TIMESTAMP NULL,
                deleted_by INT NULL
                )ENGINE=INNODB;
            CREATE TABLE products_items (
                product_id INT NOT NULL,
                serial_number INT NOT NULL,
                branch_id INT NOT NULL,
                item_status VARCHAR(20) NOT NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                created_by INT NULL,
                updated_at TIMESTAMP NULL,
                updated_by INT NULL,
                deleted_at TIMESTAMP NULL,
                deleted_by INT NULL
                )ENGINE=INNODB;
            CREATE TABLE orders_products (
                order_id INT NOT NULL,
                product_id INT NOT NULL,
                serial_number INT NOT NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                created_by INT NULL,
                updated_at TIMESTAMP NULL,
                updated_by INT NULL,
                deleted_at TIMESTAMP NULL,
                deleted_by INT NULL
                )ENGINE=INNODB;
            ALTER TABLE orders_products ADD PRIMARY KEY (order_id, product_id, serial_number);
            ALTER TABLE orders_products ADD UNIQUE (serial_number);
            ";
        $db->pdo->exec($sql_command);
    }
    public function down(){ 
        $db = Application::$app->db;
        $sql_command = "ALTER TABLE users ADD gender VARCHAR(255) NOT NULL, ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
        ALTER TABLE users DROP UNIQUE email, DROP branch_id, DROP created_by, DROP updated_at, DROP updated_by, DROP deleted_at, DROP deleted_by;
        DROP TABLE addresses;
        DROP TABLE orders;
        DROP TABLE products;
        DROP TABLE branches;
        DROP TABLE images;
        DROP TABLE products_items;
        DROP TABLE orders_products;";
        $db->pdo->exec($sql_command);
    }
}
?>