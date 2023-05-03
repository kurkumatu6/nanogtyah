async function getServiceTypes() {
    let response = await fetch(`/app/tables/services/getServiceTypes.php`);
    return await response.json();
}

async function getServicesByType(type) {
    let response = await fetch(`/app/tables/services/getServicesByType.php?typeId=${type}`);
    return await response.json();
}
