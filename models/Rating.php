<?php
    namespace app\models;
    use app\core\DbModel;

    class Rating extends DbModel {
        public int $product_id;
        public int $user_id;
        public float $rate;
        public function rules(): array {
            return [
                'rating_id' => [self::RULE_UNIQUE, self::RULE_REQUIRED],
                'product_id' => [self::RULE_REQUIRED],
                'user_id' => [self::RULE_REQUIRED],
                'rate' => [self::RULE_REQUIRED]
            ];
        }
        public static function tableName(): string {
            return 'ratings';
        }
        public static function attribute(): array {
            return ['product_id', 'user_id', 'rate'];
        }
        public static function primaryKey(): string {
            return 'rating_id';
        }
        public static function userRole(): string {
            return 'user';
        }
        public function updateRating(int $product_id, int $user_id, float $rate) {
            $this->product_id = $product_id;
            $this->user_id = $user_id;
            $this->rate = $rate;
            return $this->save();
        }
    }
?>