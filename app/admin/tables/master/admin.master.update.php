<?php

use app\models\Master;
use app\models\Services;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";

$idMaster = $_POST['id'];

if (empty($_POST["surname"])) {
    $_SESSION["error"]["surname"] = "Поле фамилии пустое";
} elseif (!preg_match("/^[А-ЯЁа-яё][а-яё]+$/u", $_POST["surname"])) {
    $_SESSION["error"]["surname"] = "Некорректный ввод фамилии";
}
//проверка имени
if (empty($_POST["name"])) {
    $_SESSION["error"]["name"] = "Поле имени пустое";
} elseif (!preg_match("/^[А-ЯЁа-яё][а-яё]+$/u", $_POST["name"])) {
    $_SESSION["error"]["name"] = "Некорректный ввод имени";
}

if (empty($_POST["phone"])) {
    $_SESSION["error"]["phone"] = "Поле телефона пустое";
}
if (empty($_POST["info"])) {
    $_SESSION["error"]["info"] = "Поле информация о мастере пустое";
}
if (empty($_POST["position_id"])) {
    $_SESSION["error"]["position_id"] = "Выберите разряд";
}
if (empty($_POST["typeOfService_id"])) {
    $_SESSION["error"]["typeOfService_id"] = "Выберите типы услуг";
}

//проверка почты
if (empty($_POST["email"])) {
    $_SESSION["error"]["email"] = "Поле email пустое";
} elseif (!preg_match("/([A-Za-z0-9]+@[a-z]+\.[a-z]+)/u", $_POST["email"])) {
    $_SESSION["error"]["email"] = "Некорректный ввод email";
}


$oldImg = Master::findMasterById($_POST["id"])->photo;
$extensions = ["jpeg", "jpg", "png", "webp", "jfif"];
$types = ["image/jpeg", "image/png", "image/webp", "image/jfif"];

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
                if (!move_uploaded_file($tmpName, "C:/OSPanel/domains/nanogtyah2/upload/masters/" . $newName)) {
                    $_SESSION["error"]["file"] = "Не удалось переместить файл";
                } else {
                    unlink("C:/OSPanel/domains/nanogtyah2/upload/masters/" . $oldImg);
                }
            }
        } else {
            $_SESSION["error"]["file"] = "есть ошибка";
        };
    } else {
        $_SESSION["error"]["file"] = "Расширение файла должно быть: " . implode(", ", $extensions);
    };
};

if (isset($_POST["addMaster"])) {
    if (empty($_SESSION["error"])) {
    if ($_POST["id"] != null) {
        if (empty($_FILES["image"]["name"])) {
            Master::updateMaster($_POST, $oldImg);
            Master::deleteMasterService($idMaster);
            $typiesId = $_POST["typeOfService_id"];
            for ($i = 0; $i <= count($typiesId); $i++) {
                Master::addMasterService($idMaster, $typiesId[$i]);
            }


           
        } else {
            Master::updateMaster($_POST, $newName);
            Master::deleteMasterService($idMaster);
            $typiesId = $_POST["typeOfService_id"];
            for ($i = 0; $i <= count($typiesId); $i++) {
                Master::addMasterService($idMaster, $typiesId[$i]);
            }
            
        }
    }
}header("Location: \app\admin/tables/master/admin.master.show.php?id=$idMaster");
}
