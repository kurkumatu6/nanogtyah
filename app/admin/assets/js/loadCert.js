document.addEventListener("click", async (e) => {
  
    if (e.target.classList.contains("delete-cert")) {
    id = e.target.dataset.id;
    console.log($id)
    let response = await fetch("/app/admin/tables/master/admin.cert.delete.php", {
      method: "POST",
      headers: {"Content-Type": "application/json;charset=UTF-8",},
      body: JSON.stringify({ id }),
    });

    e.target.closest(".tr-cert").remove();

    await response.json();
  }
  
});
document.addEventListener("click", async (e) => {
  
    if (e.target.classList.contains("delete-work")) {
    id = e.target.dataset.id;
    console.log(id)
    let response = await fetch("/app/admin/tables/master/admin.work.delete.php", {
      method: "POST",
      headers: {"Content-Type": "application/json;charset=UTF-8",},
      body: JSON.stringify({ id }),
    });

    e.target.closest(".tr-work").remove();

    await response.json();
  }
  
});