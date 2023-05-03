<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Recording;
if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header("Location: /app/tables/users/auth.php");
    die();
}

$userId = $_SESSION["id"];

Recording::getAllRecordingsByUser($userId, $_GET['statusId']);