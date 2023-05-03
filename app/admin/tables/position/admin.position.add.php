<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

use app\models\Master;

if (empty($_POST["name"])) {
    $_SESSION["error"]["name"] = "Поле название пустое";
}
if (empty($_POST["markup"])) {
    $_SESSION["error"]["markup"] = "Поле надбавка пустое";
}

if (isset($_POST["insertBtn"])) {
    if (empty($_SESSION["error"])) {
        Master::addPosition($_POST);
    }
    header("Location: /app/admin/tables/position/admin.position.php");
}
