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
            $sql_command = $this->prepare("SELECT product_id, product_name, product_price FROM products WHERE product_brand='$brand' ORDER BY product_price DESC");
            $sql_command->execute();
            $productList = $sql_command->fetchAll();
            //echo var_dump($productList);
            $products = array();
            foreach ($productList as $key) {
                array_push($products, $key);
            }
            
            return $products;

        
        }
        public function rules() : array{
            return [];
        }
        public function attribute(): array
        {
            return [];
        }
        public function primaryKey(): string{
            return '';
        }
        public function userRole(): string{
            return '';
        }
        public function tableName(): string
        {
            return 'products';
        }
        
        
    }

?>