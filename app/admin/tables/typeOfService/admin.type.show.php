<?php
use app\models\Services;
include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if (!isset($_SESSION["admin-auth"]) || !$_SESSION["admin-auth"]) {
    header("Location: /app/admin/tables/admin.auth.php");
    die();
}

$type = Services::findTypeId($_GET["id"]);
include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.type.show.view.php";