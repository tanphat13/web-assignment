<?php
    namespace app\models;
    use app\core\DbModel;

    class Branch extends DbModel {

        public function rules(): array {
            return [
                'branch_id' => [self::RULE_REQUIRED, self::RULE_UNIQUE],
                'branch_address' => [self::RULE_REQUIRED],
                'branch_phone' => [self::RULE_REQUIRED],
            ];
        }

        public static function tableName(): string {
            return 'branches';
        }

        public static function attribute(): array {
            return ['branch_id', 'branch_address', 'branch_phone'];
        }

        public static function primaryKey(): string {
            return 'branch_id';
        }

        public static function userRole(): string {
            return '';
        }

        public function getAvailableBranch(int $product_id) { 
            $list_branches_id = self::findAll('products_items', ['product_id' => $product_id]);
            $branches = array();
            foreach ($list_branches_id as $branch) {
                $branch_id = intval($branch['branch_id']);
                array_push($branches, self::findOne('branches', ['branch_id' => $branch_id]));
            }
            $htmlString = '';
            foreach ($branches as $availableBranch) {
                $htmlString .= "<li>$availableBranch->branch_address - Contact: $availableBranch->branch_phone</li>";
            }
            echo $htmlString;
        }
    }
?>