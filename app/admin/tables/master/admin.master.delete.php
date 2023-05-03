<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
use app\models\Master;
$works = Master::allWorksMaster($_GET["id"]);
$certificates = Master::allCertificatesByMaster($_GET["id"]);
foreach($works as $work){
    unlink("C:/OSPanel/domains/nanogtyah2/upload/works/".$work->image);
}
foreach($certificates as $certificate){
    unlink("C:/OSPanel/domains/nanogtyah2/upload/certificates/".$certificate->image);
}
$oldPhoto=Master::findMasterById($_GET["id"])->photo;
unlink("C:/OSPanel/domains/nanogtyah/upload/masters/".$oldPhoto);
$del = Master::deleteMaster($_GET["id"]);

header("Location: /app/admin/tables/master/admin.master.php");