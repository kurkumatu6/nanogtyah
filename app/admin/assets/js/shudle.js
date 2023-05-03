async function postJSON(route, data, action) {
  let response = await fetch(route, {
      method: 'POST',
      headers: {
          //этот заголовок надо передавать обязательно, если тело в формате json
          'Content-Type': 'application/json;charset=UTF-8',
      },
      body: JSON.stringify({ data, action }),
  });

  return await response.json();
}

let showsheduleTabel = document.querySelector(".showSheduleTable>tbody");
let page = 1;
let dates = [];
showsheduleTabel.innerHTML = `            <tr class="days">
        <td></td>
    </tr>`;
dates = [];
const date = new Date();
var sub = date.getDay() > 0 ? 1 : -6;

var monday = new Date(date.setDate(date.getDate() - date.getDay() + sub));

console.log(monday.toString());
let tempDate = new Date(date.setDate(date.getDate() - date.getDay() + sub));
monday.setDate(monday.getDate() + (page - 1) * 7);
tempDate.setDate(tempDate.getDate() + page * 7 - 1);
let dayNames = [
  "понедельник",
  "вторник",
  "среда",
  "четверг",
  "пятница",
  "суббота",
  "воскресенье",
];
for (let i = (page - 1) * 7; i < page * 7; i++) {
  var mondaytemp = new Date(date.setDate(date.getDate() - date.getDay() + sub));
  mondaytemp.setDate(mondaytemp.getDate() + i);

  dates.push(
    mondaytemp.getFullYear() +
    "-" +
    (+mondaytemp.getMonth() + 1 >= 10
      ? +mondaytemp.getMonth() + 1
      : "0" + (+mondaytemp.getMonth() + 1)) +
    "-" +
    (+mondaytemp.getDate() >= 10
      ? mondaytemp.getDate()
      : "0" + mondaytemp.getDate())
  );
}
let week = document.querySelector(".week");
week.textContent = `${dates[0]} - ${dates[dates.length - 1]}`;
// console.log(dates)
for (let i = 0; i < dates.length; i++) {
  document
    .querySelector(".days")
    .insertAdjacentHTML(
      "beforeend",
      `<td><p>${dayNames[i]}</p><p>${dates[i]}</p></td>`
    );
};
postJSON(
  "/app/admin/tables/shedule/admin.shedule.js.loader.php",
  "",
  "getMasters"
).then(function (value) {
  value.shedule.forEach((master) => {
    showsheduleTabel.insertAdjacentHTML(
      "beforeend",
      `<tr class="sheduleMasterLine${master.id}">
        <td>${master.name}</td>
        </tr>`
    );
    let stroka = document.querySelector(`.sheduleMasterLine${master.id}`);
    // console.log(dates)
    dates.forEach(async (item) => {
      stroka.insertAdjacentHTML(
        "beforeend",
        `<td id ="aaaaa${master.id}${item}"></td>`
      );
    });

    dates.forEach(async (item) => {
      await postJSON(
        "/app/admin/tables/shedule/admin.shedule.js.loader.php",
        { master_id: master.id, date: item },
        "getMastersShudle"
      ).then(function (value) {
        console.log(value.shedule);
        if (value.shedule) {
          document.querySelector(
            `#aaaaa${master.id}${item}`
          ).innerHTML = `<span>c ${value.shedule.startWork}</span> <span>по ${value.shedule.endWork}</span></td>`;
        } else {
          document.querySelector(
            `#aaaaa${master.id}${item}`
          ).innerHTML = `<td>Выходной</td>`;
        }
      });
    });
  });
});

document.addEventListener("change", function (e) {
  if (e.target.classList.contains("masters")) {
    if (e.target.checked) {
      document
        .querySelector(`#timeStart${e.target.dataset.id}`)
        .removeAttribute("disabled");
      document
        .querySelector(`#timeEnd${e.target.dataset.id}`)
        .removeAttribute("disabled");
    } else {
      document
        .querySelector(`#timeStart${e.target.dataset.id}`)
        .setAttribute("disabled", "disabled");
      document
        .querySelector(`#timeEnd${e.target.dataset.id}`)
        .setAttribute("disabled", "disabled");
    }
  }
});
document.addEventListener("click", function (e) {
  if (e.target.classList.contains("next")) {
    showsheduleTabel.innerHTML = `            <tr class="days">
        <td></td>
    </tr>`;
    page += 1;
    if (page == 0) {
      page == 1;
    }
    dates = [];
    const date = new Date();
    var sub = date.getDay() > 0 ? 1 : -6;

    var monday = new Date(date.setDate(date.getDate() - date.getDay() + sub));

    // console.log(monday.toString());
    let tempDate = new Date(date.setDate(date.getDate() - date.getDay() + sub));
    monday.setDate(monday.getDate() + (page - 1) * 7);
    tempDate.setDate(tempDate.getDate() + page * 7 - 1);
    let dayNames = [
      "понедельник",
      "вторник",
      "среда",
      "четверг",
      "пятница",
      "суббота",
      "воскресенье",
    ];
    for (let i = (page - 1) * 7; i < page * 7; i++) {
      var mondaytemp = new Date(
        date.setDate(date.getDate() - date.getDay() + sub)
      );
      mondaytemp.setDate(mondaytemp.getDate() + i);

      dates.push(
        mondaytemp.getFullYear() +
        "-" +
        (+mondaytemp.getMonth() + 1 >= 10
          ? +mondaytemp.getMonth() + 1
          : "0" + (+mondaytemp.getMonth() + 1)) +
        "-" +
        (+mondaytemp.getDate() >= 10
          ? mondaytemp.getDate()
          : "0" + mondaytemp.getDate())
      );
    }
    let week = document.querySelector(".week");
    week.textContent = `${dates[0]} - ${dates[dates.length - 1]}`;
    for (let i = 0; i < dates.length; i++) {
      document
        .querySelector(".days")
        .insertAdjacentHTML(
          "beforeend",
          `<td><p>${dayNames[i]}</p><p>${dates[i]}</p></td>`
        );
    }

    postJSON(
      "/app/admin/tables/shedule/admin.shedule.js.loader.php",
      "",
      "getMasters"
    ).then(function (value) {
      value.shedule.forEach((master) => {
        showsheduleTabel.insertAdjacentHTML(
          "beforeend",
          `<tr class="sheduleMasterLine${master.id}">
        <td>${master.name}</td>
        </tr>`
        );
        let stroka = document.querySelector(`.sheduleMasterLine${master.id}`);
        dates.forEach(async (item) => {
          stroka.insertAdjacentHTML(
            "beforeend",
            `<td id ="aaaaa${master.id}${item}"></td>`
          );
        });

        dates.forEach(async (item) => {
          await postJSON(
            "/app/admin/tables/shedule/admin.shedule.js.loader.php",
            { master_id: master.id, date: item },
            "getMastersShudle"
          ).then(function (value) {
            console.log(value.shedule);
            if (value.shedule) {
              document.querySelector(
                `#aaaaa${master.id}${item}`
              ).innerHTML = `<span>c ${value.shedule.startWork}</span> <span>по ${value.shedule.endWork}</span></td>`;
            } else {
              document.querySelector(
                `#aaaaa${master.id}${item}`
              ).innerHTML = `<td>Выходной</td>`;
            }
          });
        });
      });
    });
  }
  if (e.target.classList.contains("back")) {
    showsheduleTabel.innerHTML = `            <tr class="days">
        <td></td>
    </tr>`;
    page -= 1;
    if (page == 0) {
      page == -1;
    }
    dates = [];
    const date = new Date();
    var sub = date.getDay() > 0 ? 1 : -6;

    var monday = new Date(date.setDate(date.getDate() - date.getDay() + sub));

    // console.log(monday.toString());
    let tempDate = new Date(date.setDate(date.getDate() - date.getDay() + sub));
    monday.setDate(monday.getDate() + (page - 1) * 7);
    tempDate.setDate(tempDate.getDate() + page * 7 - 1);
    let dayNames = [
      "понедельник",
      "вторник",
      "среда",
      "четверг",
      "пятница",
      "суббота",
      "воскресенье",
    ];
    for (let i = (page - 1) * 7; i < page * 7; i++) {
      var mondaytemp = new Date(
        date.setDate(date.getDate() - date.getDay() + sub)
      );
      mondaytemp.setDate(mondaytemp.getDate() + i);

      dates.push(
        mondaytemp.getFullYear() +
        "-" +
        (+mondaytemp.getMonth() + 1 >= 10
          ? +mondaytemp.getMonth() + 1
          : "0" + (+mondaytemp.getMonth() + 1)) +
        "-" +
        (+mondaytemp.getDate() >= 10
          ? mondaytemp.getDate()
          : "0" + mondaytemp.getDate())
      );
    }

    let week = document.querySelector(".week");
    week.textContent = `${dates[0]} - ${dates[dates.length - 1]}`;

    // console.log(dates)
    for (let i = 0; i < dates.length; i++) {
      document
        .querySelector(".days")
        .insertAdjacentHTML(
          "beforeend",
          `<td><p>${dayNames[i]}</p><p>${dates[i]}</p></td>`
        );
    }

    postJSON(
      "/app/admin/tables/shedule/admin.shedule.js.loader.php",
      "",
      "getMasters"
    ).then(function (value) {
      value.shedule.forEach((master) => {
        showsheduleTabel.insertAdjacentHTML(
          "beforeend",
          `<tr class="sheduleMasterLine${master.id}">
        <td>${master.name}</td>
        </tr>`
        );
        let stroka = document.querySelector(`.sheduleMasterLine${master.id}`);
        dates.forEach(async (item) => {
          stroka.insertAdjacentHTML(
            "beforeend",
            `<td id ="aaaaa${master.id}${item}"></td>`
          );
        });

        dates.forEach(async (item) => {
          await postJSON(
            "/app/admin/tables/shedule/admin.shedule.js.loader.php",
            { master_id: master.id, date: item },
            "getMastersShudle"
          ).then(function (value) {
            console.log(value.shedule);
            if (value.shedule) {
              document.querySelector(
                `#aaaaa${master.id}${item}`
              ).innerHTML = `<span>c ${value.shedule.startWork}</span> <span>по ${value.shedule.endWork}</span></td>`;
            } else {
              document.querySelector(
                `#aaaaa${master.id}${item}`
              ).innerHTML = `<td>Выходной</td>`;
            }
          });
        });
      });
    });
  }
  if (e.target.classList.contains("addShedule")) {
    let mastersShedule = [];
    document.querySelectorAll(".masters").forEach((item) => {
      if (item.checked) {
        let startTime = document.querySelector(
          `#timeStart${item.dataset.id}`
        ).value;
        let endTime = document.querySelector(
          `#timeEnd${item.dataset.id}`
        ).value;
        // console.log(startTime)
        // console.log(endTime)
        if (startTime != "" && endTime != "") {
          mastersShedule.push({
            master_id: item.dataset.id,
            startTime: startTime,
            endTime: endTime,
          });
          if (document.querySelector(`.error${item.dataset.id}`) != null) {
            document.querySelector(`.error${item.dataset.id}`).remove();
          }
        } else {
          if (document.querySelector(`.error${item.dataset.id}`) == null) {
            item
              .closest(".masterBlock")
              .insertAdjacentHTML(
                "beforeend",
                `<h2 class='error${item.dataset.id}'>Время начала или время конца не выбранны</h2>`
              );
          }
        }
      }
    });
    // console.log(mastersShedule)
    if (
      mastersShedule.length > 0 &&
      document.querySelector("#datepicker").value != ""
    ) {
      postJSON(
        "/app/admin/tables/shedule/admin.shedule.js.loader.php",
        {
          date: document.querySelector("#datepicker").value,
          mastersShedule: mastersShedule,
        },
        "setMastersShedule"
      );
    }
    postJSON(
      "/app/admin/tables/shedule/admin.shedule.js.loader.php",
      "",
      "getMasters"
    ).then(function (value) {
      let block = document.querySelector(".mastersBlock");
      block.innerHTML = "";
      value.shedule.forEach((element) => {
        block.insertAdjacentHTML(
          "beforeend",
          `
            <div class="masterBlock${element.id}">
                <input type="checkbox" name="masters" class="masters" data-id="${element.id}" id="master${element.id}">
                <label for="master${element.id}">${element.name}${element.surname}</label>
            </div>
            `
        );
        console.log({
          date: document.querySelector("#datepicker").value,
          master_id: element.id,
        });
        postJSON(
          "/app/admin/tables/shedule/admin.shedule.js.loader.php",
          {
            date: document.querySelector("#datepicker").value,
            master_id: element.id,
          },
          "getMastersRecording"
        ).then(function (value) {
          let masterBlock = document.querySelector(`.masterBlock${element.id}`);
          if (value.shedule.length > 0) {
            document
              .querySelector(`#master${element.id}`)
              .setAttribute("disabled", "disabled");
            masterBlock.insertAdjacentHTML(
              "beforeend",
              "<h6>Изменить расписание данного мастера невозможно т.к у него есть 'новые' записи в этот день</h6>"
            );
          } else {
            postJSON(
              "/app/admin/tables/shedule/admin.shedule.js.loader.php",
              {
                date: document.querySelector("#datepicker").value,
                master_id: element.id,
              },
              "getMastersShudleForStaar"
            ).then(function (value) {
              console.log(value);
              if (
                value.shedule.startWork != null &&
                value.shedule.endWork != null
              ) {
                masterBlock.insertAdjacentHTML(
                  "beforeend",
                  `
                            <div>
                                <label for="">Время начала работы</label>
                                <input type="time" name="" id="timeStart${element.id}" value="${value.shedule.startWork}" disabled>
                            </div>
                            <div>
                                <label for="">Время конца работы</label>
                                <input type="time" name="" id="timeEnd${element.id}" value="${value.shedule.endWork}" disabled>
                            </div>
                            `
                );
              } else {
                masterBlock.insertAdjacentHTML(
                  "beforeend",
                  `
                            <div>
                                <label for="">Время начала работы</label>
                                <input type="time" name="" id="timeStart${element.id}"  disabled>
                            </div>
                            <div>
                                <label for="">Время конца работы</label>
                                <input type="time" name="" id="timeEnd${element.id}"  disabled>
                            </div>
                            `
                );
              }
            });
          }

        });
      });
    });
    showsheduleTabel.innerHTML = `            <tr class="days">
    <td></td>
</tr>`;
    dates = [];
    const date = new Date();
    var sub = date.getDay() > 0 ? 1 : -6;

    var monday = new Date(date.setDate(date.getDate() - date.getDay() + sub));

    // console.log(monday.toString());
    let tempDate = new Date(date.setDate(date.getDate() - date.getDay() + sub));
    monday.setDate(monday.getDate() + (page - 1) * 7);
    tempDate.setDate(tempDate.getDate() + page * 7 - 1);
    let dayNames = [
      "понедельник",
      "вторник",
      "среда",
      "четверг",
      "пятница",
      "суббота",
      "воскресенье",
    ];
    for (let i = (page - 1) * 7; i < page * 7; i++) {
      var mondaytemp = new Date(
        date.setDate(date.getDate() - date.getDay() + sub)
      );
      mondaytemp.setDate(mondaytemp.getDate() + i);

      dates.push(
        mondaytemp.getFullYear() +
        "-" +
        (+mondaytemp.getMonth() + 1 >= 10
          ? +mondaytemp.getMonth() + 1
          : "0" + (+mondaytemp.getMonth() + 1)) +
        "-" +
        (+mondaytemp.getDate() >= 10
          ? mondaytemp.getDate()
          : "0" + mondaytemp.getDate())
      );
    }

    let week = document.querySelector(".week");
    week.textContent = `${dates[0]} - ${dates[dates.length - 1]}`;

    // console.log(dates)
    for (let i = 0; i < dates.length; i++) {
      document
        .querySelector(".days")
        .insertAdjacentHTML(
          "beforeend",
          `<td><p>${dayNames[i]}</p><p>${dates[i]}</p></td>`
        );
    }

    postJSON(
      "/app/admin/tables/shedule/admin.shedule.js.loader.php",
      "",
      "getMasters"
    ).then(function (value) {
      value.shedule.forEach((master) => {
        showsheduleTabel.insertAdjacentHTML(
          "beforeend",
          `<tr class="sheduleMasterLine${master.id}">
    <td>${master.name}</td>
    </tr>`
        );
        let stroka = document.querySelector(`.sheduleMasterLine${master.id}`);
        dates.forEach(async (item) => {
          stroka.insertAdjacentHTML(
            "beforeend",
            `<td id ="aaaaa${master.id}${item}"></td>`
          );
        });

        dates.forEach(async (item) => {
          await postJSON(
            "/app/admin/tables/shedule/admin.shedule.js.loader.php",
            { master_id: master.id, date: item },
            "getMastersShudle"
          ).then(function (value) {
            console.log(value.shedule);
            if (value.shedule) {
              document.querySelector(
                `#aaaaa${master.id}${item}`
              ).innerHTML = `<span>c ${value.shedule.startWork}</span> <span>по ${value.shedule.endWork}</span></td>`;
            } else {
              document.querySelector(
                `#aaaaa${master.id}${item}`
              ).innerHTML = `<td>Выходной</td>`;
            }
          });
        });
      });
    });
  }
});
