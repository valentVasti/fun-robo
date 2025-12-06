/******/ (() => { // webpackBootstrap
/*!********************************!*\
  !*** ./resources/js/navbar.js ***!
  \********************************/
// translatebutton
document.addEventListener("DOMContentLoaded", function () {
  var translateBtn = document.getElementById("translateButton");
  var langAttribute = document.documentElement.lang;
  if (langAttribute == "en") {
    translateBtn.classList.toggle("active");
  } else {
    translateBtn.classList.remove("active");
  }
  translateBtn.addEventListener("click", function () {
    this.classList.toggle("active");
    if (translateBtn.classList.contains("active")) {
      translateBtn.dataset.language = "en";
    } else {
      translateBtn.dataset.language = "id";
    }
    fetch("/changeLanguage/" + translateBtn.dataset.language, {
      method: "GET"
    }).then(function (response) {
      return response.json();
    }).then(function (data) {
      // Handle the response data
      console.log("Change language", data);
      window.location.replace(data.url);
    })["catch"](function (error) {
      console.log(error);
    });
  });
});

//hamburger
document.addEventListener("DOMContentLoaded", function () {
  var menuToggle = document.getElementById("menuToggle");
  var menuWrapper = document.querySelector(".menu-wrapper");
  var navbarWrapper = document.querySelector(".navbar-wrapper");
  menuToggle.addEventListener("click", function () {
    menuWrapper.classList.toggle("expanded");
    navbarWrapper.classList.toggle("expanded");
  });
});
/******/ })()
;