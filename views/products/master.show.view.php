<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>
<main class="main-master-show">
    <div class="show-fio">
        <h1><?= $master->surname ?> <?= $master->name ?></h1>
        <p><?= $master->position ?></p>
    </div>
    <div class="glav-master-info">
        <div class="master-circle"><img src="/upload/masters/<?= $master->photo ?>"></div>
        <div class="show-master-info">
            <p><?= $master->info ?></p>
        </div>
    </div>

    <div class="glav-master-works">

        <div class="work-info">
            <h1>Работы мастера</h1><br>
            <p> Свою работу мастера выполняют на все 100%.
                Вы сами сможете убедиться в качестве наших услуг, записавшись. Мы уверены, вы будете довольны своими ноготками!</p>
            <a class="a-glav adap-a-glav" href="/app/tables/recording/recording.php">Записаться</a>
        </div>
        <div class="work-carousel">
            <div id="carouselExampleAutoplaying" class="carousel slide " data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($works as $key => $work) : ?>
                        <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>" data-bs-interval="2000">
                            <img src="/upload/works/<?= $work->image ?>" class="d-block w-100" alt="...">
                        </div>
                    <?php endforeach ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="glav-master-certificates">

        <div class="container-img-certificates">
            <?php foreach ($certificates as $certificate) : ?>
                <img src="/upload/certificates/<?= $certificate->image ?>">
            <?php endforeach ?>
        </div>
        <div class="div-cert-info">
            <h1>Сертификаты мастера</h1>
            <p>Чтобы ваши ноготки всегда были прекрасны, наши мастера постоянно повышают свою квалификацию, проходят различные курсы. Здесь представлены недавно прошедшие курсы.</p>
            <ul>
                <?php foreach ($certificates as $certificate) : ?>
                    <li><?= $certificate->name ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</main>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
?>