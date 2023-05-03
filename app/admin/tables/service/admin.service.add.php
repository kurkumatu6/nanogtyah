<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

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

if (isset($_POST["insertBtn"])) {
    if (empty($_SESSION["error"])) {
        if (!isset($_POST["markupOption"])) {
            $markup = 0;
        } else {
            $markup = $_POST["markupOption"];
        }
        Services::addService($_POST, $markup);
    }
    header("Location: /app/admin/tables/service/admin.service.php");
}
