<?php
    namespace app\models;
    use app\core\DbModel;
use PDO;

class Order extends DbModel {

        const ORDER_PENDING = 'PENDING';
        const ORDER_DELIVERING = 'DELIVERING';
        const ORDER_CANCEL = 'CANCEL';
        public int $order_id;
        public ?string $delivery_date = NULL;
        public string $address;
        public int $user_id;
        public string $order_status;
        public string $order_note;
        public int $order_method;
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
            return ['user_id', 'address', 'delivery_date', 'order_status', 'order_note', 'order_method'];
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
            $this->order_method = $order_info['method'];
            $this->order_status = self::ORDER_PENDING;
            $this->order_note = $order_info['note'];
            if ($this->save()) {
                $sql_command = self::prepare("SELECT MAX(order_id) as latest_order_id FROM orders WHERE user_id = $user_id AND address = '$order_info[address]'");
                $sql_command->execute();
                return $sql_command->fetchObject();
            }
            return false;
        }

        public function getAllOrder($user_id) {
            $sql_command = self::prepare("CALL get_order_in_process($user_id)");
            $sql_command->execute();
            $undone_order = $sql_command->fetchAll(PDO::FETCH_ASSOC);
            $sql_command = self::prepare("CALL get_order_done($user_id)");
            $sql_command->execute();
            $done_order = $sql_command->fetchAll(PDO::FETCH_ASSOC);
            return ['undone_order' => $undone_order, 'done_order' => $done_order];
        }

        public function getDetailedOrder($order_id) {
            return $this->findOne($this->tableName(), ['order_id' => $order_id]);
        }

        public function cancelOrder($order_id) {
            $status = self::ORDER_CANCEL;
            $sql_command = self::prepare("UPDATE orders SET order_status = '$status' WHERE order_id = $order_id");
            $sql_command->execute();
        }

        public function manageOrder($page, $limit) {
            $total_order = count(self::findAll($this->tableName(), []));
            $pageOffset = ($page - 1) * $limit;
            $total_page = ceil($total_order / $limit);
            $sql_command = self::prepare("SELECT * FROM orders ORDER BY FIELD(order_status, 'PENDING', 'DELIVERING', 'CANCEL', 'DONE') LIMIT $pageOffset, $limit");
            $sql_command->execute();
            $orders = $sql_command->fetchAll();
            $order_list = '';
            foreach ($orders as $order_item) {
                $order_list .= "
                    <div class='staff-table-row'>
                        <div class='col-sm-1 table-cell'>$order_item[order_id]</div>
                        <div class='col-md table-cell'>" .date_format(date_create($order_item['created_at']), 'd/m/Y'). "</div>
                        <div class='col-md table-cell'>" .($order_item['delivery_date'] === NULL ? 'N/A' : date_format(date_create($order_item['delivery_date']), 'd/m/Y')). "</div>
                        <div class='col-md table-cell'>$order_item[order_status]</div>
                        <div class='col-md table-cell'>" .($order_item['order_method'] === 1 ? 'SHIP' : 'AT STORE'). "</div>
                        <div class='col-sm-1 table-cell'>
                            <a id='view-detail-btn' class='open-update-btn' href='#'>View</a>
                        </div>
                    </div>
                ";
            }
            return ['order_list' => $order_list, 'total_page' => $total_page];
        }
    }
?>