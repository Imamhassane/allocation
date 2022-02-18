<?php 
 namespace App\Core;
 interface ControllerInterface{
   function  render(string $views,array $data=[]):void;
   //Url controller/action/parametre1/parametre2
   function  redirect(string $url):void;
 }