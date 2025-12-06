/******/ (() => { // webpackBootstrap
/*!**********************************!*\
  !*** ./resources/js/datetime.js ***!
  \**********************************/
document.addEventListener("DOMContentLoaded", function () {
  var table = document.getElementById("table");
  var search = document.getElementById("search");
  var datetime = document.getElementById("datetime");

  // Create a new Date object representing the current date and time
  var currentDate = new Date();

  // Get various components of the current date and time
  var currentYear = currentDate.getFullYear(); // Get the current year (e.g., 2023)
  var currentMonth = currentDate.getMonth() + 1; // Get the current month (0-11, add 1 to get actual month)
  var currentDay = currentDate.getDate(); // Get the day of the month (1-31)
  var currentHours = currentDate.getHours(); // Get the current hour (0-23)
  var currentMinutes = currentDate.getMinutes(); // Get the current minute (0-59)
  var currentSeconds = currentDate.getSeconds(); // Get the current second (0-59)
  var currentMilliseconds = currentDate.getMilliseconds(); // Get the current millisecond (0-999)

  // Display the current date and time in a desired format
  console.log("Current Date: ".concat(currentYear, "-").concat(currentMonth, "-").concat(currentDay));
  console.log("Current Time: ".concat(currentHours, ":").concat(currentMinutes, ":").concat(currentSeconds));
  datetime.innerHTML = "".concat(currentYear, "-").concat(currentMonth, "-").concat(currentDay);
});
/******/ })()
;