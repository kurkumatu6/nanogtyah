<?php
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;
$typies =Services::allTypeOfService();
$service = Services::findServiceById($_GET["id"]);
if(!isset($_SESSION["admin-auth"])||!$_SESSION["admin-auth"]){
    $_SESSION["error"]="Вы не администратор";
    header("Location: /app/admin/tables/admin.auth.php");
    unset($_SESSION["admin-auth"]);
    die();
}
include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.service.show.php";