async function signUp(date, finalCost, masterId, serviceId, statusId) {
    // let response = await fetch(
    //     `/app/tables/recording/signUp.php?date=${date}&finalCost=${finalCost}&masterId=${masterId}&serviceId=${serviceId}&statusId=${statusId}`,
    // );

    let response = await postJSON('/app/tables/recording/signUp.php', {
        date,
        finalCost,
        masterId,
        serviceId,
        statusId,
    });

    return await response.json();
}

async function getAllRecordingsByUser(currentStatusId) {
    let response = await fetch(
        `/app/tables/recording/getAllRecordingsByUser.php?statusId=${currentStatusId}`,
    );

    return await response.json();
}

async function getAllRecordings(currentStatusId, currentMasterId) {
    let response = await fetch(
        `/app/tables/recording/getAllRecordings.php?statusId=${currentStatusId}&masterId=${currentMasterId}`,
    );

    return await response.json();
}

async function cancelRecording(recordingId, reasonCancel) {
    try {
        let response = await postJSON('/app/admin/tables/recording/cancelRecording.php', {
            recordingId,
            reasonCancel,
        });

        if (!response.ok) {
            throw new Error(`Error! status: ${response.status}`);
        }

        return await response.json();
    } catch (err) {
        console.log(err);
    }
}

async function makeRecording(recordingId) {
    try {
        let response = await postJSON('/app/admin/tables/recording/makeRecording.php', {
            recordingId,
        });

        if (!response.ok) {
            throw new Error(`Error! status: ${response.status}`);
        }

        return await response.json();
    } catch (err) {
        console.log(err);
    }
}
