<?php
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;

if (empty($_POST["name"])) {
    $_SESSION["error"]["name"] = "Поле название пустое";
}
if (empty($_POST["duration"])) {
    $_SESSION["error"]["duration"] = "Поле длительность пустое";
}
if (empty($_POST["price"])) {
    $_SESSION["error"]["price"] = "Поле цена пустое";
}

if (isset($_POST["saveBtn"])) {
    if (empty($_SESSION["error"])) {
    if ($_POST["id"] != null) {
        if(!isset($_POST["markupOption"])){
            $markupOption = 0;
        }else{
            $markupOption = $_POST["markupOption"];
        }
        Services::updateService($_POST["id"], $_POST, $markupOption);
        header("Location: /app/admin/tables/service/admin.service.php");
    }
}else{
    $id=$_POST["id"];
    header("Location: /app/admin/tables/service/admin.service.show.php?id=$id");
}
}