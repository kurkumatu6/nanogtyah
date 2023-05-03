<?php
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;
use app\models\Master;
if(!isset($_SESSION["admin-auth"])||!$_SESSION["admin-auth"]){
    $_SESSION["error"]="Вы не администратор";
    header("Location: /app/admin/tables/admin.auth.php");
    unset($_SESSION["admin-auth"]);
    die();
}
$master = Master::findMasterById($_GET["id"]);
$typiesMaster = Master::showServiceMasterById($_GET["id"]);
$typeMasterArr=[];
foreach ($typiesMaster as $type){
    array_push($typeMasterArr, $type->typeId);
};
$certificates = Master::allCertificatesByMaster($_GET["id"]);
$worksMaster = Master::allWorksMaster($_GET["id"]);
$positions = Master::allPosition();
$typies = Services::allTypeOfService();
include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.masters.show.view.php";
