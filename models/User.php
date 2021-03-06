<?php
namespace app\models;
use app\core\UserModel;

 class User extends UserModel  {

    const STATUS_INACTIVE = 0 ;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETE = 2;
    public string $fullname='';
    public ?string $gender = '';
    public string $email ='';
    public string $phone ='';
    public string $password = '';
    public string $comfirmPassword='';
    public string $role = '';
    public int $status = self::STATUS_INACTIVE;

    public function save(){
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules():array{
        return [
            'fullname' =>[self::RULE_REQUIRED],
            'gender' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL,[self::RULE_UNIQUE,'class'=>self::class,'attreibute'=>'email']],
            'phone' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 9], [self::RULE_MAX, 'max' => 11]],
            'password' => [self::RULE_REQUIRED,[self::RULE_MIN,'min'=> 8], [self::RULE_MAX, 'max' => 24]],
            'comfirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH,'match'=>'password']]
        ];
    }

    public static function tableName() :string{
        return 'users';
    }

    public static function attribute():array{
        return ['fullname','gender','email','phone','password','status','role'];
    }
    public static function primaryKey() :string {
        return 'id';
    }

    public function displayName():string{
        return $this->fullname;
    }

    public static function userRole(): string {
        return 'role';
    }

    public function getUserInfo(int $user_id) {
        $sql_command = self::prepare("SELECT id, fullname, email, phone FROM users WHERE id = $user_id;");
        $sql_command->execute();
        return $sql_command->fetchObject();
    }

    public function updateUserInfo(int $user_id, array $info) {
        $this->fullname = $info['name'];
        $this->email = $info['email'];
        $this->phone = $info['phone'];
        $sql_command = self::prepare("UPDATE users SET fullname = '$this->fullname', email = '$this->email', phone = '$this->phone' WHERE id = $user_id;");
        return $sql_command->execute();
    }

    public function checkExistUser($phone) {
        $sql_command = self::prepare("SELECT id FROM users WHERE phone = '$phone';");
        $sql_command->execute();
        return $sql_command->fetchObject();
    }
}

?>