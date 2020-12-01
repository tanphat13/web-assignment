<?php
    namespace app\models;
    use app\core\DbModel;

    class Order extends DbModel {

        const ORDER_PENDING = 1;
        const ORDER_DELIVERED = 2;
        const ORDER_CANCEL = 3;
        public int $order_id;
        public ?string $delivery_date = NULL;
        public string $address;
        public int $user_id;
        public string $method;
        public int $order_status;
        public string $order_note;
        public function rules(): array {
            return [
                'user_id' => [self::RULE_REQUIRED],
                'address' => [self::RULE_REQUIRED],
                'order_status' => [self::RULE_REQUIRED],
            ];
        }
        public static function tableName(): string {
            return 'orders';
        }
        public static function attribute(): array {
            return ['user_id', 'address', 'delivery_date', 'order_status', 'order_note'];
        }
        public static function primaryKey(): string {
            return 'order_id';
        }
        public static function userRole(): string {
            return '';
        }

        public function createNewOrder($order_info, $user_id) {
            $this->user_id = $user_id;
            $this->address = $order_info['address'];
            $this->method = $order_info['method'];
            $this->order_status = self::ORDER_PENDING;
            $this->order_note = $order_info['note'];
            if ($this->save()) {
                $sql_command = self::prepare("SELECT MAX(order_id) as latest_order_id FROM orders WHERE user_id = $user_id AND address = '$order_info[address]'");
                $sql_command->execute();
                return $sql_command->fetchObject();
            }
            return false;
        }

        public function getDetailedOrder($order_id) {
            return $this->findOne($this->tableName(), ['order_id' => $order_id]);
        }

        public function cancelOrder($order_id) {
            $sql_command = self::prepare("UPDATE orders SET order_status = 2 WHERE order_id = $order_id");
            $sql_command->execute();
        }
    }
?>