<?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/header.php";
?>

<link rel="stylesheet" href="/assets/css/stepper.css">
<link rel="stylesheet" href="/assets/css/recording.css">
<link rel="stylesheet" href="/assets/css/modal.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

<div class="wrapper">
    <div class="main">
        <div class="recording">
            <div class="recording-header d-flex justify-content-center mb-3">
                <div class="tab-status d-flex gap-3">
                    <span class="tab active">1</span>
                    <span class="tab">2</span>
                    <span class="tab">3</span>
                    <span class="tab">4</span>
                    <span class="tab">5</span>
                    <span class="tab">6</span>
                </div>
            </div>
            <div role="tab-list">
                <div role="tabpanel" id="color" class="tabpanel">
                    <div class="form__title d-flex justify-content-center mt-4 mb-2">
                        <h3>Выберите тип услуги</h3>
                    </div>
                    <div class="cards-container overflow-auto p-3" id="serviceTypes">
                        <div class="card card-placeholder mb-3 cursor-pointer" aria-hidden="true">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <div class="card-image-placeholder"></div>
                                </div>
                                <div class="col-md-8 d-flex align-items-center justify-content-center">
                                    <div class="card-body">
                                        <h5 class="placeholder-glow">
                                            <span class="placeholder col-6"></span>
                                        </h5>
                                        <p class="card-text placeholder-glow">
                                            <span class="placeholder col-7"></span>
                                            <span class="placeholder col-4"></span>
                                            <span class="placeholder col-4"></span>
                                            <span class="placeholder col-6"></span>
                                            <span class="placeholder col-8"></span>
                                        </p>
                                    </div>
                                    <button class="btn card-btn placeholder col-6 me-3"></button>
                                </div>
                            </div>
                        </div>

                        <div class="card card-placeholder mb-3 cursor-pointer" aria-hidden="true">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <div class="card-image-placeholder"></div>
                                </div>
                                <div class="col-md-8 d-flex align-items-center justify-content-center">
                                    <div class="card-body">
                                        <h5 class="placeholder-glow">
                                            <span class="placeholder col-6"></span>
                                        </h5>
                                        <p class="card-text placeholder-glow">
                                            <span class="placeholder col-7"></span>
                                            <span class="placeholder col-4"></span>
                                            <span class="placeholder col-4"></span>
                                            <span class="placeholder col-6"></span>
                                            <span class="placeholder col-8"></span>
                                        </p>
                                    </div>
                                    <button class="btn card-btn placeholder col-6 me-3"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role=" tabpanel" id="hobbies" class="tabpanel hidden">
                    <div class="form__title d-flex justify-content-center mt-4 mb-2">
                        <h3>Выберите услугу</h3>
                    </div>
                    <div class="cards-container overflow-auto p-3" id="services">

                    </div>
                </div>
                <div role="tabpanel" id="occupation" class="tabpanel hidden">
                    <div class="form__title d-flex justify-content-center mt-4 mb-2">
                        <h3>Выберите мастера</h3>
                    </div>
                    <div class="cards-container overflow-auto p-3" id="masters">

                    </div>
                </div>
                <div role="tabpanel" id="occupation" class="tabpanel hidden">
                    <div class="form__title d-flex justify-content-center mt-4 mb-2">
                        <h3>Выберите дату</h3>
                    </div>
                    <div class="cards-container overflow-auto p-3" id="dates">

                    </div>
                </div>
                <div role="tabpanel" id="occupation" class="tabpanel hidden">
                    <div class="form__title d-flex justify-content-center mt-4 mb-2">
                        <h3>Выберите время</h3>
                    </div>
                    <div class="cards-container overflow-auto p-3" id="times">

                    </div>
                </div>
                <div role="tabpanel" id="occupation" class="tabpanel hidden">
                    <div class="form__title d-flex justify-content-center mt-4 mb-2">
                        <h3>Подтверждение</h3>
                    </div>
                    <div class="cards-container overflow-auto p-3" id="recordConfirmation">
                        <div class="modal-body d-flex flex-column gap-2">
                            <div class="card mb-3 cursor-pointer card-service border-0">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        <div class="service-img">
                                            <img src="#" class="card-img service-img rounded-start" alt="master"
                                                id="masterImage">
                                        </div>
                                    </div>
                                    <div class="col-md-9 d-flex align-items-center">
                                        <div class="card-body d-flex align-items-center justify-content-between">
                                            <div class="card-header ms-2">
                                                <p class="card-text" id="masterPosition"></p>
                                                <h5 class="card-title" id="masterName"></h5>
                                            </div>
                                            <button class="btn card-btn" disabled>Ваш мастер</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover mt-2">
                                <thead>
                                    <tr>
                                        <th>Тип услуги</th>
                                        <th>Услуга</th>
                                        <th class="text-center">Продолжительность</th>
                                        <th>Ставка мастера</th>
                                        <th>Стоимость услуги</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="typeService"></td>
                                        <td id="service"></td>
                                        <td class="text-center" id="duration"></td>
                                        <td class="text-center" id="markup"></td>
                                        <td class="text-center" id="price"></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="modal-footer d-flex justify-content-between align-items-end">
                                <p class="card-text">
                                    <small class="text-muted">После записи через пару минут с вами
                                        свяжется наш менеджер!
                                    </small>
                                </p>
                                <h3 class="totalPrice mt-3" id="totalPrice">Итого: 1200 р</h3>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination">
                <button class="btn hidden" id="prev">Назад</button>
                <button class="btn" id="confirmRecord" data-bs-toggle="modal"
                    data-bs-target="#signUpModal">Записаться</button>
            </div>
        </div>
        <div id="signUpModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content gap-2">
                    <div class="modal-header justify-content-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                    </div>
                    <div class="modal-body text-center">
                        <h4>Успешная запись!</h4>
                        <p>В течении пары минут с вами свяжется наш менеджер</p>
                        <button class="btn mt-3" data-dismiss="modal"><span><a href="/app/tables/users/profile.php">Перейти к моим записям</a></span> <i
                                class="material-icons ms-3">&#xE5C8;</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/fetch.js"></script>
    <script src="/assets/js/stepper.js"></script>
    <script src="/assets/js/service.js"></script>
    <script src="/assets/js/master.js"></script>
    <script src="/assets/js/shedule.js"></script>
    <script src="/assets/js/recording.js"></script>
    <script src="/assets/js/recording/script.js"></script>

    <?php
include $_SERVER["DOCUMENT_ROOT"] . "/views/templates/footer.php";
?>