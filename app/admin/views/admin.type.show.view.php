<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>

<div class="div-return">
    <a href="/app/admin/tables/typeOfService/admin.type.php">Вернуться</a>
</div>
<main>
    <div class="div-type-show">
        <form action="/app/admin/tables/typeOfService/admin.type.update.php" class="updateType" method="POST" enctype="multipart/form-data">
            <h1>Изменение</h1>
            <input type="hidden" class="form-control" name="id" value="<?= $type->id ?>">

            <label for="name">Введите название: </label>
            <input type="text" class="form-control" name="name" value="<?= $type->name ?>">

            <?php if (!empty($_SESSION["error"]["name"])) : ?>
                <p class="error"><?= $_SESSION["error"]["name"] ?></p>
            <?php endif ?>

            <label for="image">Выберите картинку: <input type="file" class="form-control" name="image" id="file"></label>

            <img src="/upload/typeOfServices/<?= $type->image != null ? $type->image : 'nophoto.jpg' ?>" alt="" id="loadedImg" width="80" height="80">

            <?php if (!empty($_SESSION["error"]["file"])) : ?>
                <p class="error"><?= $_SESSION["error"]["file"] ?></p>
            <?php endif ?>

            <button class="button" name="saveBtn" for="image">Сохранить</button>
        </form>
    </div>
</main>
<script src="/app/admin/assets/js/loadImg.js"></script>
<?php unset($_SESSION["error"]) ?>