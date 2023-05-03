<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";

?>
<div class="div-return">
    <a href="/app/admin/tables/service/admin.service.php">Вернуться</a>
</div>
<main>
<div class="div-service-show">
    <form action="/app/admin/tables/service/admin.service.update.php" class="updateService" method="POST">
        <input type="hidden" class="form-control" name="id" value="<?= $service->id ?>">

        <label for="name">Название: </label>
        <input type="text" class="form-control" name="name" value="<?= $service->name ?>">

        <?php if (!empty($_SESSION["error"]["name"])) : ?>
        <p class="error"><?= $_SESSION["error"]["name"] ?></p>
      <?php endif ?>

        <label for="description">Описание: </label>
        <input type="text" class="form-control" name="description" value="<?= $service->description ?>">

        <label for="duration">Длительность:</label>
        <input type="number" class="form-control" name="duration" value="<?= $service->duration ?>">

        <?php if (!empty($_SESSION["error"]["duration"])) : ?>
        <p class="error"><?= $_SESSION["error"]["duration"] ?></p>
      <?php endif ?>

        <label for="price">Первоначальная цена:</label>
        <input type="number" class="form-control" name="price" value="<?= $service->price ?>">

        <?php if (!empty($_SESSION["error"]["price"])) : ?>
        <p class="error"><?= $_SESSION["error"]["price"] ?></p>
      <?php endif ?>

        <label for="typeOfService_id">Выберите тип услуги: </label>
        <select name="typeOfService_id" class="form-control" id="">
            <?php foreach ($typies as $type) : ?>
                <option value="<?= $type->id ?>"> <?= $type->name ?></option>
            <?php endforeach ?>
        </select>
        <div class="form-check">
            <label class="form-check-label" for="markupOption">Неизменяемая цена</label>
            <input type="checkbox" name="markupOption" class="form-check-input" value="1" <?=$service->markupOption==1?"checked":"" ?>><br>
            </div>
        <div class="div-update">
        <button class="button" name="saveBtn">Сохранить изменения</button>
    </div>
    </form>
</div></main>
<?php unset($_SESSION["error"]) ?>