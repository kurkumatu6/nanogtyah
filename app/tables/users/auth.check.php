<?php
use app\models\User;
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

unset($_SESSION["error"]);

if(isset($_POST["authBtn"])){
    $user=User::getUser($_POST["email"], $_POST["password"]);
    if($user==null){
        $_SESSION["auth"]=false;
        $_SESSION["error"]="Неверный пароль";
        if(!User::findEmail($_POST["email"])){
            $_SESSION["error"]="Пользователь не найден";
        }
        header("Location: /app/tables/users/auth.php");
        die();
    } else{
        $_SESSION["auth"]=true;
        $_SESSION["id"]=$user->id;
        $_SESSION["name"]= $user->name;
        header("Location: /app/tables/users/profile.php");
        die();
    } 
}