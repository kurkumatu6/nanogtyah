<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;
if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header("Location: /app/tables/users/auth.php");
    die();
}

use app\models\Master;

$typeOfServices = Services::allTypeOfService();

include $_SERVER["DOCUMENT_ROOT"]."/views/recording/service.view.php";