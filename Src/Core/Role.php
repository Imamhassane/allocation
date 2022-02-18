<?php 
namespace App\Core;
class Role{
  const KEY_SESSION_USER="user_connect";
  const COLUMN_USER_ROLE="role";
   public static function isConnected(){
       return (Session::keyExist(self::KEY_SESSION_USER));
   }

}