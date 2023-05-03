<?php
include $_SERVER["DOCUMENT_ROOT"]."/views/templates/header.php";
if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
    header("Location: /app/tables/users/auth.php");
    die();
}
 ?>


<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/assets/css/modal.css">
<link rel="stylesheet" href="/assets/css/profile.css">


<div class="wrapper mt-5">
    <div class="main">
        <div class="container profile">
            <div class="row">
                <div class="col-md-3 col-sm-12 p-1">
                    <div class="profile-content bg-white p-4">
                        <div class="row mb-3">
                            <div class="col profile-user d-flex flex-column gap-2 align-items-center">
                                <img class="card-img" src="/assets/img/profile/user.png" alt="user">
                                <span><?= $user->name ?> <?= $user->surname ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-center active py-3">
                                        <a href="#">Мои записи</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 p-1">
                    <div class="profile-content bg-white p-4">
                        <div class="row mb-3">
                            <div class="col-8">
                                <div class="profile-header d-flex align-items-center">
                                    <h4 class="align-middle">Мои записи</h4>
                                </div>
                            </div>
                            <div class="col-4">
                                <select class="form-select" id="selectStatus">
                                    <?php foreach($statuses as $status) :?>
                                    <option value="<?= $status->id ?>"><?= $status->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table class="table w-100">
                                    <thead>
                                        <th class="text-center">Дата</th>
                                        <th class="text-center">Время</th>
                                        <th class="text-center">Услуга</th>
                                        <th class="text-center">Мастер</th>
                                        <th class="text-center">Стоимость</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="recordings">
                                        <tr class="placeholder-glow">
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td>
                                                <div
                                                    class="card-time d-flex align-items-center gap-2 mx-auto isPlanned">
                                                    <div class="card-time__title placeholder col">
                                                    </div>
                                                    <div>
                                                        <i class="fa-regular fa-clock"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-6"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder btn-cancel-placeholder"></span>
                                            </td>
                                        </tr>
                                        <tr class="placeholder-glow">
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td>
                                                <div
                                                    class="card-time d-flex align-items-center gap-2 mx-auto isPlanned">
                                                    <div class="card-time__title placeholder col">
                                                    </div>
                                                    <div>
                                                        <i class="fa-regular fa-clock"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-6"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder btn-cancel-placeholder"></span>
                                            </td>
                                        </tr>
                                        <tr class="placeholder-glow">
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td>
                                                <div
                                                    class="card-time d-flex align-items-center gap-2 mx-auto isPlanned">
                                                    <div class="card-time__title placeholder col">
                                                    </div>
                                                    <div>
                                                        <i class="fa-regular fa-clock"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-6"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder btn-cancel-placeholder"></span>
                                            </td>
                                        </tr>
                                        <tr class="placeholder-glow">
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td>
                                                <div
                                                    class="card-time d-flex align-items-center gap-2 mx-auto isPlanned">
                                                    <div class="card-time__title placeholder col">
                                                    </div>
                                                    <div>
                                                        <i class="fa-regular fa-clock"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-6"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder btn-cancel-placeholder"></span>
                                            </td>
                                        </tr>
                                        <tr class="placeholder-glow">
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td>
                                                <div
                                                    class="card-time d-flex align-items-center gap-2 mx-auto isPlanned">
                                                    <div class="card-time__title placeholder col">
                                                    </div>
                                                    <div>
                                                        <i class="fa-regular fa-clock"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-6"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder btn-cancel-placeholder"></span>
                                            </td>
                                        </tr>
                                        <tr class="placeholder-glow">
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td>
                                                <div
                                                    class="card-time d-flex align-items-center gap-2 mx-auto isPlanned">
                                                    <div class="card-time__title placeholder col">
                                                    </div>
                                                    <div>
                                                        <i class="fa-regular fa-clock"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-8"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder col-6"></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="placeholder btn-cancel-placeholder"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-warning" role="alert" id="warningAlert">
                                    Записей не найдено
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="signUpModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content gap-2">
                <div class="modal-header justify-content-center">
                    <div class="icon-box">
                        <i class="material-icons">&#xE615;</i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <h4>Отменить запись?</h4>
                    <p>Для отмены записи вы можете связаться с менеджером по телефону +7 (999)-999-7777</p>
                    <button class="btn mt-3" data-bs-dismiss="modal" aria-label="Close">Вернуться назад</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/fetch.js"></script>
    <script src="/assets/js/recording.js"></script>
    <script src="/assets/js/profile/script.js"></script>


    <?php
include $_SERVER["DOCUMENT_ROOT"]."/views/templates/footer.php";
?>