<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>




<form action="#" method="POST" class="col-6 justify-content-center mb-5 text-center">
    <div class="tab-header ">
        <div class="tab-header__item  active" data-target="tab-1" id="hed-tab-1">
            услуга
        </div>
        <div class="tab-header__item  btndate" id="hed-tab-2">
            мастер
        </div>
        <div class="tab-header__item  btndate" id="hed-tab-3">
            дата
        </div>
        <div class="tab-header__item  btndate" id="hed-tab-4">
            время
        </div>
        <div class="tab-header__item " id="hed-tab-5">
            финиш
        </div>
    </div>
    <div class="tab-body">
        <div class="tab-body__item active" id="tab-1">
            <h5>Выберите услугу:</h5>
            <div class="div-radio">
                <?php foreach ($typies as $type) : ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="<?= $type->id ?>"
                        value="<?= $type->id ?>">
                    <label class="form-check-label" for="<?= $type->id ?>">
                        <?= $type->name ?>
                    </label>
                </div>
                <?php endforeach ?>
            </div>
            <div class="container-service">

            </div>
            <div class="btn tab-header_btn btndate" data-target="tab-2">Дальше</div>
        </div>
        <div class="tab-body__item" id="tab-3">
            <h5>Выберите дату:</h5>
            <input type="text" class="form-control" name="date" id="datepicker" placeholder="" value="">
            <div class="btn tab-header_btn btndate" data-target="tab-2">Дальше</div>
        </div>


        <div class="tab-body__item" id="tab-1">
            <h5>проверка бронирования</h5>
            <h6 class="date"></h6>
            <h6 class="time"></h6>
            <h6 class="duration"></h6>
            <div class="btn tab-header_btn" data-target="tab-2">Назад</div>
            <button class="btn btnArrange" type="submit" name="arrange" id="book">ЗАБРОНИРОВАТЬ</button>
        </div>
    </div>
    <div class="tab-body__item" id="tab-">
        <p class="date">Дата: </p>
        <h5>Выберите время начала </h5>
        <?php foreach ($timeArr as $t) : ?>
        <input type="radio" class="form-control times" name="time" id="time-<?= $t ?>" value="<?= $t ?>"><label
            class="timeLabel btn mt-2 mb-2" for="time-<?= $t ?>"><?= $t ?></label>
        <?php endforeach ?>

        <input type="number" name="duration" class="form-control mt-3 mb-3" id="inputDuration"
            placeholder="Введите продолжительность" required>


        <div class="btn tab-header_btn" data-target="tab-1">Назад</div>
        <div class="btn tab-header_btn" data-target="tab-3">Дальше</div>
    </div>
</form>

<script src="/app/admin/assets/jquery/jquery-3.6.4.min.js"></script>
<script src="/app/admin/assets/jquery/jquery-ui.min.js"></script>
<script>
$.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: 'Предыдущий',
    nextText: 'Следующий',
    currentText: 'Сегодня',
    monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь',
        'Ноябрь', 'Декабрь'
    ],
    monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
    dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
    dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
    dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    weekHeader: 'Не',
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);

$(function() {
    var date = new Date();
    date.setDate(date.getDate());

    $("#datepicker").datepicker({
        minDate: date
    });

});
</script>
<script src="/assets/js/arrange.js"></script>
<script src="/assets/js/fetch.js"></script>

<script src="/assets/js/loadService.js"></script>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
?>