<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"]."/app/config/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/app/config/PDOConnection.php";
include $_SERVER["DOCUMENT_ROOT"]."/app/models/Services.php";
include $_SERVER["DOCUMENT_ROOT"]."/app/models/User.php";
include $_SERVER["DOCUMENT_ROOT"]."/app/models/Master.php";
include $_SERVER["DOCUMENT_ROOT"]."/app/models/Reviews.php";
include $_SERVER["DOCUMENT_ROOT"]."/app/models/Shedule.php";
include $_SERVER["DOCUMENT_ROOT"]."/app/models/Recording.php";
include $_SERVER["DOCUMENT_ROOT"]."/app/models/Status.php";