<?php
namespace app\models;
use app\base\PDOConnection;

class Reviews{
    private static function connect($config = CONFIG_CONNECTION){
        return PDOConnection::make($config);
    }
    public static function addReview(){
        
    }
}