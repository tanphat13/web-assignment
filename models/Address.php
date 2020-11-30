<<<<<<< HEAD
<?php 
namespace app\models;
use app\core\DbModel;
class Address extends DbModel {
      public function rules(): array {
            return [
                  'user_id' => [self::RULE_REQUIRED],
                  'address' => [self::RULE_REQUIRED],
            ];
      }
      public static function tableName(): string {
            return 'addresses';
      }
      public static function attribute(): array {
            return [];
      }
      public static function primaryKey(): string {
            return '';
      }
      public static function userRole(): string {
            return '';
      }
}
=======
<?php
    namespace app\models;
    use app\core\DbModel;

    class Address extends DbModel {

        public int $user_id;
        public string $address;
        public function rules(): array {
            return [
                'user_id' => [self::RULE_UNIQUE, self::RULE_REQUIRED],
                'address' => [self::RULE_REQUIRED],
            ];
        }
        public static function tableName(): string {
            return 'addresses';
        }
        public static function attribute(): array {
            return ['user_id', 'address'];
        }
        public static function primaryKey(): string {
            return '';
        }
        public static function userRole(): string {
            return '';
        }

    }
?>
>>>>>>> e0cb30eaf20db030ed6f7cc37219856bee013498
