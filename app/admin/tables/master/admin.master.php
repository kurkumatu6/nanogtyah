<?php
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Master;
if(!isset($_SESSION["admin-auth"])||!$_SESSION["admin-auth"]){
    $_SESSION["error"]="Вы не администратор";
    header("Location: /app/admin/tables/admin.auth.php");
    unset($_SESSION["admin-auth"]);
    die();
}
if(isset($_GET["id"]) &&  $_GET["id"]!="all"){
    $masters = Master::findMasterByPosition($_GET["id"]);
}else{
    $masters = Master::allMaster();
}

$positions=Master::allPosition();
include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.masters.view.php";
