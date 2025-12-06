/******/ (() => { // webpackBootstrap
/*!*********************************!*\
  !*** ./resources/js/gallery.js ***!
  \*********************************/
// Gallery Delay Animation
document.addEventListener('DOMContentLoaded', function () {
  var galleryWrapper = document.querySelectorAll('.gallery-wrapper');
  galleryWrapper.forEach(function (card, index) {
    var dynamicDelay = index * 200; // Adjust the multiplier based on your preference
    card.setAttribute('data-aos-delay', dynamicDelay);
  });
  AOS.init({
    duration: 1000,
    once: true
  });
});
/******/ })()
;