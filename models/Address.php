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
