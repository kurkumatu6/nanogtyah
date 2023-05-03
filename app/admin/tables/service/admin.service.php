<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;

if(!isset($_SESSION["admin-auth"])||!$_SESSION["admin-auth"]){
    $_SESSION["error"]="Вы не администратор";
    header("Location: /app/admin/tables/admin.auth.php");
    unset($_SESSION["admin-auth"]);
    die();
}
if(isset($_GET["id"])&& $_GET["id"]!="all"){
    $services = Services::showServicesByType($_GET["id"]);
}else{
    $services=Services::allService();
}

$typies = Services::allTypeOfService();

include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.service.view.php";
