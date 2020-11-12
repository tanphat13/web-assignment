<?php
    namespace app\models;
    use app\core\Application;
    use app\core\DbModel;

    class Product extends DbModel {
        public int $product_id = 0;
        public string $product_name = '';
        public string $product_brand = '';
        public float $product_price = 0.0;
        public string $product_color = '';
        public int $product_ram = 0;
        public int $product_rom = 0;
        public string $product_spec = '';
        public int $warranty = 0;

        public function rules(): array {
            return [
                'product_id' => [self::RULE_REQUIRED, self::RULE_UNIQUE],
                'product_name' => [self::RULE_REQUIRED],
                'product_brand' => [self::RULE_REQUIRED],
                'product_price' => [self::RULE_REQUIRED],
                'product_color' => [self::RULE_REQUIRED],
                'product_ram' => [self::RULE_REQUIRED],
                'product_rom' => [self::RULE_REQUIRED],
                'product_spec' => [self::RULE_REQUIRED],
                'product_warranty' => [self::RULE_REQUIRED],
            ];
        }

        public function tableName(): string {
            return 'products';
        }

        public function attribute(): array {
            return ['product_name', 'product_price', 'product_brand', 'product_color', 'product_ram', 'product_rom', 'product_spec', 'warranty'];
        }

        public function primaryKey(): string {
            return 'product_id';
        }

        public function userRole(): string {
            return '';
        }

        public function getSpecificProduct(int $id) {
            $product = self::findOne($this->tableName(), ['product_id' => $id]);
            if (!$product) {
                $this->addErrorMessage('product_id', 'Product Not Found');
                return false;
            }
            $sql_command = self::prepare("SELECT * FROM products WHERE product_name = '$product->product_name' AND (NOT product_ram = $product->product_ram OR NOT product_rom = $product->product_rom)");
            $sql_command->execute();
            $same_model = $sql_command->fetchAll();
            return compact('product', 'same_model');
        }
    }
?>