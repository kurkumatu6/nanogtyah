<?php
use app\models\Services;
include $_SERVER["DOCUMENT_ROOT"]. "/bootstrap.php";

$oldImg = Services::findTypeId($_POST["id"])->image;
$extensions = ["jpeg", "jpg", "png", "webp", "jfif"];
$types = ["image/jpeg", "image/png", "image/webp", "image/jfif"];
if (empty($_POST["name"])) {
    $_SESSION["error"]["name"] = "Поле название пустое";
} elseif (!preg_match("/^[А-ЯЁа-яё][а-яё]+$/u", $_POST["name"])) {
    $_SESSION["error"]["name"] = "Некорректный название";
}
if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
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
                } else {
                    unlink("C:/OSPanel/domains/nanogtyah2/upload/typeOfServices/" . $oldImg);
                }
            }
        } else {
            $_SESSION["error"]["file"] = "есть ошибка";
        };
    } else {
        $_SESSION["error"]["file"] = "Расширение файла должно быть: " . implode(", ", $extensions);
    };
};

if (isset($_POST["saveBtn"])) {
    if (empty($_SESSION["error"])) {
    if ($_POST["id"] != null) {
        if (empty($_FILES["image"]["name"])) {
            Services::updateType($_POST["id"],$_POST["name"], $oldImg);
            header("Location: \app\admin/tables/typeOfService\admin.type.php");
        } else {
            Services::updateType($_POST["id"],$_POST["name"], $newName);
            header("Location: \app\admin/tables/typeOfService\admin.type.php");
        }
    }
}else{
    $id=$_POST["id"];
    header("Location: /app/admin/tables/typeOfService/admin.type.show.php?id=$id");
}
}