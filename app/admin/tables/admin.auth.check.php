<?php
use app\models\User;
include $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";
unset($_SESSION["error"]);

if(isset($_POST["authBtn"])){
    $admin = User::getUser($_POST['email'],$_POST["password"]);
    if($admin == null){
        $_SESSION["admin-auth"] = false;
        $_SESSION["error"]["admin-auth"]="Неверный пароль";
        if(!User::findEmail($_POST["email"])){
            $_SESSION["error"]["admin-auth"]="Пользователь не найден";    
        } 
        header("Location: /app/admin/tables/admin.auth.php");
    } else{
        if($admin->role = 'админ'){
            $_SESSION["admin-auth"]=true;
            $_SESSION['admin-id']=$admin->id;
            $_SESSION['admin-name']=$admin->name;
            header('Location: /app/admin/tables/typeOfService/admin.type.php');
        } else{
            $_SESSION["admin-auth"]=false;
            $_SESSION["error"]["admin-auth"] = "ВЫ не администратор";
            header("Location: /app/admin/tables/admin.auth.php");
        }
    }
}