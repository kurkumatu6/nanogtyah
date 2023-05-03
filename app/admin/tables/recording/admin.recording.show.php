<?php
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Status;
use app\models\Master;

if(!isset($_SESSION["admin-auth"])||!$_SESSION["admin-auth"]){
    $_SESSION["error"]="Вы не администратор";
    header("Location: /app/admin/tables/admin.auth.php");
    unset($_SESSION["admin-auth"]);
    die();
}

$statuses = Status::getAllStatuses();
$masters = Master::allMaster();

include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.recording.view.php";