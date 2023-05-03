
<?php

use app\models\Services;
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>
<main class="main-price">
<div class="h1-heading">
    <h1>Прайс на услуги</h1>
</div>
<div class="category-container">
    <?php foreach ($categories as $category) : ?>
        <div class="category-card">
            <?php if (($category->id) % 2 == 0) : ?>
                <img class="category-card-img" src="/upload/typeOfServices/<?= $category->image ?>">
                <div class="category-card-text">
                    <a href="/app/tables/products/price.php?idCategory=<?= $category->id ?>"><?= $category->name ?></a>
                </div>
            <?php else : ?>
                <div class="category-card-text">
                    <a href="/app/tables/products/price.php?idCategory=<?= $category->id ?>"><?= $category->name ?></a>
                </div>
                <img class="category-card-img" src="/upload/typeOfServices/<?= $category->image ?>">
            <?php endif ?>
        </div>
    <?php endforeach ?>
</div>
<h1 class="h1-name-price"><?= $typeName->name ?></h1>
<div class="container-table">
    
    <table class="table-price">
        <th class="th-price-service th-price">Услуги</th>
        <?php foreach ($positions as $position) : ?>
            <th class="th-price"><?= $position->name ?></th>
        <?php endforeach ?>
        
        <?php foreach ($services as $service) :?>
            <tr class="tr-price">
                <td class="td-price">
                    <p class="name-price"><?=$service->name?></p>
                    <p class="description-price"><?= $service->description?></p>
                    
                </td>
                <?php foreach ($positions as $position):?>
                    <?php if(($service->markupOption)==1) :?>
                        
                        <td class="td-price"><?=
                        $service->price?> руб.</td>
                    <?php else : ?>
                    <td class="td-price"><?=
                        Services::finalCost($service->id, $position->id)?> p.</td>
                    <?php endif?>
                <?php endforeach?>
            </tr>
        <?php endforeach?>
    </table>
</div>
</main>


<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
?>
<script src="/assets/js/fetch.js"></script>