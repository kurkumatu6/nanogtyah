let serviceTypesContainer = document.getElementById('serviceTypes');
let servicesContainer = document.getElementById('services');
let mastersContainer = document.getElementById('masters');
let datesContainer = document.getElementById('dates');
let timesContainer = document.getElementById('times');
let recordConfirmationContainer = document.getElementById('recordConfirmation');

let typeServiceLabel = document.getElementById('typeService');
let serviceLabel = document.getElementById('service');
let durationLabel = document.getElementById('duration');
let markupLabel = document.getElementById('markup');
let priceLabel = document.getElementById('price');
let totalPriceLabel = document.getElementById('totalPrice');
let masterPositionLabel = document.getElementById('masterPosition');
let masterNameLabel = document.getElementById('masterName');
let masterImageElement = document.getElementById('masterImage');

const confirmRecordButton = document.querySelector('#confirmRecord');
confirmRecordButton.style.display = 'none';

let currentTypeServiceId = 1;
let currentMasterId = 1;

let serviceTypes = [];
let services = [];
let masters = [];
let dates = [];
let times = [];

let selectedTypeService = {};
let selectedService = {};
let selectedMaster = {};
let selectedDate = {};
let selectedTime = {};
let totalPrice = 0;

(async () => {
    serviceTypes = await getServiceTypes();

    createCards(serviceTypes, serviceTypesContainer, cardTypeServiceTemplate);
})();

async function selectTypeService(typeServiceId) {
    currentTypeServiceId = typeServiceId;
    selectedTypeService = serviceTypes.find((item) => item.id == typeServiceId);

    console.log(selectedTypeService);

    services = await getServicesByType(currentTypeServiceId);

    nextStep();
    createCards(services, servicesContainer, cardServiceTemplate);
}

async function selectService(serviceId) {
    selectedService = services.find((item) => item.id == serviceId);

    masters = await getMastersByTypeService(currentTypeServiceId);

    nextStep();
    createCards(masters, mastersContainer, cardMasterTemplate);
}

async function selectMaster(masterId) {
    dates = await getMasterShedule(masterId);

    currentMasterId = masterId;

    selectedMaster = masters.find((item) => item.id == masterId);

    nextStep();
    createCards(dates, datesContainer, cardDateTemplate);
}

function getParseDate(date, time) {
    time = time.split(':');
    console.log(time);
    console.log(date.split('-'));
    return new Date(...date.split('-'), ...time);
}

async function selectDate(date) {
    let schedule = await getTimeByMaster(currentMasterId, date);
    let scheduleBusy = await getBusyTimeByMaster(currentMasterId, date);

    console.log(`DATE:: ${date}`);
    let startWorkDate = getParseDate(date, schedule.startWork);
    startWorkDate.setMonth(startWorkDate.getMonth() - 1);
    console.log(`PARSE DATE:: ${startWorkDate}`);

    let endWorkDate = getParseDate(date, schedule.endWork);

    selectedDate = startWorkDate;

    let newSchedule = [];

    for (let hours = startWorkDate.getHours(); hours < endWorkDate.getHours(); hours++) {
        let serviceDuration = 0;

        newSchedule.push({
            timeWork: startWorkDate,
            isBusy: Boolean(
                scheduleBusy.find((item) => {
                    let startRecordingDate = new Date(item.startRecording);
                    startRecordingDate.setMinutes(
                        startRecordingDate.getMinutes() + -startRecordingDate.getTimezoneOffset(),
                    );
                    if (startRecordingDate.getTime() == startWorkDate.getTime()) {
                        serviceDuration = item.duration;

                        if (selectedService.duration != serviceDuration) {
                            hours += serviceDuration;
                        }

                        return true;
                    }
                    return false;
                }),
            ),
            serviceDuration,
        });

        startWorkDate = new Date(
            startWorkDate.getFullYear(),
            startWorkDate.getMonth(),
            startWorkDate.getDate(),
            startWorkDate.getHours(),
            startWorkDate.getMinutes() + 60 * selectedService.duration,
            startWorkDate.getSeconds(),
        );

        serviceDuration = 0;

        if (startWorkDate.getHours() >= endWorkDate.getHours()) {
            break;
        }
    }

    console.log(newSchedule);
    createCardsTime(newSchedule, timesContainer, cardTimeTemplate);
    nextStep();
}

function getTimeZoneOffset(date) {
    return Math.abs(date.getTimezoneOffset());
}

function createCards(data, container, cardTemplate) {
    container.innerHTML = '';

    data.forEach((item) => {
        container.insertAdjacentHTML('afterBegin', cardTemplate(item));
    });
}

function cardTypeServiceTemplate({ id, name, image }) {
    return `
        <div class="card mb-3 cursor-pointer card-service" data-serviceId="<?= $typeService->id ?>">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="service-img">
                        <img src="/upload/typeOfServices/${image}"
                            class="img service-img rounded-start" alt="${name}">
                    </div>
                </div>
                <div class="col-md-8 d-flex align-items-center">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <h5 class="card-title">${name}</h5>
                            <button class="btn card-btn"
                                onclick="selectTypeService(${id})">Выбрать</button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function cardServiceTemplate({ id, name, price, duration }) {
    return `
    <div class="card mb-3 cursor-pointer card-service">
        <div class="row g-0">
            <div class="col-md-12 d-flex align-items-center">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-header border-0">
                        <h5 class="card-title">${name}</h5>
                        <p class="card-text">${price} Р / ${duration} ч.</p>
                    </div>
                    <button class="btn card-btn"
                        onclick="selectService(${id})">Выбрать</button>
                </div>
            </div>
        </div>
    </div>
    `;
}

function cardMasterTemplate({ id, name, surname, photo, position_name, markup }) {
    return `
    <div class="card mb-3 cursor-pointer card-service">
        <div class="row g-0">
            <div class="col-md-4">
                <div class="service-img">
                    <img src="/upload/masters/${photo}"
                        class="img service-img rounded-start" alt="master">
                </div>
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-content d-flex flex-column gap-2">
                        <div class="card-header">
                            <p class="card-text">${position_name}</p>
                            <h5 class="card-title">${name} ${surname}</h5>
                        </div>
                        <p class="card-text"><small class="text-muted">Ставка мастера ${markup} р</small></p>
                    </div>
                    <button class="btn card-btn"
                        onclick="selectMaster(${id})">Выбрать</button>
                </div>
            </div>
        </div>
    </div>
    `;
}

function cardDateTemplate({ date }) {
    return `
    <div class="card mb-3 cursor-pointer card-service">
        <div class="row g-0">
            <div class="col-md-12 d-flex align-items-center">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <h5 class="card-title">${getParseStringDate(date).toLocaleDateString()}</h5>
                    <button class="btn card-btn"
                        onclick="selectDate('${date}')">Выбрать</button>
                </div>
            </div>
        </div>
    </div>
    `;
}

function cardTimeTemplate({ timeWork, isBusy }) {
    return `
    <div class="card mb-3 cursor-pointer card-service">
        <div class="row g-0">
            <div class="col-md-12 d-flex align-items-center">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="card-time d-flex align-items-center gap-2 ${
                        isBusy ? 'isBusy' : 'isFree'
                    }">
                        <div class="card-time__title">${timeWork.getHours()}:${
        timeWork.getMinutes() ? timeWork.getMinutes() : '00'
    }</div>
                        <div><i class="fa-regular fa-clock"></i></div>
                    </div>
                    <button class="btn card-btn" ${
                        isBusy ? 'disabled' : 'onClick="selectTime(this)"'
                    } data-timework='${timeWork}'>
                        ${isBusy ? 'Занято' : 'Выбрать'}
                    </button>
                </div>
            </div>
        </div>
    </div>
    `;
}

function createCardsTime(schedule, container, cardTemplate) {
    container.innerHTML = '';

    schedule.forEach((data) => {
        container.insertAdjacentHTML('beforeEnd', cardTemplate(data));
    });
}

function getDateFromHours(time) {
    time = time.split(':');
    let now = new Date();

    return new Date(now.getFullYear(), now.getMonth(), now.getDate(), ...time);
}

function getParseStringDate(date) {
    return new Date(date);
}

function selectTime(e) {
    currentTime = new Date(e.dataset.timework);

    masterImageElement.src = `/upload/masters/${selectedMaster.photo}`;

    selectedDate.setTime(currentTime.getTime());

    calculatePriceRecording();
    nextStep();
}

function calculatePriceRecording() {
    typeServiceLabel.textContent = selectedTypeService.name;
    serviceLabel.textContent = selectedService.name;
    durationLabel.textContent = `${selectedService.duration} ч`;
    markupLabel.textContent = `${selectedMaster.markup} р`;
    priceLabel.textContent = `${selectedService.price} р`;

    masterNameLabel.textContent = `${selectedMaster.name} ${selectedMaster.surname}`;
    masterPositionLabel.textContent = `${selectedMaster.position_name}`;

    totalPrice = +selectedMaster.markup + +selectedService.price;

    totalPriceLabel.textContent = `Итого: ${totalPrice} р`;
}

confirmRecordButton.addEventListener('click', confirmRecord);

async function confirmRecord() {
    await signUp(selectedDate, totalPrice, selectedMaster.id, selectedService.id, 1);
}
