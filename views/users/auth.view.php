<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>
<div class="auth-container">
  <form class="auth-form" action="/app/tables/users/auth.check.php" method="POST">
    <h1>Вход</h1>

    <div class="mb-3">
      <label for="exampleInputLogin" class="form-label">Введите e-mail</label>

      <input name="email" type="email" class="form-control" id="exampleInputEmail">
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword" class="form-label">Введите пароль</label>

      <input name="password" type="password" class="form-control" id="exampleInputPassword">
    </div>

    <?php if (!empty($_SESSION["error"])) : ?>
      <p class="error"><?= $_SESSION["error"] ?></p>
    <?php endif ?>

    <button name="authBtn" type="submit" class="btn-auth">Войти</button>
    <div class="auth-reg">
      <p>Если нет профиля - </p>
      <a  href="/app/tables/users/create.php">Зарегистрироваться</a>
    </div>
  </form>
</div>

<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
unset($_SESSION["error"]);
?>