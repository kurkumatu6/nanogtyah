<?php
namespace app\models;
use app\base\PDOConnection;

class Shedule{
    private static function connect($config=CONFIG_CONNECTION){
        return PDOConnection::make($config);
    }
    public static function getVoidShudleMasters($date){
        $new_date = date('Y-m-d', strtotime($date));
        $query = self::connect()->prepare("SELECT * FROM `masters` WHERE masters.id NOT IN (SELECT master_id FROM shedule WHERE shedule.date = :date)");
        $query->execute(["date"=> $new_date ]);
        return $query->fetchAll();
    }

    public static function setShedules($date, $data){
        $new_date = date('Y-m-d', strtotime($date));
        foreach( $data as $master){
            
            $shedule = self::getMasterShudleForSelect($new_date, $master->master_id);
            // var_dump($shedule);
            if(!$shedule){
                $query = self::connect()->prepare("INSERT INTO `shedule`(`id`, `date`, `startWork`, `endWork`, `master_id`) VALUES (NULL, :date, :startWork, :endWork, :master_id)");
                $query->execute(['date'=>$new_date,'startWork'=>$master->startTime,'endWork'=>$master->endTime,'master_id'=>$master->master_id]);
            }
            else{
                var_dump(['date'=>$new_date,'startWork'=>$master->startTime,'endWork'=>$master->endTime,'master_id'=>$master->master_id]);
                $query = self::connect()->prepare("UPDATE `shedule` SET `startWork`=:startWork,`endWork`=:endWork WHERE `master_id` = :master_id AND `date` = :date");
                $query->execute(['date'=>$new_date,'startWork'=>$master->startTime,'endWork'=>$master->endTime,'master_id'=>$master->master_id]);
            }
        }
    }
    public static function getParam($array, $value){
        return implode(",", array_fill(0,count($array), $value)); //создание строки из массива
    }

    public static function getMasterShudle($date, $masterId){
        $query = self::connect()->prepare("SELECT * FROM `shedule` INNER JOIN masters ON masters.id =shedule.master_id WHERE shedule.date  = ? AND shedule.master_id =?");
        // var_dump($date);
        $query->execute([$date, $masterId]);
        return $query->fetch();
    }
    public static function getMasterShudleForSelect($date, $masterId){
        $new_date = date('Y-m-d', strtotime($date));
        $query = self::connect()->prepare("SELECT * FROM `shedule` INNER JOIN masters ON masters.id = shedule.master_id WHERE shedule.date  = :date AND shedule.master_id =:master_id");
        // var_dump(["date"=>$new_date, "master_id"=>$masterId]);
        $query->execute(["date"=>$new_date, "master_id"=>$masterId]);
        return $query->fetch();
    }
}
