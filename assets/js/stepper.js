const previousButton = document.querySelector('#prev');
const tabTargets = document.querySelectorAll('.tab');
const tabPanels = document.querySelectorAll('.tabpanel');
const isEmpty = (str) => !str.trim().length;
let currentStep = 0;

previousButton.addEventListener('click', (e) => {
    prevStep();
});

function nextStep() {
    // Hide current tab
    tabPanels[currentStep].classList.add('hidden');
    tabTargets[currentStep].classList.remove('active');

    // Show signUp tab
    tabPanels[currentStep + 1].classList.remove('hidden');
    tabTargets[currentStep + 1].classList.add('active');
    currentStep += 1;

    confirmRecordButton.setAttribute('disabled', true);
    updateStatusDisplay();
}

function prevStep() {
    tabPanels[currentStep].classList.add('hidden');
    tabTargets[currentStep].classList.remove('active');

    tabPanels[currentStep - 1].classList.remove('hidden');
    tabTargets[currentStep - 1].classList.add('active');
    currentStep -= 1;

    confirmRecordButton.setAttribute('disabled', true);

    updateStatusDisplay();
}

function updateStatusDisplay() {
    if (currentStep === tabTargets.length - 1) {
        confirmRecordButton.classList.add('hidden');
        previousButton.classList.remove('hidden');
        confirmRecordButton.removeAttribute('disabled');
    } else if (currentStep == 0) {
        confirmRecordButton.classList.remove('hidden');
        previousButton.classList.add('hidden');

        confirmRecordButton.style.display = 'none';
    } else {
        confirmRecordButton.classList.remove('hidden');
        previousButton.classList.remove('hidden');
        confirmRecordButton.style.display = 'block';
    }
}
