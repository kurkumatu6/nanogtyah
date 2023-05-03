async function getMastersByTypeService(type) {
    let response = await fetch(`/app/tables/masters/getMastersByTypeService.php?typeId=${type}`);

    return await response.json();
}
async function getMasterShedule(masterId) {
    let response = await fetch(`/app/tables/masters/getMasterShedule.php?masterId=${masterId}`);

    return await response.json();
}

async function getTimeByMaster(masterId, date) {
    let response = await fetch(
        `/app/tables/masters/getTimeByMaster.php?masterId=${masterId}&date=${date}`,
    );

    return await response.json();
}

async function getBusyTimeByMaster(masterId, date) {
    let response = await fetch(
        `/app/tables/masters/getBusyTimeByMaster.php?masterId=${masterId}&date=${date}`,
    );

    return await response.json();
}
