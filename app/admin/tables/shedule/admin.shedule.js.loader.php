<?php
use app\models\Master;
use app\models\Recording;
use app\models\Shedule;



session_start();


require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
use app\models\Order;
$stream = file_get_contents("php://input");
if($stream != null){
        //декодируем полученые данные
        // var_dump($stream);
            $data = json_decode($stream)->data;
            // $user_id = $_SESSION["user"]["id"];
            $action = json_decode($stream)->action;
            // var_dump($data);

                $shedule = match($action){
                    "getMastersByDate"=>Shedule::getVoidShudleMasters($data),
                    "setMastersShedule"=>Shedule::setShedules($data->date,$data->mastersShedule),
                    "getMasters"=>Master::allMaster(),
                    "getMastersShudle"=>Shedule::getMasterShudle($data->date, $data->master_id),
                    "getMastersRecording"=>Recording::getRecordinmForMasterByDate($data->date, $data->master_id),
                    "getMastersShudleForStaar"=>Shedule::getMasterShudleForSelect($data->date, $data->master_id)
                };

            echo json_encode([
                "shedule"=>$shedule,
            ], JSON_UNESCAPED_UNICODE);


}