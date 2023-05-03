<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;
use app\models\Master;

$idService = $_POST["service"];
$idType = $_POST["type"];
$masters = Master::showMasterByTypeOfService($idType);

include $_SERVER["DOCUMENT_ROOT"]."/views/recording/master.view.php";