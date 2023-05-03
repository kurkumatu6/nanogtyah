<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>
<main class="main-addMaster">
    <div class="div-return">
        <a href="/app/admin/tables/master/admin.master.php">Вернуться</a>
    </div>
    <div class="div-insertMaster">
        <form action="/app/admin/tables/master/admin.master.add.php" class="insertMaster admin-insertMaster" method="POST" enctype="multipart/form-data">
            <h1>Добавить нового мастера</h1>
            <label for="surname">Введите фамилию: </label>
            <input type="text" class="form-control" name="surname">

            <?php if (!empty($_SESSION["error"]["surname"])) : ?>
        <p class="error"><?= $_SESSION["error"]["surname"] ?></p>
      <?php endif ?>

            <label for="name">Введите имя: </label>
            <input type="text" class="form-control" name="name">

            <?php if (!empty($_SESSION["error"]["name"])) : ?>
        <p class="error"><?= $_SESSION["error"]["name"] ?></p>
      <?php endif ?>

            <label for="info">Введите информацию о мастере: </label>
            <input type="text" class="form-control" name="info">

            <?php if (!empty($_SESSION["error"]["info"])) : ?>
        <p class="error"><?= $_SESSION["error"]["info"] ?></p>
      <?php endif ?>

            <label for="email">Введите e-mail:</label>
            <input type="email" class="form-control" name="email">

            <?php if (!empty($_SESSION["error"]["email"])) : ?>
        <p class="error"><?= $_SESSION["error"]["email"] ?></p>
      <?php endif ?>

            <label for="phone">Введите номер телефона:</label>
            <input type="number" class="form-control" name="phone">

            <?php if (!empty($_SESSION["error"]["phone"])) : ?>
        <p class="error"><?= $_SESSION["error"]["phone"] ?></p>
      <?php endif ?>

            <label>Выберите разряд: </label>
            <?php foreach ($positions as $position) : ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="position_id" value="<?= $position->id ?>">
                    <label class="form-check-label" for="position_id">
                        <?= $position->name ?>
                    </label>
                </div>
            <?php endforeach ?>

            <?php if (!empty($_SESSION["error"]["position_id"])) : ?>
        <p class="error"><?= $_SESSION["error"]["position_id"] ?></p>
      <?php endif ?>

            <label>Выберите типы услуг, которые выполняет мастер: </label>
            <?php foreach ($typies as $type) : ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="typeOfService_id[]" value="<?= $type->id ?>">
                    <label class="form-check-label" for="typeOfService_id[]">
                        <?= $type->name ?>
                    </label>
                </div>
            <?php endforeach ?>

            <?php if (!empty($_SESSION["error"]["typeOfService_id"])) : ?>
        <p class="error"><?= $_SESSION["error"]["typeOfService_id"] ?></p>
      <?php endif ?>

            <label for="image" class="form-label">Введите картинку: </label>
            <input type="file" class="form-label" name="image">

            <?php if (!empty($_SESSION["error"]["file"])) : ?>
                <p class="error"><?= $_SESSION["error"]["file"] ?></p>
            <?php endif ?>
            <button class="button btn-insert" name="addMaster">Добавить</button>
        </form>
    </div>
</main>
