<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;

Services::showServicesByTypeJSON($_GET["type"]);