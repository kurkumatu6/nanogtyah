<?php 
include $_SERVER["DOCUMENT_ROOT"].'/bootstrap.php';
use app\models\Master;
$master = Master::findMasterById($_GET["id"]);
$works = Master::allWorksMaster($_GET["id"]);
$certificates=Master::allCertificatesByMaster($_GET["id"]);
include $_SERVER["DOCUMENT_ROOT"]."/views/products/master.show.view.php";