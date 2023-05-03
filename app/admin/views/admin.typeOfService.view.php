<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";
?>
<main class="type">
  <div class="div-insertType">
    <form class="insertType-form" action="/app\admin/tables/typeOfService/admin.type.add.php" method="POST" enctype="multipart/form-data">
      <h1 class="h1-type">Добавить тип услуги</h1>
      <label for="exampleInputType" class="form-label">Введите название вида услуги</label>
      <input name="type" type="text" class="form-control" id="exampleInputType">

      <?php if (!empty($_SESSION["error"]["name"])) : ?>
        <p class="error"><?= $_SESSION["error"]["name"] ?></p>
      <?php endif ?>

      <label for="image" class="form-label">Введите картинку: </label>
      <input type="file" class="form-label" name="image">


      <?php if (!empty($_SESSION["error"]["file"])) : ?>
        <p class="error"><?= $_SESSION["error"]["file"] ?></p>
      <?php endif ?>

      <button name="addType" type="submit" class="btn-type">Добавить</button>
    </form>
  </div>
  <div class="div-table-type">
    <table class="table-type">
      <?php foreach ($typies as $type) : ?>
        <tr class="type-position">
          <td><?= $type->name ?></td>
          <td>
            <img class="img-type" src="/upload/typeOfServices\<?= $type->image ?>">
          </td>
          <td class="type-a type-green"><a href="/app/admin/tables/typeOfService/admin.type.show.php?id=<?= $type->id ?>" class="change">Изменить</a></td>
          <td><button class="delete" data-id="<?= $type->id ?>">Удалить</button></td>
          <td class="type-a"><a href="/app//admin/tables/service/admin.service.php?id=<?= $type->id ?>">Перейти</a>
        </tr>
      <?php endforeach ?>
    </table>
  </div>
</main>
<?php unset($_SESSION["error"]) ?>
<script src="/app/admin/assets/js/loadType.js"></script>