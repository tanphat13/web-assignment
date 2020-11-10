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

    public function tableName() :string{
        return 'users';
    }

    public function attribute():array{
        return ['fullname','gender','email','phone','password','status','role'];
    }
    public function primaryKey() :string {
        return 'id';
    }

    public function displayName():string{
        return $this->fullname;
    }

    public function userRole(): string {
        return 'role';
    }
}

?>