/******/ (() => { // webpackBootstrap
/*!************************************!*\
  !*** ./resources/js/pagination.js ***!
  \************************************/
// document.addEventListener("DOMContentLoaded", function () {
//     let totalpage = table.dataset.totalpage;

//     const paginationContainer = document.getElementById("pagination-container");

//     console.log()

//         for (let i = 0; i < totalpage; i++) {
//             var newLink = document.createElement("a");
//             var newPage = document.createElement("div");

//             newLink.href = "" + "?page=" + (i + 1);

//             console.log(newLink.href);

//             newLink.style.textDecoration = "none";
//             console.log("Link: ", newLink.href);

//             newPage.classList.add("page");
//             newPage.innerHTML = i + 1;

//             newLink.appendChild(newPage);
//             paginationContainer.appendChild(newLink);
//         }

// });

document.addEventListener("DOMContentLoaded", function () {
  var selectElement = document.getElementById("dataPerPage");
  var selectedOption = selectElement.options[window.localStorage.getItem("selectedPerPage")];
  selectedOption.selected = true;
});
function redirectToRoute(route, element, type) {
  if (route !== "") {
    var selectedOption = element.options[element.selectedIndex];
    if (type == "dataPerPage") {
      window.localStorage.setItem("selectedPerPage", element.selectedIndex);
    }
    console.log(selectedOption);
    window.location.href = route;
  } else {}
}
/******/ })()
;