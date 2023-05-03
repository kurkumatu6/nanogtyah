<?php

namespace app\base;

class PDOConnection{
    public static function make($config){
        return new \PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
            $config['login'],
            $config['password'],
            $config['options'],
        );
    }
}