//получение данных
async function getData(route, params = '') {
    if (params != '') {
        route += `?${params}`;
    }
    let response = await fetch(route);
    return await response.json();
}

//передача данных в формате json
async function postJSON(route, data, action = '') {
    let response = await fetch(route, {
        method: 'POST',
        headers: {
            'Content-type': 'application/json;charset=utf-8',
        },
        body: JSON.stringify(data),
    });

    return await response.json();
}
