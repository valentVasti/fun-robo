/******/ (() => { // webpackBootstrap
/*!*********************************!*\
  !*** ./resources/js/article.js ***!
  \*********************************/
document.addEventListener("DOMContentLoaded", function () {
  AOS.init({
    duration: 1000,
    once: true
  });
});
window.showArticles = showArticles;
document.addEventListener("DOMContentLoaded", function () {
  var tabsBox = document.querySelector(".tabs-box"),
    allTabs = tabsBox.querySelectorAll(".tab"),
    arrowIcons = document.querySelectorAll(".icon i");
  var isDragging = false;
  var handleIcons = function handleIcons(scrollVal) {
    var maxScrollableWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
    arrowIcons[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
    arrowIcons[1].parentElement.style.display = maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
  };
  arrowIcons.forEach(function (icon) {
    icon.addEventListener("click", function () {
      var scrollWidth = tabsBox.scrollLeft += icon.id === "left" ? -340 : 340;
      handleIcons(scrollWidth);
    });
  });
  allTabs.forEach(function (tab) {
    tab.addEventListener("click", function () {
      tabsBox.querySelector(".active").classList.remove("active");
      tab.classList.add("active");
    });
  });
  var dragging = function dragging(e) {
    if (!isDragging) return;
    tabsBox.classList.add("dragging");
    tabsBox.scrollLeft -= e.movementX;
    handleIcons(tabsBox.scrollLeft);
  };
  var dragStop = function dragStop() {
    isDragging = false;
    tabsBox.classList.remove("dragging");
  };
  tabsBox.addEventListener("mousedown", function () {
    return isDragging = true;
  });
  tabsBox.addEventListener("mousemove", dragging);
  document.addEventListener("mouseup", dragStop);
  getArticlesUrl = $("#article-wrapper").data("articles-url");
});
function showArticles(tagId, locale) {
  if (tagId === "All Kategori") {
    showAllArticles();
  } else {
    $.ajax({
      url: "/" + locale + "/get-articles/" + tagId,
      type: "GET",
      // data: { tag_name: tagId },
      dataType: "json",
      success: function success(response) {
        if (response) {
          updateArticles(response.article_data, tagId, locale);
        } else {
          console.error("Invalid or missing articles data in the response:", response);
        }
      },
      error: function error(_error) {
        console.error("Error fetching articles:", _error);
      }
    });
  }
}
function showAllArticles() {
  $(".article-container.search-result").remove();
  $(".article-container").fadeIn();
}
function updateArticles(articleData, tag_id, locale) {
  $(".article-container").hide();
  articleData.forEach(function (article) {
    var articleContainer = document.createElement("div");
    articleContainer.classList.add("article-container", "search-result");
    var imgWrapper = document.createElement("div");
    imgWrapper.classList.add("img-wrapper");
    var img = document.createElement("img");
    img.src = "/images/database/article/" + article.thumbnail;
    imgWrapper.appendChild(img);
    articleContainer.appendChild(imgWrapper);
    var descriptionWrapper = document.createElement("div");
    descriptionWrapper.classList.add("description-wrapper");
    var createdAt = new Date(article.created_at);
    var formattedDate = createdAt.toLocaleString("en-US", {
      month: "long",
      weekday: "long",
      day: "numeric",
      year: "numeric"
    });
    var formattedTime = createdAt.toLocaleString("en-US", {
      hour: "numeric",
      minute: "numeric",
      hour12: false
    });
    descriptionWrapper.innerHTML = "\n            <h3 class=\"redtxt\">".concat(article.judul, "</h3>\n            <p class=\"gray\"></p> \n            <a href=\"#\"><button class=\"unique-button green\">Lihat Detail</button></a>\n            <div class=\"datetime gray\">\n                <p>").concat(formattedDate, ", ").concat(formattedTime, "</p>\n            </div>");
    descriptionWrapper.querySelector(".gray").innerHTML = article.isi;
    articleContainer.appendChild(descriptionWrapper);
    articleContainer.style.display = "none";
    document.getElementById("article-wrapper").appendChild(articleContainer);
    $(articleContainer).fadeIn();
    descriptionWrapper.querySelector(".unique-button").addEventListener("click", function () {
      var url = "/" + locale + "/article-detail/" + article.id;
      window.open(url, "_blank");
    });
  });
}
document.addEventListener("DOMContentLoaded", function () {
  $(document).ready(function () {
    if (typeof showArticles === "function") {} else {
      console.error("showArticles function is not defined");
    }
    var articleData = document.getElementById("article-wrapper");
  });
});
/******/ })()
;