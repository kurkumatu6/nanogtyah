<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>
<main class="main-master">
    <div>
    <?php foreach ($masters as $master) : ?>

        <div class="div-master-container">
            <div class="div-master-img">
                <img class="img-master" src="/upload/masters/<?= $master->photo ?>">
            </div>

            <div class="div-master-info">
                <h1><?= $master->position ?></h1>
                <p class="p-fio"><?= $master->surname ?> <?= $master->name ?></p>
                <hr>
                <p class="p-master-info"><?= $master->info ?></p>
                <hr>
                <a class="a-master-show" href="/app/tables/products/master.show.php?id=<?= $master->id ?>">Подробнее...</a>

            </div>
        </div>
    <?php endforeach ?></div>
</main>

<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
?>