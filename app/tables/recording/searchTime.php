<?php

use app\models\Master;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

if(isset($_GET['id'])){
    $id =json_decode($_GET['id']);
    $time = Master::showTimeById($id);
    echo json_encode($time,JSON_UNESCAPED_UNICODE);
}