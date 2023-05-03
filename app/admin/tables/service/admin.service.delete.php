<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Services;
$del = Services::deleteService($_GET["id"]);
if(!empty($del)){
    $_SESSION["rezult"]="Услуга удалена";
}

header("Location: /app/admin/tables/service/admin.service.php");