<?php
    namespace app\models;
    use app\core\DbModel;

    class Image extends DbModel {

        public function rules(): array {
            return [
                'image_id' => [self::RULE_REQUIRED, self::RULE_UNIQUE],
                'link' => [self::RULE_REQUIRED]
            ];
        }

        public static function tableName(): string {
            return 'images';
        }

        public static function attribute(): array {
            return ['image_id', 'product_id', 'link'];
        }

        public static function primaryKey(): string {
            return 'image_id';
        }

        public static function userRole(): string {
            return '';
        }

        public function getImageEvent() {
            $sql_command = self::prepare("SELECT * FROM images WHERE product_id IS NULL ORDER BY created_at LIMIT 4;");
            $sql_command->execute();
            return $sql_command->fetchAll();
        }
    }
?>