<?
namespace app\models;
use app\base\PDOConnection;

class Admin{
    private static function connect($config = CONFIG_CONNECTION){
        return PDOConnection::make($config);
    }
}