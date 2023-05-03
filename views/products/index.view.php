<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";

?>
<main>
<section class="glav">
    <img src="/assets/img/index/hand.png" class="hand">
    <div class="text-glav">
        <img class="border-left" src="/assets/img/border-left.png">
        <h1 class="h1-index">"На ногтях"</h1><br>
        <p class="p-index-header">Будь красива до кончиков пальцев</p>
        <img class="border-right" src="/assets/img/border-right.png">
        <a class="a-glav" href="/app/tables/recording/recording.php">Записаться</a>
    </div>
    <img class="laki" src="/assets/img/index/laki.png">
</section>
<section class="index-interior">
    <div class="interior">
        <img class="interior-img int1" src="/assets/img/index/interior/1.jpg">
        <div class="interior-text">
            <p class="about-text">Мы создаем красоту, предоставляя качественные услуги в уютной обстанвке по комфортным ценам. Успех нашего салона основан на доверии, честности и гармонии в команде.
            </p>
        </div>
        <img class="interior-img int2" src="/assets/img/index/interior/2.jpg">
        <img class="interior-img int3" src="/assets/img/index/interior/3.jpg">
        <img class="interior-img int4" src="/assets/img/index/interior/4.jpg">
        <img class="interior-img int5" src="/assets/img/index/interior/1.jpg">
    </div>
</section>
<section class="index-plus">
    <div class="index-plus-list">
        <ul class="index-list-ul">
            <li class="index-list-li">
                <p class="index-p">Комфортное обслуживание</p>
            </li>
            <hr class="hr-plus">
            <li class="index-list-li">
                <p class="index-p">Работаем только на новых и качественных материалах</p>
            </li>
            <hr class="hr-plus">
            <li class="index-list-li">
                <p class="index-p">Гарантия безопасности - все инструменты проходят качественную стерилизацию</p>
            </li>
            <hr class="hr-plus">
            <li class="index-list-li">
                <p class="index-p">Носка без сколов до 4-х недель</p>
            </li>
        </ul>
    </div>
    <div class="index-plus-div2">
        <div class="index-plus-photo">
            <img class="plus-palochki" src="/assets/img/index/palochki.jpg">
            <div class="index-plus-background"></div>
            <img class="img-plus-circle" src="/assets/img/index/circle.jpg">
        </div>
    </div>
</section>

<section class="index-contacts">
    <div class="contacts-photo">
        <div class="contacts-div1">
            <img class="contacts-img" src="/assets/img/index/contacts/1.jpg">
            <div class="contacts-text">
            <p>Мир в твоих в твоих руках</p>
            </div>
        </div>
        <div class="contacts-div2">
            <div class="contacts-text">
                <p>Записаться прямо сейчас</p>
            </div>
            <img class="contacts-img" src="/assets/img/index/contacts/2.jpg">

        </div>
    </div>
    <div class="cart" style="position:relative;overflow:hidden;">
        <a href="https://yandex.ru/maps/org/na_nogtyakh/113021961315/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">На ногтях</a><a href="https://yandex.ru/maps/56/chelyabinsk/category/nail_salon/20476284572/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Ногтевая студия в Челябинске</a><a href="https://yandex.ru/maps/56/chelyabinsk/category/sugaring/111105474159/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:28px;">Шугаринг в Челябинске</a><iframe src="https://yandex.ru/map-widget/v1/?ll=61.408627%2C55.159652&mode=poi&poi%5Bpoint%5D=61.408840%2C55.159825&poi%5Buri%5D=ymapsbm1%3A%2F%2Forg%3Foid%3D113021961315&z=18.77" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
    </div>

</section>
</main>
<?php 
include $_SERVER["DOCUMENT_ROOT"]."/views/templates/footer.php";
?>