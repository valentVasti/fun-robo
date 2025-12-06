/******/ (() => { // webpackBootstrap
/*!**************************************!*\
  !*** ./resources/js/radioArticle.js ***!
  \**************************************/
document.addEventListener("DOMContentLoaded", function () {
  var radioButtons = document.getElementById("radio-group");
  var img_1 = document.getElementById("article_img_1");
  var img_2 = document.getElementById("article_img_2");
  var img_3 = document.getElementById("article_img_3");
  var count = radioButtons.dataset.count;
  var children = radioButtons.querySelectorAll("input");
  if (count != 0) {
    switch (parseInt(count)) {
      case 1:
        children[0].checked = true;
        break;
      case 2:
        children[1].checked = true;
        break;
      case 3:
        children[2].checked = true;
        break;
      default:
        break;
    }
  } else {
    img_1.style.display = "none";
    img_2.style.display = "none";
    img_3.style.display = "none";
    window.onload = function () {
      switch (window.localStorage.getItem("radioSelected")) {
        case 1:
          children[0].checked = true;
          break;
        case 2:
          children[1].checked = true;
          break;
        case 3:
          children[2].checked = true;
          break;
        default:
          break;
      }
    };
    children.forEach(function (radioButton, index) {
      radioButton.addEventListener("change", function () {
        // This function will be executed when a radio button is selected or deselected
        if (this.checked) {
          if (index === 0) {
            img_1.style.display = "flex";
            img_2.style.display = "none";
            img_3.style.display = "none";
            window.localStorage.setItem("radioSelected", 1);
          } else if (index === 1) {
            img_1.style.display = "flex";
            img_2.style.display = "flex";
            img_3.style.display = "none";
            window.localStorage.setItem("radioSelected", 2);
          } else if (index === 2) {
            img_1.style.display = "flex";
            img_2.style.display = "flex";
            img_3.style.display = "flex";
            window.localStorage.setItem("radioSelected", 3);
          }
        }
      });
    });
  }
});
/******/ })()
;