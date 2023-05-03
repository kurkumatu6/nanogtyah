<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>

<h1>Выберите дату и время</h1>
<form action="" method="POST">
<?php foreach ($dates as $date) : ?>
    <div class="form-check">
        <input class="form-check-input dateId" type="radio" name="dateId" id="<?= $date->id ?>" value="<?= $date->id?>">
        <label class="form-check-label" for="<?= $date->id ?>">
            <?= date_create($date->date )->format('d.m.Y')?>
        </label>
    </div>
    <?php endforeach ?>
    <?php foreach ($timeArr as $t) : ?>
                        <input type="radio" class="form-control times" name="time" id="time-<?= $t ?>" value="<?= $t ?>"><label class="timeLabel btn mt-2 mb-2" for="time-<?= $t ?>"><?= $t ?></label>
                    <?php endforeach ?>

</form>
<script src="/assets/js/fetch.js"></script>
<script src="/assets/js/arrange.js"></script>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
?>