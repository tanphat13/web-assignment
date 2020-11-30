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
            return ['user_id', 'address'];
      }
      public static function primaryKey(): string {
            return 'user_id';
      }
      public static function userRole(): string {
            return '';
      }
      public function addNewAddress(int $user_id, string $address){
            //$user =  User::findOne($this->tableName(),['user_id=>$this->user_id']);
            // if(!$user){
            //       $this->addErrorMessage(())
            // }
            $this->user_id = $user_id;
            $this->address = $address;
            return $this->save();
      }
}


