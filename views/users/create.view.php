<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>
<div class="reg-container">
    <form class="reg-form" action="/app/tables/users/insert.php" method="POST">

        <h1>Регистрация</h1>

        <!-- фамилия -->
        <div class="mb-3">
            <label for="surnameInput" class="form-label">Введите фамилию</label>

            <input name="surname" type="text" class="form-control" id="nameInput" value="<?= $_SESSION['contacts']["surname"] ?? "" ?>">
            <p class="error"><?= $_SESSION["errors"]["surname"] ?? "" ?></p>
        </div>

        <!-- имя -->
        <div class="mb-3">
            <label for="nameInput" class="form-label">Введите имя</label>

            <input name="name" type="text" class="form-control" id="nameInput" value="<?= $_SESSION['contacts']["name"] ?? "" ?>">
            <p class="error"><?= $_SESSION["errors"]["name"] ?? "" ?></p>
        </div>

        <!-- почта -->
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Введите e-mail</label>

            <input name="email" value="<?= $_SESSION["contacts"]["email"] ?? "" ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <p class="error"><?= $_SESSION["errors"]["email"] ?? "" ?></p>
        </div>
        <div class="mb-3">
            <label for="exampleInputPhone" class="form-label">Введите номер телефона</label>

            <input name="phone" value="<?= $_SESSION["contacts"]["phone"] ?? "" ?>" type="phone" class="form-control" id="exampleInputPhone">
            <p class="error"><?= $_SESSION["errors"]["phone"] ?? "" ?></p>
        </div>


        <!-- пароли -->
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Введите пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Подтвердите пароль</label>
            <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2">
            <p class="error"><?= $_SESSION["errors"]["password"] ?? "" ?></p>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="agreement" type="checkbox" id="agreement" onclick="check();">
            <label class="form-check-label" for="agreement">
                Согласие на обработку персональных данных
            </label>
        </div>


        <br>
        <button name="btn" type="submit" id="btn" class=" btn-reg" disabled="">Зарегистрироваться</button>

        <script>
            function check() {
                var submit = document.getElementsByName('btn')[0];
                if (document.getElementById('agreement').checked)
                    submit.disabled = '';
                else
                    submit.disabled = 'disabled';
            }
        </script>
    </form>
</div>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
?>