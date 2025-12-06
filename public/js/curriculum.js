/******/ (() => { // webpackBootstrap
/*!************************************!*\
  !*** ./resources/js/curriculum.js ***!
  \************************************/
// Curriculum Wrapper Delay Animation
document.addEventListener('DOMContentLoaded', function () {
  var curriculumWrappers = document.querySelectorAll('.subject');
  curriculumWrappers.forEach(function (card, index) {
    var dynamicDelay = index * 200; // Adjust the multiplier based on your preference
    card.setAttribute('data-aos-delay', dynamicDelay);
  });
  AOS.init({
    duration: 1000,
    once: true
  });
});
document.addEventListener('DOMContentLoaded', function () {
  var deskripsiDivs = document.querySelectorAll('.deskripsi');
  deskripsiDivs.forEach(function (deskripsi) {
    var olElements = deskripsi.querySelectorAll('ol');
    olElements.forEach(function (ol) {
      var ul = document.createElement('ul');
      while (ol.firstChild) {
        var li = document.createElement('li');
        li.appendChild(ol.firstChild);
        ul.appendChild(li);
      }
      ol.parentNode.replaceChild(ul, ol);
    });
  });
});
/******/ })()
;