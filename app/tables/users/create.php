<?php

use app\models\User;

include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
$roles=User::allRole();
include $_SERVER["DOCUMENT_ROOT"]."/views/users/create.view.php";