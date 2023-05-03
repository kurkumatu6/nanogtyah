<?php

use app\models\Master;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
$dates = Master::showDateByMaster($_POST["master"]);

$time = date_create("08:00");
$timeArr = [];
for ($i = 0; $i < 12; $i++) {
    date_add($time, date_interval_create_from_date_string("+ 1hours"));
    array_push($timeArr, date_format($time, "H:i"));
}

include $_SERVER["DOCUMENT_ROOT"] . "/views/recording/dateTime.view.php";
