<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Master;
$del = Master::deletePosition($_GET["id"]);
if(!empty($del)){
    $_SESSION["rezult"]="Должность удалена";
}

header("Location: /app/admin/tables/position/admin.position.php");