<?php
use app\models\Master;
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
$stream = file_get_contents("php://input");
if ($stream != null) {
 $id = json_decode($stream)->id;
 $oldImg = Master::findWorkById($id)->image;
 unlink("C:/OSPanel/domains/nanogtyah2/upload/works/".$oldImg);
 $del =Master::deleteWork($id);
 echo json_encode( $del, JSON_UNESCAPED_UNICODE);
}

include $_SERVER['DOCUMENT_ROOT'] . '/app/admin/views/admin.masters.show.view.php';