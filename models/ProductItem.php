<?php
    namespace app\models;
    use app\core\DbModel;

    class ProductItem extends DbModel {

        public int $product_id;
        public int $serial_number;
        public int $branch_id;
        public int $item_status;
        public function rules(): array {
            return [
                'product_id' => [self::RULE_REQUIRED],
                'serial_number' => [self::RULE_UNIQUE, self::RULE_REQUIRED],
                'item_status' => [self::RULE_REQUIRED],
            ];
        }
        public static function tableName(): string {
            return 'products_items';
        }
        public static function attribute(): array {
            return ['product_id', 'branch_id', 'item_status'];
        }
        public static function primaryKey(): string {
            return 'serial_number';
        }
        public static function userRole(): string {
            return '';
        }

        public function getItem($product_id) {
            $sql_command = self::prepare("SELECT serial_number FROM products_items WHERE product_id = $product_id AND item_status = 'IN STOCK' LIMIT 1");
            $sql_command->execute();
            $item = $sql_command->fetchObject();
            $item_sn = intval($item->serial_number);
            $sql_command = self::prepare("UPDATE products_items SET item_status = 'SOLD' WHERE serial_number = $item_sn;");
            $sql_command->execute();
            return $item;
        }

        public function restockItem($list_items) {
            foreach ($list_items as $item) {
                $item_sn = intval($item['serial_number']);
                $sql_command = self::prepare("UPDATE products_items SET item_status = 'IN STOCK' WHERE serial_number = $item_sn");
                $sql_command->execute();
            }
        }
    }
?>