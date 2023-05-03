<?php 
include $_SERVER["DOCUMENT_ROOT"].'/bootstrap.php';
use app\models\Master;
$masters= Master::allMaster();
include $_SERVER["DOCUMENT_ROOT"]."/views/products/master.view.php";