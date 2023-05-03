<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>
<main class="main-position">
    <div class="div-position-add">
        <form action="/app/admin/tables/position/admin.position.add.php" class="insertPosition admin-insertPosition" method="POST">
            <h1>Добавить должность</h1>
            <label for="name">Введите название: </label>
            <input type="text" class="form-control label-product" name="name">

            <?php if (!empty($_SESSION["error"]["name"])) : ?>
        <p class="error"><?= $_SESSION["error"]["name"] ?></p>
      <?php endif ?>

            <label for="markup">Введите надбавку(руб): </label>
            <input type="number" class="form-control" name="markup">

            <?php if (!empty($_SESSION["error"]["markup"])) : ?>
        <p class="error"><?= $_SESSION["error"]["markup"] ?></p>
      <?php endif ?>

            <button class="button btn-insert" name="insertBtn">Добавить</button>
        </form>
    </div>

    <div class="div-position-table">
            <table class="position-service-admin">
                
                    <th class="th-service">Тип услуги</th>
                    <th class="th-service">Название</th>
                    <th class="th-service"></th>
                    <th class="th-service"></th>
                    <th class="th-service"></th>

                <?php foreach ($positions as $position) : ?>
                    <tr class="tr-service">
                        <td class="td-service"><?= $position->name ?></td>
                        <td class="td-service"><?= $position->markup ?> руб.</td>
                        <td class="td-service type-green">
                            <a class="a-show" href="/app/admin/tables/position/admin.position.show.php?id=<?= $position->id?>">Изменить</a>
                        </td>
                        <td class="td-service" >
                            <a class="a-delete" href="/app/admin/tables/position/admin.position.delete.php?id=<?= $position->id?>">Удалить</a>
                        </td>
                        <td class="td-service" >
                            <a class="a-show" href="/app/admin/tables/master/admin.master.php?id=<?= $position->id ?>">Перейти</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
    </div>
</main>
<?php unset($_SESSION["error"]) ?>