<?php
use app\models\Services;
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
$stream = file_get_contents("php://input");
if ($stream != null) {
 $id = json_decode($stream)->id;
 $oldImg = Services::findTypeId($id)->image;
 unlink("C:/OSPanel/domains/nanogtyah2/upload/typeOfServices/".$oldImg);
 $del = Services::deleteType($id);
 echo json_encode( $del, JSON_UNESCAPED_UNICODE);
}

include $_SERVER['DOCUMENT_ROOT'] . '/app/admin/views/admin.typeOfService.view.php';