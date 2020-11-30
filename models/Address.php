<?php 
namespace app\models;
use app\core\Database;
use app\core\
class Address extends Database {
      public function rules(): array {
            return [
                  'user_id' => [self::RULE_REQUIRED, self::RULE_UNIQUE],
                  'address' => [self::RULE_REQUIRED],
            ];
      }

}