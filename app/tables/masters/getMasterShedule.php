<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Master;

Master::getMasterShedule($_GET["masterId"]);