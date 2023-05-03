<?php
include $_SERVER["DOCUMENT_ROOT"] . "/app/admin/views/templates/admin.header.php";

?>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="/assets/css/modal.css">
<link rel="stylesheet" href="/assets/css/profile.css">
<link rel="stylesheet" href="\app\admin\assets\css\recording.css">

<div class="wrapper mt-5">
    <div class="main">
        <div class="container profile">
            <div class="row">
                <div class="col p-1">
                    <div class="profile-content bg-white p-4">
                        <div class="row mb-3">
                            <div class="col-4">
                                <div class="profile-header d-flex align-items-center">
                                    <h4 class="align-middle">Записи</h4>
                                </div>
                            </div>
                            <div class="col-4">
                                <select class="form-select" id="selectMaster">
                                    <option value="all" selected>Все</option>
                                    <?php foreach($masters as $master) :?>
                                    <option value="<?= $master->id ?>"><?= $master->name ?> <?= $master->surname ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>
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
                    <div class="mb-3">
                        <label for="reasonCancel" class="form-label">Для отмены записи укажите
                            причину</label>
                        <textarea class="form-control" id="textReasonCancel" rows="3"></textarea>
                    </div>
                    <div class="alert alert-danger" role="alert" id="modalDangerAlert">
                        Минимальная длина 8 символов
                    </div>

                    <button class="btn mt-3" data-bs-dismiss="modal" aria-label="Close">Вернуться назад</button>
                    <button class="btn mt-3" id="btnReasonCancel">Отменить</button>
                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/js/fetch.js"></script>
    <script src="/assets/js/recording.js"></script>
    <script src="/assets/js/admin/recording/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    </body>