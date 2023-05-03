<?php
namespace app\models;
use app\base\PDOConnection;
use DateTime;

class Master{
    private static function connect($config=CONFIG_CONNECTION){
        return PDOConnection::make($config);
    }
    public static function allPosition(){
        $query = self::connect()->query(("SELECT * FROM position"));
        return $query->fetchAll();
    }
    public static function allMaster(){
        $query = self::connect()->query("SELECT masters.*, position.name as position FROM masters INNER JOIN position ON position.id = masters.position_id");
        return $query->fetchAll();
    }
    public static function findMaster($name, $surname){
        $query = self::connect()->prepare("SELECT id FROM masters WHERE name = :name AND surname=:surname");
        $query->execute([
            ":name"=>$name,
            ":surname"=>$surname
        ]);
        return $query->fetch();
    }
    public static function addMaster($data, $img){
        $master = self::findMaster($data["name"], $data["surname"]);
        if(!$master){
            $query= self::connect()->prepare("INSERT IGNORE INTO masters (surname, name, photo, info, email, phone, position_id) VALUES(:surname, :name, :photo,:info, :email, :phone, :position_id)");
            $query->execute([
                ":surname"=>$data["surname"],
                ":name"=>$data["name"],
                ":photo"=>$img,
                ":info"=>$data["info"],
                ":email"=>$data["email"],
                ":phone"=>$data["phone"],
                ":position_id"=>$data["position_id"]
            ]);
        };
        return"add";
    }
    public static function findPosition($name){
        $query=self::connect()->prepare("SELECT * FROM position WHERE name = ?");
        $query->execute([$name]);
        return $query->fetch();
    }
    public static function addPosition($data){
        $query=self::connect()->prepare("INSERT IGNORE INTO position (name, markup) VALUES (:name, :markup)");
        $query->execute([
            ":name"=>$data["name"],
            ":markup"=>$data["markup"],
        ]);
    }
    public static function deletePosition($id){
        $query=self::connect()->prepare("DELETE FROM position WHERE id=?");
        $query->execute([$id]);
        return "delete";
    }
    public static function updatePosition($id, $data){
        $query=self::connect()->prepare("UPDATE position SET name =:name,markup=:markup WHERE id =:id" );
        $query->execute([
            ":id"=>$id,
            ":name"=>$data["name"],
            ":markup"=>$data["markup"],
        ]);
    }
    public static function findPositionById($id){
        $query=self::connect()->prepare("SELECT * FROM position WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function findMasterByPosition($id){
        $query=self::connect()->prepare("SELECT masters.*, position.name as position FROM masters INNER JOIN position ON position.id = masters.position_id WHERE position.id = ?");
        $query->execute([$id]);
        return $query->fetchAll();
    }
    public static function addMasterService($master_id, $typeOfService_id){
        $query =self::connect()->prepare("INSERT IGNORE INTO masterService (typeOfService_id, master_id) VALUES (:typeOfService_id, :master_id)");
        $query->execute([
            ":typeOfService_id"=>$typeOfService_id,
            ":master_id"=>$master_id
        ]);
    }
    public static function findMasterById($id){
        $query=self::connect()->prepare("SELECT masters.*, position.name as position FROM masters INNER JOIN position ON position.id = masters.position_id WHERE masters.id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function showServiceMasterById($id){
        $query=self::connect()->prepare("SELECT typeOfService.id as typeId FROM masterService INNER JOIN masters ON masters.id = masterService.master_id INNER JOIN typeOfService ON typeOfService.id = masterService.typeOfService_id WHERE master_id = ?");
        $query->execute([$id]);
        return $query->fetchAll();
    }
    public static function showMasterByTypeOfService($id){
        $query=self::connect()->prepare("SELECT masters.* FROM masterService INNER JOIN masters ON masters.id = masterService.master_id INNER JOIN typeOfService ON typeOfService.id = masterService.typeOfService_id WHERE typeOfService_id = ?");
        $query->execute([$id]);
        return $query->fetchAll();
    }
    public static function showDateByMaster($id){
        $query=self::connect()->prepare("SELECT shedule.* FROM shedule INNER JOIN masters ON masters.id = shedule.master_id WHERE master_id = ?");
        $query->execute([$id]);
        return $query->fetchAll();
    }
    public static function showTimeById($id){
        $query=self::connect()->prepare("SELECT shedule.* FROM shedule INNER JOIN masters ON masters.id = shedule.master_id WHERE shedule.id =?");
        $query->execute([$id]);
        return $query->fetchAll();
    }
    public static function updateMaster($data, $img){
        $query=self::connect()->prepare("UPDATE masters SET surname = :surname, name= :name, photo=:photo, info=:info, email=:email, phone=:phone, position_id = :position_id WHERE id=:id");
        $query->execute([
            ":id"=>$data["id"],
            ":surname"=>$data["surname"],
                ":name"=>$data["name"],
                ":photo"=>$img,
                ":info"=>$data["info"],
                ":email"=>$data["email"],
                ":phone"=>$data["phone"],
                ":position_id"=>$data["position_id"]
        ]);
    }
    public static function deleteMasterService($idMaster){
        $query=self::connect()->prepare("DELETE FROM masterService WHERE master_id = ?");
        $query->execute([$idMaster]);
    }
    public static function allCertificatesByMaster($idMaster){
        $query=self::connect()->prepare("SELECT certificates.*, masters.id as masterId FROM certificates INNER JOIN masters ON masters.id = certificates.master_id WHERE master_id = ?");
        $query->execute([$idMaster]);
        return $query->fetchAll();
    }
    

    public static function getMastersByTypeService($typeServiceId)
    {
        $query = self::connect()->prepare("SELECT masters.*, position.name AS position_name, position.markup AS markup FROM masterservice INNER JOIN masters ON masterservice.master_id = masters.id INNER JOIN position ON masters.position_id = position.id WHERE typeOfService_id = ?");
        $query->execute([$typeServiceId]);

        $result =  $query->fetchAll();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public static function getMasterShedule($masterId)
    {
        $dateNow = date('Y-m-d H:i:s');
        $query = self::connect()->prepare("SELECT * FROM shedule WHERE master_id = ? AND date >= DATE(?)");
        $query->execute([$masterId, $dateNow]);

        $result =  $query->fetchAll();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public static function getTimeByMaster($masterId, $date)
    {
        $query = self::connect()->prepare("SELECT * FROM shedule WHERE master_id = ? AND `date` = DATE(?)");
        $query->execute([$masterId, $date]);

        $result = $query->fetch();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public static function getBusyTimeByMaster($masterId, $date)
    {
        $query = self::connect()->prepare("SELECT startRecording, duration FROM recording INNER JOIN services ON recording.service_id = services.id WHERE master_id = ? AND DATE(startRecording) = DATE(?)");
        $query->execute([$masterId, $date]);

        $result = $query->fetchAll();

        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public static function findCertificate($name){
        $query=self::connect()->prepare("SELECT * FROM certificates WHERE name = ?");
        $query->execute([$name]);
        return $query->fetch();
    }
    public static function addCertificates($name, $img, $master_id){
        $certificate = self::findCertificate($name);
        if(!$certificate){
            $query=self::connect()->prepare("INSERT IGNORE INTO certificates (name, image, master_id) VALUES (:name, :image, :master_id)");
            $query->execute([
                ":name"=>$name,
                ":image"=>$img,
                ":master_id"=>$master_id
            ]);
        }
    }
    public static function deleteCertificate($id){
        $query=self::connect()->prepare("DELETE FROM certificates WHERE certificates.id =?");
        $query->execute([$id]);
    }
    public static function findCertificateById($id){
        $query=self::connect()->prepare("SELECT * FROM certificates INNER JOIN masters ON masters.id=certificates.master_id WHERE certificates.id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function allWorksMaster($id){
        $query=self::connect()->prepare("SELECT mastersWorks.*,masters.id as masterId FROM mastersWorks INNER JOIN masters ON masters.id = mastersWorks.master_id WHERE mastersWorks.master_id =?");
        $query->execute([$id]);
        return $query->fetchAll();
    }
    public static function findWork($img){
        $query=self::connect()->prepare("SELECT * FROM mastersWorks WHERE image = ?");
        $query->execute([$img]);
        return $query->fetch();
    }
    public static function addWork($img, $master_id){
        $work = self::findWork($img);
        if(!$work){
            $query=self::connect()->prepare("INSERT IGNORE INTO mastersWorks (image, master_id) VALUES (:image, :master_id)");
            $query->execute([
                ":image"=>$img,
                ":master_id"=>$master_id
            ]);
        }
    }
    public static function deleteWork($id){
        $query=self::connect()->prepare("DELETE FROM mastersWorks WHERE mastersWorks.id = ?");
        $query->execute([$id]);
    }
    public static function findWorkById($id){
        $query=self::connect()->prepare("SELECT * FROM mastersWorks INNER JOIN masters ON masters.id = mastersWorks.master_id WHERE mastersWorks.id =?");
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function deleteMaster($id){
        $query=self::connect()->prepare("DELETE FROM masters WHERE masters.id =?");
        $query->execute([$id]);
    }
}