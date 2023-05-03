<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Master;
use app\models\Services;
$masters = Master::allMaster();
include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.shedule.view.php";