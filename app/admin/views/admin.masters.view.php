<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>

<main class="main-master">
    <div class="div-insert-master">
        <a class="a-insert-master" href="/app/admin/tables/master/admin.master.add.php">Добавить нового мастера</a>
    </div>
    <div class="service-type">
        <a href="/app/admin/tables/master/admin.master.php?id=all">Все мастера</a>
        <?php foreach ($positions as $position) : ?>
            <a href="/app/admin/tables/master/admin.master.php?id=<?= $position->id ?>"><?= $position->name ?></a>
        <?php endforeach ?>
    </div>
    <div class="flex-table-master">
    <div class="table-masters">
        <table>
            <th class="th-master">Фамилия</th>
            <th class="th-master">Имя</th>
            <th class="th-master">Фото</th>
            <th class="th-master">Разряд</th>
            <th class="th-master"></th>
            <?php foreach ($masters as $master) : ?>
                <tr class="tr-master">
                    <td class="td-master"><?= $master->surname ?></td>
                    <td class="td-master"><?= $master->name ?></td>
                    <td class="td-master"><img class="img-master" src="/upload/masters/<?= $master->photo ?>"></td>
                    <td class="td-master"><?= $master->position ?></td>
                    <td class="td-master"><a href="/app/admin/tables/master/admin.master.show.php?id=<?= $master->id?>">Подробнее</a></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div></div>
</main>