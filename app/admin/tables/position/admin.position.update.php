<?php
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Master;

if (empty($_POST["name"])) {
    $_SESSION["error"]["name"] = "Поле название пустое";
}
if (empty($_POST["markup"])) {
    $_SESSION["error"]["markup"] = "Поле надбавка пустое";
}

if (isset($_POST["saveBtn"])) {
    if (empty($_SESSION["error"])) {
    if ($_POST["id"] != null) {
        
        Master::updatePosition($_POST["id"], $_POST);
        header("Location: /app/admin/tables/position/admin.position.php");
    }
}else{
    $id=$_POST["id"];
    header("Location: /app/admin/tables/position/admin.position.show.php?id=$id");
}
}