<?php
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Master;
$position = Master::findPositionById($_GET["id"]);
include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/admin.position.show.view.php";