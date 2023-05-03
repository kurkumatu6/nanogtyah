const selectStatusElement = document.getElementById('selectStatus');
const selectMasterElement = document.getElementById('selectMaster');
const recordingsContainer = document.getElementById('recordings');
const warningAlert = document.getElementById('warningAlert');
const btnReasonCancel = document.getElementById('btnReasonCancel');
const textReasonCancel = document.getElementById('textReasonCancel');
const modalDangerAlert = document.getElementById('modalDangerAlert');

warningAlert.style.display = 'none';
modalDangerAlert.style.display = 'none';

let currentStatusId = 1;
let currentMasterId = 'all';
let recordings = [];
let currentRecordingId = '';

const statusClassNames = ['isPlanned', 'isDone', 'isCancel'];

(async () => {
    recordings = await getAllRecordings(currentStatusId, currentMasterId);

    if (recordings.length) {
        createCards(recordings, recordingsContainer, cardTimeTemplate);
    } else {
        warningAlert.style.display = 'block';
    }
})();

function createCards(data, container, cardTemplate) {
    container.innerHTML = '';

    data.forEach((item) => {
        container.insertAdjacentHTML('afterBegin', cardTemplate(item));
    });
}

function getParseDate(date) {
    return new Date(date);
}

function getTimeZoneOffset(date) {
    return Math.abs(date.getTimezoneOffset());
}

function cardTimeTemplate({
    id,
    startRecording,
    status_id,
    status_name,
    master_surname,
    master_name,
    finalCost,
    service_name,
}) {
    let startRecordingDate = getParseDate(startRecording);

    return `
    <tr>
        <td class="text-center align-middle">
            ${startRecordingDate.toLocaleDateString()}
        </td>
        <td class="text-center align-middle">
            <div class="card-time d-flex align-items-center gap-2 mx-auto ${
                statusClassNames[status_id - 1]
            }">
                <div class="card-time__title">${
                    startRecordingDate.getHours() + getTimeZoneOffset(startRecordingDate) / 60
                }:${startRecordingDate.getMinutes() ? startRecordingDate.getMinutes() : '00'}
                </div>
                <div>
                    <i class="fa-regular fa-clock"></i>
                </div>
            </div>
        </td>
        <td class="text-center align-middle">
            ${service_name}
        </td>
        <td class="text-center align-middle">
            ${master_name} ${master_surname}
        </td>
        <td class="text-center align-middle">
            ${finalCost} р
        </td>
        <td class="text-center align-middle">
        <div class="d-flex align-items-center justify-content-around">
            ${
                status_id == 1
                    ? `
                    <button class="btn card-btn btn-make d-flex align-items-center gap-2" onClick="doneRecording(${id})">
                            <i class="fa-regular fa-calendar-check"></i>
                            <span>Выполнить</span>
                    </button>
                    <button class="btn card-btn btn-cancel d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#signUpModal" onClick="selectRecordingForCancel(${id})">
                            <i class="fa-solid fa-calendar-xmark"></i>
                            <span>Отменить</span>
                        </button>`
                    : `<span>
                        ${status_name}
                        </span>`
            }
        </div>
        </td>
    </tr>
    `;
}

function cardPlaceholderTemplate() {
    return `
    <tr class="placeholder-glow">
        <td class="text-center align-middle">
            <span class="placeholder col-8"></span>
        </td>
        <td>
            <div
                class="card-time d-flex align-items-center gap-2 mx-auto ${
                    statusClassNames[currentStatusId - 1]
                }">
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
    `;
}

function createCardsPlaceholder(count, container, cardTemplate) {
    container.innerHTML = '';

    for (let i = 0; i < count; i++) {
        container.insertAdjacentHTML('afterBegin', cardPlaceholderTemplate());
    }
}

selectStatusElement.addEventListener('change', async (e) => {
    currentStatusId = e.target.value;

    createCardsPlaceholder(6, recordingsContainer, cardPlaceholderTemplate);
    warningAlert.style.display = 'none';

    recordings = await getAllRecordings(currentStatusId, currentMasterId);

    if (recordings.length) {
        createCards(recordings, recordingsContainer, cardTimeTemplate);
        warningAlert.style.display = 'none';
    } else {
        recordingsContainer.innerHTML = '';
        warningAlert.style.display = 'block';
    }
});

selectMasterElement.addEventListener('change', async (e) => {
    currentMasterId = e.target.value;

    createCardsPlaceholder(6, recordingsContainer, cardPlaceholderTemplate);
    warningAlert.style.display = 'none';

    recordings = await getAllRecordings(currentStatusId, currentMasterId);

    if (recordings.length) {
        createCards(recordings, recordingsContainer, cardTimeTemplate);
        warningAlert.style.display = 'none';
    } else {
        recordingsContainer.innerHTML = '';
        warningAlert.style.display = 'block';
    }
});

textReasonCancel.addEventListener('input', (e) => {
    modalDangerAlert.style.display = 'none';
});

btnReasonCancel.addEventListener('click', async (e) => {
    if (textReasonCancel.value.length >= 8) {
        $('#signUpModal').modal('hide');

        createCardsPlaceholder(6, recordingsContainer, cardPlaceholderTemplate);
        warningAlert.style.display = 'none';

        await cancelRecording(currentRecordingId, textReasonCancel.value);

        textReasonCancel.value = '';

        recordings = await getAllRecordings(currentStatusId, currentMasterId);

        if (recordings.length) {
            createCards(recordings, recordingsContainer, cardTimeTemplate);
            warningAlert.style.display = 'none';
        } else {
            recordingsContainer.innerHTML = '';
            warningAlert.style.display = 'block';
        }
    } else {
        modalDangerAlert.style.display = 'block';
    }
});

function selectRecordingForCancel(recordingId) {
    currentRecordingId = recordingId;
    modalDangerAlert.style.display = 'none';

    console.log(recordingId);
}

async function doneRecording(recordingId) {
    createCardsPlaceholder(6, recordingsContainer, cardPlaceholderTemplate);
    warningAlert.style.display = 'none';

    await makeRecording(recordingId);

    recordings = await getAllRecordings(currentStatusId, currentMasterId);

    if (recordings.length) {
        createCards(recordings, recordingsContainer, cardTimeTemplate);
        warningAlert.style.display = 'none';
    } else {
        recordingsContainer.innerHTML = '';
        warningAlert.style.display = 'block';
    }
}
