<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Master;



Master::getTimeByMaster($_GET['masterId'], $_GET['date']);