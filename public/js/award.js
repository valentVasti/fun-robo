/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/award.js ***!
  \*******************************/
// award-container Delay Animation
document.addEventListener('DOMContentLoaded', function () {
  var awardContainer = document.querySelectorAll('.awards-container');
  awardContainer.forEach(function (card, index) {
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