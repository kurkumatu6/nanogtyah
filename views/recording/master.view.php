<?php

use app\models\Services;

include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>

<form action="/app/tables/recording/dateTime.php" method="POST">
<input type="hidden" class="form-control" name="service_id" value="<?= $idService ?>">
<input type="hidden" class="form-control" name="typeOfService_id" value="<?= $idType?>">
    <h1>Выберите мастера</h1>

    <?php foreach($masters as $master) :?>
        <div class="form-check">
                        <input class="form-check-input master" type="radio" name="master" id="<?= $master->id ?>" value="<?= $master->id ?>" onclick="check();">
                        <label class="form-check-label" for="<?= $master->id ?>">
                            <?= $master->name ?> - <?= Services::finalCost($idService,$master->position_id)?> р.
                        </label>
                    </div>
                    
<?php endforeach?>
<a href="/app/tables/recording/recording.php">Назад</a>
                    <button disabled  name="nextBtn">Дальше</button>
</form>
<script>
            function check() {
                var submit = document.getElementsByName('nextBtn')[0];
                if (document.querySelector('.master:checked') != null)
                    submit.disabled = false;
                else
                    submit.disabled = true;
            }

        </script>

<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
?>