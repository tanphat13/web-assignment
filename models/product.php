<?php
    namespace app\models;
    use app\core\Application;
    use app\core\DbModel;

    class Product extends DbModel {

        public int $product_id = 0;
        public string $product_name = '';
        public string $product_brand = '';
        public int $product_price = 0;
        public string $product_color = '';
        public int $product_ram = 0;
        public int $product_rom = 0;
        public string $product_spec = '';
        public int $warranty = 0; 
        public function rules(): array {
            return [
                // 'product_id' => [self::RULE_REQUIRED, self::RULE_UNIQUE],
                'product_name' => [self::RULE_REQUIRED],
                'product_brand' => [self::RULE_REQUIRED],
                'product_price' => [self::RULE_REQUIRED],
                'product_color' => [self::RULE_REQUIRED],
                'product_ram' => [self::RULE_REQUIRED],
                'product_rom' => [self::RULE_REQUIRED],
                'product_spec' => [self::RULE_REQUIRED],
                'warranty' => [self::RULE_REQUIRED],
            ];
        }

        public static function tableName(): string {
            return 'products';
        }

        public static function attribute(): array {
            return ['product_name', 'product_price', 'product_brand', 'product_color', 'product_ram', 'product_rom', 'product_spec', 'warranty'];
        }

        public static function primaryKey(): string {
            return 'product_id';
        }

        public static function userRole(): string {
            return '';
        }

        public function save(){
            // echo "<pre>";
            // echo var_dump($this);
            // echo "</pre>";
            // exit;
            return parent::save();
        }
        public function getSpecificProduct(int $id) {
            $product = self::findOne($this->tableName(), ['product_id' => $id]);
            if (!$product) {
                $this->addErrorMessage('product_id', 'Product Not Found');
                return false;
            }
            setcookie('productId', $id);
            $product_images = self::findAll('images', ['product_id' => $product->product_id]);
            
            // Get list of same model but different specificity in RAM/ROM
            $sql_command = self::prepare("SELECT product_id,product_ram,product_rom,product_price FROM products WHERE product_id IN (SELECT MIN(product_id) FROM products WHERE product_name = '$product->product_name' GROUP BY product_rom) AND (NOT product_ram = $product->product_ram OR NOT product_rom = $product->product_rom)");
            $sql_command->execute();
            $diff_spec = $sql_command->fetchAll();
            
            // Get list of same model but different color
            $diff_color = self::findAll($this->tableName(), ['product_name' => $product->product_name, 'product_ram' => $product->product_ram, 'product_rom' => $product->product_rom]);
            return compact('product', 'diff_spec', 'diff_color', 'product_images');
        }

        public function updateProductRating(int $product_id, float $rate) {
            $product = self::findOne($this->tableName(), ['product_id' => $product_id]);
            
            $sql_command = self::prepare("SELECT COUNT(*) AS number_of_rating FROM ratings WHERE product_id = $product_id GROUP BY product_id");
            $sql_command->execute();
            $number_of_rating = $sql_command->fetchObject()->number_of_rating;

            $new_rate = ($product->rating*($number_of_rating - 1) + $rate)/($number_of_rating);
            $new_rate = round($new_rate, 2);

            $sql_command = self::prepare("UPDATE products SET rating = $new_rate WHERE product_id = $product_id");
            $sql_command->execute();
        }

        public function getProductInCart($listProductId) {
            $products = array();
            foreach ($listProductId as $product_id) {
                $sql_command = self::prepare("SELECT products.product_id, products.product_name, products.product_price, products.product_color, products.product_ram, products.product_rom, MIN(images.image_id), images.link 
                FROM products LEFT JOIN images ON products.product_id = images.product_id WHERE products.product_id = $product_id GROUP BY products.product_name;");
                $sql_command->execute();
                array_push($products, $sql_command->fetchObject());
            }
            return $products;
        }
        public function updateProduct(){
            $tableName = $this->tableName();
            $attributes = $this->attribute();
            $params = array_map(fn ($attr) => "$attr = :$attr", $attributes);
            $sql_command = self::prepare("
                UPDATE $tableName
                SET " . implode(',', $params) . "
                WHERE product_id = " . $this->product_id . "; 
            ");
            foreach ($attributes as $attribute) {
                $sql_command->bindValue(":$attribute", $this->{$attribute});
                echo var_dump($this->{$attribute});
            }
           
            return $sql_command->execute();
        }
    }
?>