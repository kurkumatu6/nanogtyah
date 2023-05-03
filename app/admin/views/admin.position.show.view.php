<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>
<div class="div-return">
    <a href="/app/admin/tables/position/admin.position.php">Вернуться</a>
</div>
<main>
    <div class="div-service-show">
        <form action="/app/admin/tables/position/admin.position.update.php" class="updateService" method="POST">
            <input type="hidden" class="form-control" name="id" value="<?= $position->id ?>">

            <label for="name">Название: </label>
            <input type="text" class="form-control" name="name" value="<?= $position->name ?>">

            <?php if (!empty($_SESSION["error"]["name"])) : ?>
        <p class="error"><?= $_SESSION["error"]["name"] ?></p>
      <?php endif ?>

            <label for="markup">Надбавка(руб): </label>
            <input type="number" class="form-control" name="markup" value="<?= $position->markup ?>">

            <?php if (!empty($_SESSION["error"]["markup"])) : ?>
        <p class="error"><?= $_SESSION["error"]["markup"] ?></p>
      <?php endif ?>

            <div class="div-update">
                <button class="btn-type" name="saveBtn">Сохранить изменения</button>
            </div>
        </form>
    </div>
</main>
<?php unset($_SESSION["error"]) ?>