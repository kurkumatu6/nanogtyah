<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>На ногтях</title>
    <link rel="stylesheet" href="\app\admin\assets\css\admin.style.css">
    <link rel="stylesheet" href="/app/admin/assets/jquery/jquery-ui.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="navbar-header">
        <ul class="ul-admin">
            <?php if (!isset($_SESSION["admin-auth"]) || !$_SESSION["admin-auth"]) : ?>
            <li class="nav-item">
                <a class="a-img-logo" href="#"><img class="img-logo" src="/assets/img/index/logo.png"></a>
            </li>


            <?php else :?>
            <li class="nav-item">
                <a class="nav-link" href="/app/admin/tables/recording/admin.recording.show.php">Записи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/app/admin/tables/typeOfService/admin.type.php">Категории</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/app/admin/tables/service/admin.service.php">Услуги</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/app/admin/tables/position/admin.position.php">Должности</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/app/admin/tables/master/admin.master.php">Мастера</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/app/admin/tables/shedule/admin.shedule.php">Расписание</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/app/admin/tables/admin.logout.php">Выход</a>
            </li>
            <? endif?>
        </ul>
    </nav>