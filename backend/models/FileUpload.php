<?php
namespace backend\models;

class FileUpload extends \yii\db\ActiveRecord
{
    public static function generateName(){
        $arr=['a','b','c','d','e','f','g','h','k','l','m','n','i','x','y','z'];
        
        return $arr[rand(0,count($arr)-1)].
        $arr[rand(0,count($arr)-1)].
        $arr[rand(0,count($arr)-1)].
        $arr[rand(0,count($arr)-1)].
        $arr[rand(0,count($arr)-1)].rand(0,10).
        $arr[rand(0,count($arr)-1)].rand(0,10).
        $arr[rand(0,count($arr)-1)].rand(0,10).
        $arr[rand(0,count($arr)-1)].rand(0,10).
        $arr[rand(0,count($arr)-1)].rand(0,10).
        $arr[rand(0,count($arr)-1)].rand(0,10);
    }
}