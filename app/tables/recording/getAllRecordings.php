<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Recording;


Recording::getAllRecordings($_GET['statusId'], $_GET['masterId']);