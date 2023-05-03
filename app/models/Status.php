<?php
namespace app\models;
use app\base\PDOConnection;

class Status{
    private static function connect($config=CONFIG_CONNECTION){
        return PDOConnection::make($config);
    }

    public static function getAllStatuses()
    {
        $query = self::connect()->query("SELECT * FROM statues");
        
        return $query->fetchAll();
    }
}