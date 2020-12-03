<?php 
namespace app\models;
use app\core\DbModel;
class Address extends DbModel {
      public int $user_id;
      public string $address;
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

      public function getUserAddress($user_id) {
            return $this->findAll($this->tableName(), ['user_id' => $user_id]);
      }

      public function addNewAddress($user_id, $address) {
            $this->user_id = $user_id;
            $this->address = $address;
            $this->save();
      }
}