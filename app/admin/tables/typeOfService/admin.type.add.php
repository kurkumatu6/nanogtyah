<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

use app\models\Services;
if (empty($_POST["type"])) {
    $_SESSION["error"]["name"] = "Поле название пустое";
} elseif (!preg_match("/^[А-ЯЁа-яё][а-яё]+$/u", $_POST["type"])) {
    $_SESSION["error"]["name"] = "Некорректный название";
}
$extensions = ["jpeg", "jpg", "png", "webp", "jfif"];  //форматы
$types = ["image/jpeg","image/png","image/webp","image/jfif"]; // типы
if (isset($_FILES["image"])) {
    $name = $_FILES["image"]["name"];
    $tmpName = $_FILES["image"]["tmp_name"];
    $error = $_FILES["image"]["error"];
    $size = $_FILES["image"]["size"];

    $path_parts = pathinfo($name);
    $ext = $path_parts["extension"];
    $mim = mime_content_type($tmpName);
    
    if (in_array($ext, $extensions) && in_array($mim, $types)) {
        $newName = $name;
        if ($error == 0) {
            if ($size > 3145728) {
                $_SESSION["error"]["file"] = "Файл слишком большой";
            } else {
                if (!move_uploaded_file($tmpName, "C:/OSPanel/domains/nanogtyah2/upload/typeOfServices/" . $newName)) {
                    $_SESSION["error"]["file"] = "Не удалось переместить файл";
                };
            }
        } else {
            $_SESSION["error"]["file"] = "есть ошибка";
        };
    }else{
        $_SESSION["error"]["file"] = "Расширение файла должно быть: " . implode(", ", $extensions);
    };
};

if(isset($_POST["addType"])){
    if (empty($_SESSION["error"])) {
        Services::addType($_POST["type"], $newName);
    }
    header("Location: \app\admin/tables/typeOfService\admin.type.php");
}

