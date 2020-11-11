<?php
namespace app\core;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model{
    abstract public function tableName():string;
    abstract public function attribute():array;
    abstract public function primaryKey():string;
    abstract public function userRole():string;
        public function save(){
            $tableName = $this->tableName();
            $attributes = $this->attribute();
            $params = array_map(fn($attr)=>":$attr",$attributes);
            $sql_command = self::prepare("
                INSERT INTO $tableName (".implode(',',$attributes).")
                VALUES(".implode(',',$params).");
            ");
            foreach($attributes as $attribute){
                $sql_command->bindValue(":$attribute",$this->{$attribute});
            }
             $sql_command->execute();
            // echo "<pre>";
            // echo var_dump($params , $attribute);
            // echo "</pre>";
            // exit;
             return true;
        }
    public static function prepare ($sql_command){
        return  Application::$app->db->pdo->prepare($sql_command);
    } 

    public function findOne($tableName, $where){
        $attributes =  array_keys(
           $where 
        );
        $sql_params = implode("AND ", array_map(fn($attr)=> "$attr = :$attr",$attributes));

        $sql_command = self::prepare("SELECT * FROM $tableName WHERE $sql_params");
        foreach($where as $key => $item){
            $sql_command->bindValue(":$key",$item);
           // echo var_dump( $item);
        }
        
        $sql_command->execute();

        return $sql_command->fetchObject(static::class);
    }
    public function findAll($tableName, $where){
        $attributes =  array_keys(
           $where 
        );
     
        $sql_params = implode(" AND ", array_map(fn($attr)=> "$attr = :$attr",$attributes));

        $sql_command = self::prepare("SELECT * FROM $tableName WHERE $sql_params");
        foreach($where as $key => $item){
            $sql_command->bindValue(":$key",$item);
        }
        
        $sql_command->execute();

        return $sql_command->fetchAll();
    }

}




?>