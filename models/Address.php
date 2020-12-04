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
            return ['user_id', 'address'];
      }
      public static function primaryKey(): string {
            return 'user_id';
      }
      public static function userRole(): string {
            return '';
      }
      public function addNewAddress(int $user_id, string $address){
            $this->user_id = $user_id;
            $this->address = $address;
            return $this->save();
      }

      public function getUserAddress($user_id) {
            return $this->findAll($this->tableName(), ['user_id' => $user_id]);
      }

      public function deleteAddress($user_id, $address) {
            $sql_command = self::prepare("DELETE FROM addresses WHERE user_id = $user_id AND address = '$address';");
            $sql_command->execute();
      }
}
