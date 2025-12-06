/******/ (() => { // webpackBootstrap
/*!************************************!*\
  !*** ./resources/js/previewimg.js ***!
  \************************************/
window.displayFileName = displayFileName;
function displayFileName(input, index) {
  var fileNameDisplay = document.getElementById('file-name-display-' + index);
  if (input.files && input.files[0]) {
    fileNameDisplay.textContent = input.files[0].name;
  }
  var file = input.files[0];
  var preview = 0;
  if (index != 0) {
    preview = document.getElementById('previewImage' + index);
  }
  console.log(preview);
  if (preview != 0) {
    if (file) {
      var reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } else {
      preview.src = '#';
      preview.style.display = 'none';
    }
  }
}
/******/ })()
;