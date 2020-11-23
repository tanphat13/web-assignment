<?php
namespace app\models;

use app\core\AdminModel;

 class Admin extends AdminModel  {

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
        return ['fullname','email','phone',];
    }
    public function primaryKey() :string {
        return 'id';
    }

    public function displayName():string{
        return $this->fullname;
    }
    public function userRole():string{
        return 'admin';
    }

    public function getStaffList ( $page, $limit){
        $totalStaff = count(self::findAll($this->tableName(), ['role' => "staff"]));
        $pageOffset = ($page - 1) * $limit;
        $totalPage = ceil($totalStaff / $limit);
        $sql_command = self::prepare("SELECT * FROM users WHERE role = 'staff' LIMIT $pageOffset, $limit  ");
        $sql_command->execute();
        $staffList='';
        $arrayStaff = $sql_command->fetchAll();
        // echo "<pre>";
        // echo var_dump($arrayStaff);
        // echo "</pre>";
        foreach($arrayStaff as $staff){
            $staffList .=
             '<div class="staff-table-row">'.
             '<div class="col-sm-1 table-cell">' . $staff['id'] . '</div>'.
            '<div class="col-md table-cell">' . $staff['fullname'] . '</div>'.
            '<div class="col-md table-cell">' . $staff['phone'] . '</div>'.
            '<div class="col-md table-cell">' . $staff['email'] . '</div>'.
            '<div class="col-sm-1 table-cell">' . $staff['gender'] . '</div>'.
            '<div class="col-sm-1 table-cell">' .
                '<button onClick="getStaffId('.$staff["id"].')"> Upadte</button></div> 
             </div>';
        }
        
        return ['staffList'=>$staffList,'totalPage'=>$totalPage];
    }
    public function getStaff($staffId){
        $staff =  self::findOne($this->tableName(),['id'=>$staffId]);
        return $staff;
    }
 
}
