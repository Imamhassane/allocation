<?php
namespace App\Entity;
interface EntityInterface {
     static function  fromArray(object $obj):array;
}