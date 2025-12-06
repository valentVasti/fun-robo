/******/ (() => { // webpackBootstrap
/*!***********************************!*\
  !*** ./resources/js/testimoni.js ***!
  \***********************************/
// Testimoni Delay Animation
document.addEventListener('DOMContentLoaded', function () {
  var testimoniCards = document.querySelectorAll('.testimoni-card');
  testimoniCards.forEach(function (card, index) {
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