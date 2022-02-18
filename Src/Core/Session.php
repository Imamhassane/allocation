<?php 
  namespace App\Core;
  class Session{
   public static function start():void{ 
    if(session_status()==PHP_SESSION_NONE){
        session_start();
     }
  }
   public  static function  keyExist(string $key):bool {
        return isset($_SESSION[$key]);
   }
   public  static function  getSession(string $key) {
       return Session::keyExist($key)?$_SESSION[$key]:false;
}
   public static function setSession(string $key,$data):void{
         $_SESSION[$key]=$data;
   } 
   public static function  removeKey(string $key): void{
        unset($_SESSION[$key]);
   }
   public static function  destroySession():void{
      $_SESSION=array();
      session_destroy();
   }
    
  }