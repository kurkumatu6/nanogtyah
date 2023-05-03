document.addEventListener("click", async (e) => {
  
    if (e.target.classList.contains("delete")) {
    id = e.target.dataset.id;
    let response = await fetch("/app/admin/tables/typeOfService/admin.type.delete.php", {
      method: "POST",
      headers: {"Content-Type": "application/json;charset=UTF-8",},
      body: JSON.stringify({ id }),
    });

    e.target.closest(".type-position").remove();

    await response.json();
  }
});