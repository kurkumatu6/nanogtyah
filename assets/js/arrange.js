let btnDate = document.querySelectorAll(".dateId");

btnDate.forEach((item) => {
  item.addEventListener("change", async () => {
    let valueId = document.querySelector(".dateId:checked").value;
    let params = new URLSearchParams({
      id: JSON.stringify(valueId),
    });
    data = await getData("/app/tables/recording/searchTime.php", params);

    console.log(data);
    document.querySelectorAll("[name='time']").forEach((item) => {
      data.forEach((elem) => {

          if (
            `${item.value}:00` < elem.startWork
          ) {
            item.style.display = "none";
          }

          
          if (
            Number(item.value.substring(0, 2)) > Number(elem.endWork.substring(0, 2))-1
          ) {
            item.style.display = "none";
          }
      });
    });
  });
});
