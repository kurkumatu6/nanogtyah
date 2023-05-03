<?php
include $_SERVER["DOCUMENT_ROOT"]."/app/admin/views/templates/admin.header.php";
?>
<div class="div-auth">
<form class="admin-auth" action="/app/admin/tables/admin.auth.check.php" method="POST">
<h1>Вход</h1>

  <div class="mb-3">
    <label for="exampleInputEmail" class="form-label">Введите логин</label>

    <input name="email" type="email" class="form-control" id="exampleInputEmail">
  </div>
  
  <div class="mb-3">
    <label for="exampleInputPassword" class="form-label">Введите пароль</label>

    <input name ="password" type="password" class="form-control" id="exampleInputPassword">
  </div>

  <?php if (!empty($_SESSION["error"])) : ?>
        <p class="error"><?= $_SESSION["error"]["admin-auth"] ?></p>
    <?php endif ?>
  <button name ="authBtn" type="submit" class="btn-auth">Войти</button>
</form>
</div>
<?php unset($_SESSION["error"]);?>