<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>На ногтях</title>

    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/app/admin/assets/jquery/jquery-ui.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/adaptiv.style.css">
</head>

<body>
    <nav class="navbar-header">
        <ul class="ul-links">
            <li class="nav-item">
                <a class="nav-link" href="/app/tables/products/price.php">Прайс</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/app/tables/products/master.php">Наши мастера</a>
            </li>
        </ul>
        <a class="a-img-logo d-flex justify-content-center" href="/index.php"><img class="img-logo" src="/assets/img/index/logo.png"></a>
        <ul class="сontact-details">
            <li class="nav-item">
                <a class="nav-link" href="#">+7(999)-999-99 99</a>
            </li>
            <?php if (!isset($_SESSION["auth"]) || !$_SESSION["auth"]) : ?>
                <li class="nav-item header-auth">
                    <a class="nav-link" href="/app/tables/users/auth.php">Войти</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/app/tables/users/profile.php">Личный кабинет</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/app/tables/users/logout.php">Выйти</a>
                </li>
            <? endif ?>
        </ul>
    </nav>
    <div class="topnav" id="myTopnav">
        <a class="a-img-logo" href="/index.php"><img class="img-logo" src="/assets/img/index/logo.png"></a>
        <a class="nav-link" href="#">+7(999)-999-99 99</a>
        <a class="nav-link" href="/app/tables/products/price.php">Прайс</a>
        <a class="nav-link" href="/app/tables/products/master.php">Наши мастера</a>
        <?php if (!isset($_SESSION["auth"]) || !$_SESSION["auth"]) : ?>
            <a class="nav-link" href="/app/tables/users/auth.php">Войти</a>
        <?php else : ?>
            <a class="nav-link" href="/app/tables/users/profile.php">Личный кабинет</a>
            <a class="nav-link" href="/app/tables/users/logout.php">Выйти</a>
        <?php endif ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>