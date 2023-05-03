<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>
<main class="main-master-show">
    <div class="div-return">
        <a href="/app/admin/tables/master/admin.master.php">Вернуться</a>
    </div>
    <div class="div-master-osn">
        <h1>Основная информация о мастере</h1>
        <form action="/app/admin/tables/master/admin.master.update.php" class="" method="POST" enctype="multipart/form-data">
            <div class="div-update-master">
                <div>
                    <input type="hidden" class="form-control" name="id" value="<?= $master->id ?>">
                    <label for="surname">Фамилия: </label>
                    <input type="text" class="form-control" name="surname" value="<?= $master->surname ?>">

                    <?php if (!empty($_SESSION["error"]["surname"])) : ?>
        <p class="error"><?= $_SESSION["error"]["surname"] ?></p><?php endif ?>

                    <label for="name">Имя: </label>
                    <input type="text" class="form-control" name="name" value="<?= $master->name ?>">

                    <?php if (!empty($_SESSION["error"]["name"])) : ?>
        <p class="error"><?= $_SESSION["error"]["name"] ?></p>
      <?php endif ?>

                    <label for="info">Информацию о мастере: </label>
                    <input type="text" class="form-control" name="info" value="<?= $master->info ?>">

                    <?php if (!empty($_SESSION["error"]["info"])) : ?>
        <p class="error"><?= $_SESSION["error"]["info"] ?></p>
      <?php endif ?>

                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email" value="<?= $master->email ?>">

                    <?php if (!empty($_SESSION["error"]["email"])) : ?>
        <p class="error"><?= $_SESSION["error"]["email"] ?></p>
      <?php endif ?>

                    <label for="phone">Номер телефона:</label>
                    <input type="number" class="form-control" name="phone" value="<?= $master->phone ?>">

                    <?php if (!empty($_SESSION["error"]["phone"])) : ?>
        <p class="error"><?= $_SESSION["error"]["phone"] ?></p>
      <?php endif ?>

                </div>
                <div>
                    <label>Разряд: </label>
                    <?php foreach ($positions as $position) :
                    ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="position_id" value="<?= $position->id ?>" <?= $master->position_id == $position->id ? "checked" : "" ?>>
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
                            <input class="form-check-input" type="checkbox" name="typeOfService_id[]" value="<?= $type->id ?>" <?= in_array($type->id, $typeMasterArr) ? "checked" : "" ?>>
                            <label class="form-check-label" for="typeOfService_id[]">
                                <?= $type->name ?>
                            </label>
                        </div>
                    <?php endforeach ?>

                    <?php if (!empty($_SESSION["error"]["typeOfService_id"])) : ?>
        <p class="error"><?= $_SESSION["error"]["typeOfService_id"] ?></p>
      <?php endif ?>

                </div>
                <div>
                    <label for="image">Фото: <input type="file" class="form-control" name="image" id="file"></label>

                    <img src="/upload/masters/<?= $master->photo ?>" alt="" id="loadedImg" width="250px">
                    <?php if (!empty($_SESSION["error"]["file"])) : ?>
                <p class="error"><?= $_SESSION["error"]["file"] ?></p>
            <?php endif ?>
                </div>
            </div>
            <button class="button btn-insert" name="addMaster">Сохранить изменения</button>

        </form>

    </div>
    <?php unset($_SESSION["error"]) ?>
    <div class="div-certificates-osn">
        <h1>Сертификаты</h1>
        <div>
            <div class="div-table-cert">
                <?php if (!empty($certificates)) : ?>

                    <table class="table-certificates">
                        <th class="th-cert">Название</th>
                        <th class="th-cert">Сертификат</th>
                        <th class="th-cert"></th>
                        <?php foreach ($certificates as $certificate) : ?>
                            <tr class="tr-cert">
                                <td class="td-cert"><?= $certificate->name ?></td>
                                <td class="td-cert"> <img class="img-cert" src="/upload/certificates/<?= $certificate->image ?>"></td>
                                <td class="td-cert"><button class="delete delete-cert" data-id="<?= $certificate->id ?>">Удалить</button></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                <?php else : ?>
                    <p>У мастера нет добавленных сертификатов</p>
                <?php endif ?>
            </div>
            <form class="form-cert" action="/app/admin/tables/master/admin.certificates.add.php" method="POST" enctype="multipart/form-data">
                <h4>Добавить сертификат</h4>
                <input type="hidden" class="form-control" name="id" value="<?= $master->id ?>">
                <label for="exampleInputType" class="form-label">Введите название</label>
                <input name="name" type="text" class="form-control" id="exampleInputType">

                <?php if (!empty($_SESSION["error-cert"]["name"])) : ?>
                    <p class="error"><?= $_SESSION["error-cert"]["name"] ?></p>
                <?php endif ?>

                <label for="image">Добавить картинку: <input type="file" class="form-control" name="image" id="file"></label>
                <?php if (!empty($_SESSION["error-cert"]["file"])) : ?>
                    <p class="error"><?= $_SESSION["error-cert"]["file"] ?></p>
                <?php endif ?>

                <button name="addCert" type="submit" class="btn-type">Добавить</button>
            </form>
        </div>
    </div>
    <div class="div-master-work">
        <h1>Работы мастера</h1>
        <div>
            <div class="div-table-work">
                <?php if (!empty($worksMaster)) : ?>

                    <table class="table-worksMaster">
                        <th class="th-work">Фото</th>
                        <th class="th-work"></th>
                        <?php foreach ($worksMaster as $work) : ?>
                            <tr class="tr-work">
                                <td class="td-work"> <img class="img-work" src="/upload/works/<?= $work->image ?>"></td>
                                <td class="td-work"><button class="delete delete-work" data-id="<?= $work->id ?>">Удалить</button></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                <?php else : ?>
                    <p>У мастера нет добавленных фото работ</p>
                <?php endif ?>
            </div>
            <form class="form-work" action="/app/admin/tables/master/admin.work.add.php" method="POST" enctype="multipart/form-data">
                <h4>Добавить фото работы</h4>
                <input type="hidden" class="form-control" name="id" value="<?= $master->id ?>">
                <label for="image"> <input type="file" class="form-control" name="image" id="file"></label>
                <?php if (!empty($_SESSION["error-work"])) : ?>
                    <p class="error"><?= $_SESSION["error-work"] ?></p>
                <?php endif ?>
                <button name="addWork" type="submit" class="btn-type">Добавить</button>
            </form>
        </div>
    </div>
    <div class="delete-master">
    <a class="delete" href="/app/admin/tables/master/admin.master.delete.php?id=<?=$master->id?>">Удалить мастера</a></div>
</main>
<script src="/app/admin/assets/js/loadImg.js"></script>
<script src="/app/admin/assets/js/loadCert.js"></script>