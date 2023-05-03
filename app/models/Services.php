<?php

namespace app\models;

use app\base\PDOConnection;

class Services
{
    private static function connect($config = CONFIG_CONNECTION)
    {
        return PDOConnection::make($config);
    }

    //категории услуг
    public static function allTypeOfService()
    {
        $query = self::connect()->query("SELECT * FROM typeOfService");
        return $query->fetchAll();
    }

    public static function showServicesByTypeJSON($idType)
    {
        $query = self::connect()->prepare("SELECT services.*,services.id as id, typeOfService.name as type FROM services INNER JOIN typeOfService ON typeOfService.id = typeOfService_id WHERE typeOfService_id = ? ORDER BY price ASC");

        $query->execute([$idType]);

        $rez = $query->fetchAll();
        echo json_encode($rez, JSON_UNESCAPED_UNICODE);
    } 
    public static function showServicesByType($idType)
    {
        $query = self::connect()->prepare("SELECT services.*,services.id as id, typeOfService.name as type FROM services INNER JOIN typeOfService ON typeOfService.id = typeOfService_id WHERE typeOfService_id = ? ORDER BY price ASC");

        $query->execute([$idType]);

        return $query->fetchAll();
    }
    //конечная стоимость услуг
    public static function finalCost($serviceId, $positionId)
    {
        $query = self::connect()->prepare("SELECT (SELECT services.price FROM typeOfService JOIN services ON typeOfService.id = services.typeOfService_id WHERE services.id =:serviceId)+(SELECT position.markup FROM position WHERE position.id =:positionId)");
        $query->execute([
            ":serviceId" => $serviceId,
            ":positionId" => $positionId
        ]);
        $rez = $query->fetch(\PDO::FETCH_COLUMN);
        return $rez;
    }

    //методы дл админа
    //типы услуг
    public static function findTypeId($id)
    {
        $query = self::connect()->prepare("SELECT * FROM typeOfService WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function findType($name)
    {
        $query = self::connect()->prepare("SELECT * FROM typeOfService WHERE name = :name");
        $query->execute([
            ":name" => $name
        ]);
        return $query->fetch();
    }
    public static function addType($name, $image)
    {
        $type = self::findType($name);
        if (!$type) {
            $query = self::connect()->prepare("INSERT IGNORE INTO typeOfService (name, image) VALUES (:name, :image)");
            $query->execute([":name" => $name, ":image" => $image]);
        }
    }
    public static function deleteType($id)
    {
        $query = self::connect()->prepare("DELETE FROM typeOfService WHERE id = ?");
        $query->execute([$id]);
    }
    public static function updateType($id, $name, $image)
    {
        $query = self::connect()->prepare(("UPDATE typeOfService SET name = :name, image = :image WHERE id = :id"));
        $query->execute([
            ":id" => $id,
            ":name" => $name,
            ":image" => $image
        ]);
    }
    //услуги
    public static function allServiceJSON()
    {
        $query = self::connect()->query("SELECT services.*,typeOfService.name as type FROM services INNER JOIN typeOfService ON typeOfService.id = services.typeOfService_id ORDER BY price ASC");
        $rez =  $query->fetchAll();
        echo json_encode($rez, JSON_UNESCAPED_UNICODE);
    }

    public static function allService()
    {
        $query = self::connect()->query("SELECT services.*,typeOfService.name as type FROM services INNER JOIN typeOfService ON typeOfService.id = services.typeOfService_id ORDER BY price ASC");
        return $query->fetchAll();
    }

    public static function addService($data, $markupOption)
    {
        $service = self::findService($data["name"]);
        if (!$service) {
        $query = self::connect()->prepare("INSERT IGNORE INTO services (name, duration, price, description, typeOfService_id, markupOption) VALUES (:name, :duration, :price, :description, :typeOfService_id, :markupOption)");
        $query->execute([
            ":name" => $data["name"],
            ":duration" => $data["duration"],
            ":price" => $data["price"],
            ":description" => $data["description"],
            ":typeOfService_id" => $data["typeOfService_id"],
            ":markupOption" => $markupOption
        ]);
    }
    }
    public static function deleteService($id){
        $query= self::connect()->prepare("DELETE FROM services WHERE id = ?");
        $query->execute([$id]);
        return "delete";
    }
    public static function findService($name)
    {
        $query = self::connect()->prepare("SELECT * FROM services WHERE name = :name");
        $query->execute([
            ":name" => $name
        ]);
        return $query->fetch();
    }
    public static function findServiceById($id){
        $query=self::connect()->prepare("SELECT services.*,typeOfService.name as type FROM services INNER JOIN typeOfService ON typeOfService.id = services.typeOfService_id WHERE services.id = ? ");
        $query->execute([$id]);
        return $query->fetch();
    }
    public static function updateService($id, $data, $markupOption){
        $query = self::connect()->prepare("UPDATE services SET name = :name, duration = :duration, price = :price, description = :description, typeOfService_id = :typeOfService_id, markupOption = :markupOption WHERE id = :id");
        $query->execute([
            ":id"=>$id,
            ":name"=>$data["name"],
            ":duration"=>$data["duration"],
            ":price"=>$data["price"],
            ":description"=>$data["description"],
            ":typeOfService_id"=>$data["typeOfService_id"],
            ":markupOption"=>$markupOption
        ]);

    }
    public static function getServiceTypes()
    {
        $query = self::connect()->query("SELECT * FROM typeOfService");

        echo json_encode($query->fetchAll(), JSON_UNESCAPED_UNICODE);
    }
}