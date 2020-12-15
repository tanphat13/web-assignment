<?php
namespace app\models;

use app\core\AdminModel;
use PDO;

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

    public static function tableName() :string {
        return 'users';
    }

    public static function attribute():array{
        return ['fullname','email','phone',];
    }
    public static function primaryKey() :string {
        return 'id';
    }
    public function displayName(): string
    {
        return $this->fullname;
    }
    public static function userRole():string{
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
        foreach($arrayStaff as $staff){
            $staffList .=
             '<div class="staff-table-row">'.
             '<div class="col-sm-1 table-cell">' . $staff['id'] . '</div>'.
            '<div class="col-md table-cell">' . $staff['fullname'] . '</div>'.
            '<div class="col-md table-cell">' . $staff['phone'] . '</div>'.
            '<div class="col-md table-cell">' . $staff['email'] . '</div>'.
            '<div class="col-sm-1 table-cell">' . $staff['gender'] . '</div>'.
            '<div class="col-md table-cell actions-btn-group">' .
                '<button id="update-staff-btn" class="open-update-btn" onClick="getStaffId('.$staff["id"]. ')"> Upadte</button>
                <div class="action-delete-btn" onclick="openConfirmDelete(\'users\', ' . $staff['id'] . ')" id="update-product-btn" class="open-update-btn update-product-btn-link">
                 <p>DELETE</p>
                 </div>
            </div>
             </div>';
        }
        
        return ['staffList'=>$staffList,'totalPage'=>$totalPage];
    }
    public function getStaff($staffId){
        $staff =  self::findOne($this->tableName(),['id'=>$staffId]);
        return $staff;
    }
    public function getProductList($page,$limit){
        $totalStaff = count(self::findAll($this->tableName(), ['role' => "staff"]));
        $pageOffset = ($page - 1) * $limit;
        $totalPage = ceil($totalStaff / $limit);
        $sql_command = self::prepare("SELECT * FROM products LIMIT $pageOffset, $limit");
        $sql_command->execute();
        $listProduct = '';
        $arrProduct = $sql_command->fetchAll();
        foreach($arrProduct as $productItem){
            $listProduct .=
            '<div class="staff-table-row">' .
            '<div class="col-sm-1 table-cell">' . $productItem['product_id'] . '</div>' .
            '<div class="col-md table-cell">' . $productItem['product_brand'] . '</div>' .
            '<div class="col-md table-cell">' . $productItem['product_name'] . '</div>' .
            '<div class="col-md table-cell actions-btn-group">' .
            '
                 <div id="update-product-btn" class="open-update-btn update-product-btn-link">
                <a href="/admin/manage-products/update-product?product_id=' . $productItem["product_id"] . '" > Upadte </a>
                </div>
            <div class="action-delete-btn" onclick="openConfirmDelete(\'product\', '. $productItem["product_id"] . ')" id="update-product-btn" class="open-update-btn update-product-btn-link">
                 <p>DELETE</p>
            </div>
            </div> 
            </div>';
        }
        return ['productList' => $listProduct, 'totalPage' => $totalPage];
    }
    public function getSpecificProduct($productId){
        $product = self::findOne("products",["product_id" => $productId]);
        return $product;
    }
}   
