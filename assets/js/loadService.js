document.addEventListener("DOMContentLoaded", () => {
    let productsContainer = document.querySelector(".container-service");
    let typeElements = document.querySelectorAll("[name='type']");

    typeElements.forEach((item) => {
      item.addEventListener("change", async (event) => {
        await getProducts(event.target.value);
      });
    });
  
    //создаем функцию для загрузки данных
    async function getProducts(type) {
      //формируем параметр
      const param = new URLSearchParams({ type });
      let response = await fetch(
        `/app/tables/recording/search.radio.php?${param}`
      );
      let products = await response.json();
  
      //выведем полученные данные на страницу
      outOnPage(products);
    }
  
    function outOnPage(products) {
      productsContainer.innerHTML = "";
      products.forEach((item) => {
        productsContainer.insertAdjacentHTML("beforeend", createCard(item));
      });

    }
  
    //создаем карточку товара
    function createCard({ id, name, duration}) {
      return `<div class="form-check">
      <input class="form-check-input service" type="radio" name="service" id="t-${id}" value="${id}" onclick="check();">
      <label class="form-check-label" for="t-${id}">
          ${name}
      </label>
      <p>Длительность: ${duration} ч.</p>
  </div>`;
    }
  });