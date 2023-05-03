<?php

use app\models\User;

include $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
unset($_SESSION["errors"]);
session_unset();
if (isset($_POST["btn"])) {
    $_SESSION['contacts']["surname"] = $_POST["surname"];
    $_SESSION['contacts']["name"] = $_POST["name"];
    $_SESSION['contacts']["email"] = $_POST["email"];
    $_SESSION['contacts']["phone"] = $_POST["phone"];
    

    //проверка фамилии
    if (empty($_POST["surname"])) {
        $_SESSION["errors"]["surname"] = "Поле фамилии пустое";
    } elseif (!preg_match("/^[А-ЯЁа-яё][а-яё]+$/u", $_POST["surname"])) {
        $_SESSION["errors"]["surname"] = "Некорректный ввод фамилии";
    }
    //проверка имени
    if (empty($_POST["name"])) {
        $_SESSION["errors"]["name"] = "Поле имени пустое";
    } elseif (!preg_match("/^[А-ЯЁа-яё][а-яё]+$/u", $_POST["name"])) {
        $_SESSION["errors"]["name"] = "Некорректный ввод имени";
    }

    //проверка почты
    if (empty($_POST["email"])) {
        $_SESSION["errors"]["email"] = "Поле email пустое";
    } elseif (!preg_match("/([A-Za-z0-9]+@[a-z]+\.[a-z]+)/u", $_POST["email"])) {
        $_SESSION["errors"]["email"] = "Некорректный ввод email";
    } elseif (User::findEmail($_POST["email"])) {
        $_SESSION["errors"]["email"] = "Такая почта уже зарегистрирована";
    }

    //проверка пароля
    if (empty($_POST["password"]) || empty($_POST["password_confirmation"])) {
        $_SESSION["errors"]["password"] = "пустой пароль";
    } elseif ($_POST["password"] != $_POST["password_confirmation"]) {
        $_SESSION["errors"]["password"] = "пароли не совпадают";
    }

    //после проверок, добавляем пользователя в бд
    if(empty($_SESSION["errors"])){
        if(User::insert($_POST)){
            $user = User::getUser($_POST["email"], $_POST["password"]);
            $_SESSION["auth"]=true;
            $_SESSION["id"] = $user->id;
            $_SESSION["name"]=$user->name;
            header("Location: /app/tables/users/profile.php");
            die();
        } else{
            $_SESSION['auth']= false;
            header("Location: /app/tables/users/create.php");
            die();
        }
    }else {
        header("Location: /app/tables/users/create.php");
    }
}