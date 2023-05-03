const selectStatusElement = document.getElementById('selectStatus');
const recordingsContainer = document.getElementById('recordings');
const warningAlert = document.getElementById('warningAlert');

warningAlert.style.display = 'none';

let currentStatusId = 1;
let recordings = [];

const statusClassNames = ['isPlanned', 'isDone', 'isCancel'];

(async () => {
    recordings = await getAllRecordingsByUser(currentStatusId);

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
        <td>
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
            ${
                status_id == 1
                    ? `<button class="btn card-btn btn-cancel" data-bs-toggle="modal" data-bs-target="#signUpModal">
                            Отменить
                        </button>`
                    : `<span>
                        ${status_name}
                        </span>`
            }
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

    recordings = await getAllRecordingsByUser(currentStatusId);

    if (recordings.length) {
        createCards(recordings, recordingsContainer, cardTimeTemplate);
        warningAlert.style.display = 'none';
    } else {
        recordingsContainer.innerHTML = '';
        warningAlert.style.display = 'block';
    }
});
