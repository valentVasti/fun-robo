/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./resources/js/table.js ***!
  \*******************************/
document.addEventListener("DOMContentLoaded", function setTruncate() {
  var tableCells = document.querySelectorAll("td");
  tableCells.forEach(function (cell) {
    var paragraphs = cell.querySelectorAll("p");
    cell.style.maxWidth = '100px';
    if (paragraphs.length > 0) {
      var firstParagraph = paragraphs[0]; // Select the first <p> tag
      firstParagraph.classList.add("truncate"); // Add truncate class to the first <p> tag

      // Hide the rest of the paragraphs
      for (var i = 1; i < paragraphs.length; i++) {
        paragraphs[i].style.display = "none";
      }
    } else {
      cell.classList.add("truncate");
    }
  });
});
/******/ })()
;