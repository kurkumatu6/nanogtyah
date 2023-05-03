<?php
namespace app\models;
use app\models\Master;
use app\models\Services;
use app\base\PDOConnection;
use DateTime;

class Recording{
    private static function connect($config=CONFIG_CONNECTION){
        return PDOConnection::make($config);
    }

    public static function signUp($date, $finalCost, $masterId, $serviceId, $statusId)
    {
        $currentDate = new DateTime($date);
        $user = User::findId($_SESSION["id"]);


        $query= self::connect()->prepare("INSERT INTO recording (startRecording, finalCost, master_id, user_id, service_id, statues_id) VALUES(:startRecording, :finalCost, :masterId, :userId, :serviceId, :statusId)");
        $query->execute([
            ":startRecording" => $currentDate->format('Y-m-d H:i:s'),
            ":finalCost" => $finalCost,
            ":masterId"=> $masterId,
            ":userId"=> $user->id,
            ":serviceId" => $serviceId,
            ":statusId"=> $statusId,
        ]);

        
        echo json_encode($statusId, JSON_UNESCAPED_UNICODE);
    } 
    public static function cancelRecording($recordingId, $reasonCancel)
    {
        $query= self::connect()->prepare("UPDATE recording SET statues_id = 4, reason_cancel = :reasonCancel WHERE id = :recordingId");
        $query->execute([
            ":recordingId" => $recordingId,
            ":reasonCancel" => $reasonCancel
        ]);

        echo json_encode($recordingId, JSON_UNESCAPED_UNICODE);
    } 

    public static function makeRecording($recordingId)
    {
        $query= self::connect()->prepare("UPDATE recording SET statues_id = 3 WHERE id = :recordingId");
        $query->execute([
            ":recordingId" => $recordingId,
        ]);

        echo json_encode($recordingId, JSON_UNESCAPED_UNICODE);
    } 
    public static function getRecordinmForMasterByDate( $date,$masterId){
        // var_dump(["master_id"=>$masterId,"date"=>$date]);
        $new_date = date('Y-m-d', strtotime($date));
        $query = self::connect()->prepare("SELECT * FROM `recording` WHERE `master_id` = :master_id AND DATE(`startRecording`) = :date AND `statues_id` = 1 ORDER BY startRecording DESC");
        $query->execute(["master_id"=>$masterId,"date"=>$new_date]);
        return $query->fetchAll();
    }

    public static function getAllRecordings($statusId, $masterId)
    {
        if($masterId != 'all') {
            $query = self::connect()->prepare("SELECT recording.id, recording.startRecording, recording.finalCost, statues.id AS status_id, statues.name AS status_name, masters.surname AS master_surname, masters.name AS master_name, services.name AS service_name FROM recording INNER JOIN statues ON recording.statues_id = statues.id INNER JOIN masters ON recording.master_id = masters.id INNER JOIN services ON recording.service_id = services.id WHERE statues_id = :statusId AND master_id = :masterId ORDER BY startRecording DESC");
            $query->execute([
                ":statusId" => $statusId,
                ":masterId" => $masterId,
            ]);
    
        }
        else {
            $query = self::connect()->prepare("SELECT recording.id, recording.startRecording, recording.finalCost, statues.id AS status_id, statues.name AS status_name, masters.surname AS master_surname, masters.name AS master_name, services.name AS service_name FROM recording INNER JOIN statues ON recording.statues_id = statues.id INNER JOIN masters ON recording.master_id = masters.id INNER JOIN services ON recording.service_id = services.id WHERE statues_id = :statusId ORDER BY startRecording DESC");
            $query->execute([
                ":statusId" => $statusId,
            ]);
        }
        $result =  $query->fetchAll();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public static function getAllRecordingsByUser($userId, $statusId)
    {
        $query = self::connect()->prepare("SELECT recording.startRecording, recording.finalCost, statues.id AS status_id, statues.name AS status_name, masters.surname AS master_surname, masters.name AS master_name, services.name AS service_name FROM recording INNER JOIN statues ON recording.statues_id = statues.id INNER JOIN masters ON recording.master_id = masters.id INNER JOIN services ON recording.service_id = services.id WHERE user_id = :userId AND statues_id = :statusId ORDER BY startRecording DESC");
        $query->execute([
            ":userId" => $userId,
            ":statusId" => $statusId,
        ]);

        $result =  $query->fetchAll();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }


}