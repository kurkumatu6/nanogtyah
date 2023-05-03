<?php
session_start();

include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

use app\models\User;
use app\models\Status;

$user = User::findId($_SESSION["id"]);

$statuses = Status::getAllStatuses();

include $_SERVER["DOCUMENT_ROOT"] . "/views/users/profile.view.php"; ?>