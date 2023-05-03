<?php
use app\models\Services;
use app\models\Master;
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
$idCategory=1;
if(isset($_GET["idCategory"])){
    $idCategory=$_GET["idCategory"];
}
$categories= Services::allTypeOfService();
$positions = Master::allPosition();
$services=Services::showServicesByType($idCategory);
$typeName=Services::findTypeId($idCategory);
include $_SERVER["DOCUMENT_ROOT"]."/views/products/price.view.php";
