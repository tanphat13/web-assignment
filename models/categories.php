<?php
namespace app\models;
use app\core\DbModel;
use Dotenv\Parser\Value;

class Categories extends DbModel {
        
    public function getCategoryList() {
        $sql_command = $this->prepare("SELECT DISTINCT product_brand FROM products ORDER BY product_brand ASC");
        $sql_command->execute();
        $categoryList = $sql_command->fetchAll();
        // echo var_dump($categoryList) ;
        $brand = array();
        foreach($categoryList as $category) {
                // echo $category['product_brand'];    
                array_push($brand, $category['product_brand']);
        }
        return $brand;
    }

    public function getBrandProduct($brand) {
        $sql_command = $this->prepare("SELECT DISTINCT products.product_id, products.product_name, products.product_price, products.product_brand, MIN(images.image_id), images.link 
            FROM products LEFT JOIN images ON products.product_id = images.product_id WHERE products.product_brand = '$brand' 
            GROUP BY  products.product_name ORDER BY products.product_price DESC");
        $sql_command->execute();
        $productList = $sql_command->fetchAll();
        $products = array();
        foreach ($productList as $key) {
            array_push($products, $key);
        }
        // echo var_dump($products);
        return $products;
    }
    public function getProductByRange($low_bound, $high_bound) {
        $sql_command = $this->prepare("SELECT products.product_id, products.product_name, products.product_price, products.product_brand, MIN(images.image_id), images.link 
            FROM products LEFT JOIN images ON products.product_id = images.product_id WHERE (products.product_price > '$low_bound' AND products.product_price < '$high_bound') 
            GROUP BY products.product_id ORDER BY products.product_price DESC");
        $sql_command->execute();
        $productList = $sql_command->fetchAll();
        $products = array();
        foreach ($productList as $key) {
            array_push($products, $key);
        }
        return $products;
    }

    public function getBrandList() {
        $sql_command = $this->prepare("SELECT DISTINCT product_brand FROM products ORDER BY product_brand ASC");
        $sql_command->execute();
        $brandList = $sql_command->fetchAll();
        $product_home = array();
        foreach($brandList as $brand) {
            $sql_command = $this->prepare("SELECT DISTINCT products.product_id, products.product_name, products.product_price, products.product_brand, MIN(images.image_id), images.link 
                FROM products LEFT JOIN images ON products.product_id = images.product_id WHERE products.product_brand = '$brand[product_brand]' 
                GROUP BY  products.product_name ORDER BY products.product_price DESC LIMIT 5");
            $sql_command->execute();
            $product_limit_5 = $sql_command->fetchAll();
            foreach ($product_limit_5 as $product) {
                array_push($product_home, $product);
            }
        }
        //echo var_dump($product_home);
        return $product_home;
        
    }
    public function rules() : array{
        return [];
    }
    public static function attribute(): array
    {
        return [];
    }
    public static function primaryKey(): string{
        return '';
    }
    public static function userRole(): string{
        return '';
    }
    public static function tableName(): string
    {
        return 'products';
    }
    
    
}

?>