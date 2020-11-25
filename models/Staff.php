<?php
namespace app\models;
use app\core\UserModel;

 class Staff extends UserModel  {
    public ?int $id= NUll;
    public string $fullname='';
    public string $role = 'staff';
    public ?string $gender = '';
    public string $email ='';
    public string $phone ='';
    public string $password = '123123123';
    public string $comfirmPassword='123123123';
    public function save(){
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        // echo "<pre>";
        // echo "this is staff model \n";
        // echo var_dump($this);
        // echo "</pre>";
        // exit;
        return parent::save();
    }

    public function rules():array{
        return [
            'fullname' =>[self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'phone' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 9], [self::RULE_MAX, 'max' => 11]],
        ];
    }

    public static function tableName() :string{
        return 'users';
    }

    public static function attribute():array{
        return ['fullname','email','phone'];
    }
    public static function primaryKey() :string {
        return 'id';
    }

    public  function displayName():string{
        return $this->fullname;
    }

    public static function userRole(): string
    {
        return 'role';
    }
    public function updateStaffInfo()
    {
        // echo "<pre>";
        // echo "res from staff model";
        // echo var_dump($this);
        // echo "</pre>";
        // return var_dump($this);
        // exit;
        $tableName = $this->tableName();
        $attributes = $this->attribute();
        $params = array_map(fn ($attr) => "$attr = :$attr", $attributes);
        $sql_command = self::prepare("
            UPDATE $tableName
            SET ". implode(',',$params)."
            WHERE id = ". $this->id."; 
        ");
        foreach ($attributes as $attribute) {
            $sql_command->bindValue(":$attribute", $this->{$attribute});
        }
        return $sql_command->execute();
    }
}