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
            'gender' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL,[self::RULE_UNIQUE,'class'=>self::class,'attribute'=>'email']],
            'phone' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 9], [self::RULE_MAX, 'max' => 11]],
        ];
    }

    public function tableName() :string{
        return 'users';
    }

    public function attribute():array{
        return ['fullname','gender','email','phone','password','role'];
    }
    public function primaryKey() :string {
        return 'id';
    }

    public function displayName():string{
        return $this->fullname;
    }

    public function userRole(): string
    {
        return 'role';
    }
}
