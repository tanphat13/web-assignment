<?php
    class Product {
        public $id;
        public $name;
        public $price;

        function __construct($id, $name, $price) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
        }

        static function all() {
            $list = [];
            $db = DB::getInstance();
            $req = $db->query('SELECT * FROM products');
            
            if ($req !== FALSE) {
                $rows = $req->fetchAll();
                foreach ($rows as $item) {
                    $list[] = new Product($item['id'], $item['name'], $item['price']);
                }
            } else {
                echo "Error in SQL";
            }
            return $list;
        }
    }
?>