<?php 
namespace app\core;


abstract class AdminModel extends DbModel{
    abstract public function displayName() :string;
}
