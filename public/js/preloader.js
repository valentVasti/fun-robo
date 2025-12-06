/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./resources/js/preloader.js ***!
  \***********************************/
//preloader
document.addEventListener("DOMContentLoaded", function () {
  window.addEventListener("load", function () {
    document.querySelector("#preloader").style.display = "none";
  });
});

//select all the images and add the lazy loading
document.addEventListener('DOMContentLoaded', function () {
  var allImages = document.querySelectorAll('img');
  allImages.forEach(function (img) {
    img.loading = 'lazy';
  });
});
/******/ })()
;