<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

use app\models\Master;
unset($_SESSION["error-work"]);
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
                $_SESSION["error-work"] = "Файл слишком большой";
            } else {
                if (!move_uploaded_file($tmpName, "C:/OSPanel/domains/nanogtyah2/upload/works/" . $newName)) {
                    $_SESSION["error-work"] = "Не удалось переместить файл";
                };
            }
        } else {
            $_SESSION["error-work"] = "есть ошибка";
        };
    }else{
        $_SESSION["error-work"] = "Расширение файла должно быть: " . implode(", ", $extensions);
    };
};

if(isset($_POST["addWork"])){
    $masterId = $_POST["id"];
    if (empty($_SESSION["error-work"])) {
    
    Master::addWork($newName,$masterId);
    
}header("Location: \app\admin/tables/master/admin.master.show.php?id=$masterId");
}