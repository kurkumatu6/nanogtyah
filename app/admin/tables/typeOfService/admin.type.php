<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;

if(!isset($_SESSION["admin-auth"])||!$_SESSION["admin-auth"]){
    $_SESSION["error"]="Вы не администратор";
    header("Location: /app/admin/tables/admin.auth.php");
    unset($_SESSION["admin-auth"]);
    die();
}

$typies = Services::allTypeOfService();
include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.typeOfService.view.php";
?>
