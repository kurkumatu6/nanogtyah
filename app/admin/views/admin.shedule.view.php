<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<main class="shedule-main">
    <div>
        <div class="date-master">
            <label for="datepicker">Выберете дату</label>
            <input type="text" name="date" id="datepicker">
        </div>

        <!-- <form action="">

</form> -->
        <div class="mastersBlock">
            <?php foreach ($masters as $master) : ?>
                <!-- <div>
        <input type="checkbox" name="masters" id="master<?= $master->id ?>">
            <label for="master<?= $master->id ?>"><?= $master->name ?> <?= $master->surname ?></label>
            <div class="div-time">
                <label for="">Время начала работы</label>
                <input type="time" name="" id="timeStart<?= $master->id ?>" disabled>
            </div>
            <div class="div-time">
                <label for="">Время конца работы</label>
                <input type="time" name="" id="timeEnd<?= $master->id ?>" disabled>
            </div>
        </div> -->
            <?php endforeach ?>

        </div>
    </div>
    <button class="addShedule">Сохранить расписания</button>
    <div class="showSheduleBlock">
        <div class="week-hidden">
            <button class="back"><</button>
                    <h2 class="week"></h2>
                    <button class="next">></button>
        </div>
        <table class="showSheduleTable">
            <tr class="days">
                <td></td>
            </tr>
        </table>
    </div>
</main>


<script src="/app/admin/assets/js/shudle.js"></script>
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
        }).on("change", function(e) {
            postJSON("/app/admin/tables/shedule/admin.shedule.js.loader.php", "", "getMasters").then(function(value) {
                let block = document.querySelector(".mastersBlock")
                block.innerHTML = ''
                value.shedule.forEach(element => {
                    block.insertAdjacentHTML("beforeend", `
                <div class="masterBlock${element.id}">
                    <input type="checkbox" name="masters" class="masters" data-id="${element.id}" id="master${element.id}">
                    <label for="master${element.id}">${element.name}${element.surname}</label>
                </div>
                `)
                    console.log({
                        "date": e.target.value,
                        "master_id": element.id
                    })
                    postJSON("/app/admin/tables/shedule/admin.shedule.js.loader.php", {
                        "date": e.target.value,
                        "master_id": element.id
                    }, "getMastersRecording").then(function(value) {
                        let masterBlock = document.querySelector(`.masterBlock${element.id}`)
                        if (value.shedule.length > 0) {
                            document.querySelector(`#master${element.id}`).setAttribute("disabled", "disabled")
                            masterBlock.insertAdjacentHTML("beforeend", "<h6>Изменить расписание данного мастера невозможно т.к у него есть 'новые' записи в этот день</h6>")
                        } else {
                            postJSON("/app/admin/tables/shedule/admin.shedule.js.loader.php", {
                                "date": e.target.value,
                                "master_id": element.id
                            }, "getMastersShudleForStaar").then(function(value) {
                                console.log(value)
                                if (value.shedule.startWork != null && value.shedule.endWork != null) {
                                    masterBlock.insertAdjacentHTML("beforeend", `
                                <div>
                                    <label for="">Время начала работы</label>
                                    <input type="time" name="" id="timeStart${element.id}" value="${value.shedule.startWork}" disabled>
                                </div>
                                <div>
                                    <label for="">Время конца работы</label>
                                    <input type="time" name="" id="timeEnd${element.id}" value="${value.shedule.endWork}" disabled>
                                </div>
                                `)
                                } else {

                                    masterBlock.insertAdjacentHTML("beforeend", `
                                <div>
                                    <label for="">Время начала работы</label>
                                    <input type="time" name="" id="timeStart${element.id}"  disabled>
                                </div>
                                <div>
                                    <label for="">Время конца работы</label>
                                    <input type="time" name="" id="timeEnd${element.id}"  disabled>
                                </div>
                                `)
                                }
                            })
                        }

                    });

                });
            })
            // postJSON("/app/admin/tables/shedule/admin.shedule.js.loader.php", e.target.value, "getMastersByDate").then(function(value){
            //     let block =document.querySelector(".mastersBlock")
            //     block.innerHTML = ''
            //     value.shedule.forEach(element => {
            //         block.insertAdjacentHTML("beforeend", `
            //         <div class="masterBlock">
            // <input type="checkbox" name="masters" class="masters" data-id="${element.id}" id="master${element.id}">
            //     <label for="master${element.id}">${element.name}${element.surname}</label>
            //     <div>
            //         <label for="">Время начала работы</label>
            //         <input type="time" name="" id="timeStart${element.id}" disabled>
            //     </div>
            //     <div>
            //         <label for="">Время конца работы</label>
            //         <input type="time" name="" id="timeEnd${element.id}" disabled>
            //     </div>
            // </div>


            //         `)
            //     });
            // })
        })

    });
</script>