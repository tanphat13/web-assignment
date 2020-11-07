<?php
namespace app\core;
class Session{
    public const FLASH_KEY = 'flash_messages';
    public function __construct(){
        $status = session_status();
        if ($status == PHP_SESSION_NONE) {
            session_start();
        } else
        if ($status == PHP_SESSION_DISABLED) {
            //Sessions are not available
        } else
        if ($status == PHP_SESSION_ACTIVE) {
            //Destroy current and start new one
            session_destroy();
            session_start();
        }
        $flashMessages = $_SESSION[self::FLASH_KEY]?? [];
        foreach($flashMessages as $key => &$flashMessage){
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY]= $flashMessages;
    }

    public function set ($key,$value){
        $_SESSION[$key] = $value;
    }
    public function get ($key){
        return $_SESSION[$key] ?? false;
    } 
    public function setFlash($key,$message){
        $_SESSION[self::FLASH_KEY][$key]=[
            'remove' =>false,
            'value' =>$message

        ];
    }
    public function getFlash($key){
        return $_SESSION[self::FLASH_KEY][$key]['value']??false;
    }

    public function remove($key){
        unset($_SESSION[$key]);
    }
    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if($flashMessage['remove'] ){
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}
?>