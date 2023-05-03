<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>
<main class="main-service">
    <div class="div-service-add">
        <form action="/app/admin/tables/service/admin.service.add.php" class="insertService admin-insertService" method="POST">
            <h1>Добавить услугу</h1>
            <label for="name">Введите название: </label>
            <input type="text" class="form-control label-product" name="name">
            
            <?php if (!empty($_SESSION["error"]["name"])) : ?>
        <p class="error"><?= $_SESSION["error"]["name"] ?></p>
      <?php endif ?>

            <label for="description">Введите описание: </label>
            <input type="text" class="form-control" name="description">

            <label for="duration">Введите длительность:</label>
            <input type="number" class="form-control" name="duration">

            <?php if (!empty($_SESSION["error"]["duration"])) : ?>
        <p class="error"><?= $_SESSION["error"]["duration"] ?></p>
      <?php endif ?>

            <label for="price">Введите первоначальную цену:</label>
            <input type="number" class="form-control" name="price">

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
            <input type="checkbox" name="markupOption" class="form-check-input" value="1"><br>
            </div>


            <button class="button btn-insert" name="insertBtn" for="image">Добавить</button>
        </form>
    </div>

    <div class="div-service-table">
        <div class="service-type">
            <a href="/app/admin/tables/service/admin.service.php?id=all">все услуги</a>
            <?php foreach ($typies as $type) : ?>
                <a href="/app/admin/tables/service/admin.service.php?id=<?= $type->id ?>"><?= $type->name ?></a>
            <?php endforeach ?>
        </div>
        <div class="service-table">
            <table class="service-container-admin">
                
                    <th class="th-service">Тип услуги</th>
                    <th class="th-service">Название</th>
                    <th class="th-service">Первоначальная цена</th>
                    <th class="th-service">Длительность</th>
                    <th class="th-service"></th>
                    <th class="th-service"></th>

                <?php foreach ($services as $service) : ?>
                    <tr class="tr-service">
                        <td class="td-service"><?= $service->type ?></td>
                        <td class="td-service"><?= $service->name ?></td>
                        <td class="td-service"><?= $service->price ?></td>
                        <td class="td-service"><?= $service->duration ?></td>
                        <td class="td-service ">
                            <a class="a-show" href="/app/admin/tables/service/admin.service.show.php?id=<?= $service->id ?>">Подробнее</a>
                        </td>
                        <td class="td-service" >
                            <a class="a-delete"href="/app/admin/tables/service/admin.service.delete.php?id=<?= $service->id ?>">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</main>

<?php unset($_SESSION["error"]) ?>