<?php
namespace app\core;
abstract class Model{
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_MATCH = "match";
    public const RULE_UNIQUE = 'unique';
    public array $errors = [];
    public function loadData($data){

        foreach($data as $key => $value){
            if(property_exists($this,$key)){
                $this->{$key} = $value;
            }
        }
        return $data;
    }
    abstract public function rules(): array;
    public function validate(){
        foreach($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};
            foreach ($rules as $rule){
                $ruleName = $rule;
                if(!is_string($ruleName)){
                    $ruleName = $rule[0];
                }
                if($ruleName === self::RULE_REQUIRED && !$value){
                    
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN,$rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) >= $rule['max']) {
                   
                    $this->addError($attribute, self::RULE_MAX,$rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
                if($ruleName === self::RULE_UNIQUE){
                    $className =$rule['class'] ?? $this;
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName =  $className::tableName();
                    $sql_command = Application::$app->db->prepare("
                        SELECT * FROM $tableName WHERE $uniqueAttr = :attr
                    ");
                    $sql_command->bindValue(":attr",$value);
                    $sql_command->execute();
                    $record = $sql_command->fetchObject();
                    if($record){
                        $this->addError($attribute,self::RULE_UNIQUE,['field' =>$attribute]);
                    }
                }
        }
        }
       
        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule ,$param=[])
    {
        $message = $this->errorMessage()[$rule] ?? '';
        foreach($param as $key=>$value){
            $message = str_replace("{{$key}}",$value,$message);
        }
        $this->errors[$attribute][] = $message;
    }
    public function addErrorMessage(string $attribute,$message){
      
        $this->errors[$attribute][] = $message;
    }
    public function errorMessage()
    {
        return [
            self::RULE_REQUIRED => "This filed is required",
            self::RULE_EMAIL => "Wrong email formatted",
            self::RULE_MIN => 'Input length must be {min}',
            self::RULE_MAX => "Input length must less than {max}",
            self::RULE_MATCH => "This filed must be the same as {match}",
            self::RULE_UNIQUE => "Record with this {field} already exist  "
        ];
    }
    public function hasError($attribute){
        return $this->errors[$attribute] ?? false;
    }
    
    public function getFirstError($attribute){
        return $this->errors[$attribute][0] ?? false;
    }
}


?>