<?php
    namespace app\models;
    use app\core\DbModel;
    use app\models\ProductItem;

    class OrderProduct extends DbModel {

        public int $order_id;
        public int $product_id;
        public int $serial_number;
        public function rules(): array {
            return [
                'order_id' => [self::RULE_REQUIRED],
                'product_id' => [self::RULE_REQUIRED],
                'serial_number' => [self::RULE_REQUIRED],
            ];
        }
        public static function tableName(): string {
            return 'orders_products';
        }
        public static function attribute(): array {
            return ['order_id', 'product_id', 'serial_number'];
        }
        public static function primaryKey(): string {
            return '';
        }
        public static function userRole(): string {
            return '';
        }

        public function createProductInOrder($order_id, $list_product) {
            $product_item = new ProductItem();
            foreach ($list_product as $product) {
                $this->order_id = $order_id;
                $this->product_id = $product;
                $item = $product_item->getItem($product);
                $this->serial_number = intval($item->serial_number);
                $this->save();
            }
        }

        public function getOrderProduct($order_id) {
            $sql_command = self::prepare("SELECT product_id FROM orders_products WHERE order_id = $order_id");
            $sql_command->execute();
            return $sql_command->fetchAll();
        }

        public function removeProduct($order_id) {
            $sql_command = self::prepare("SELECT serial_number FROM orders_products WHERE order_id = $order_id");
            $sql_command->execute();
            $listItems = $sql_command->fetchAll();
            foreach ($listItems as $item) {
                $sql_command = self::prepare("UPDATE orders_products SET serial_number = NULL WHERE serial_number = $item[serial_number]");
                $sql_command->execute();
            }
            return $listItems;
        }
    }
?>