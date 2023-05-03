<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Recording;

if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header("Location: /app/tables/users/auth.php");
    die();
}

$payload = file_get_contents('php://input');
$data = json_decode($payload);


Recording::signUp($data->date, $data->finalCost, $data->masterId, $data->serviceId, $data->statusId);