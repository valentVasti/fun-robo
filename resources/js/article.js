document.addEventListener("DOMContentLoaded", function () {
    AOS.init({
        duration: 1000,
        once: true,
    });
});

window.showArticles = showArticles;

document.addEventListener("DOMContentLoaded", function () {
    const tabsBox = document.querySelector(".tabs-box"),
        allTabs = tabsBox.querySelectorAll(".tab"),
        arrowIcons = document.querySelectorAll(".icon i");

    let isDragging = false;

    const handleIcons = (scrollVal) => {
        let maxScrollableWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
        arrowIcons[0].parentElement.style.display =
            scrollVal <= 0 ? "none" : "flex";
        arrowIcons[1].parentElement.style.display =
            maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
    };

    arrowIcons.forEach((icon) => {
        icon.addEventListener("click", () => {
            let scrollWidth = (tabsBox.scrollLeft +=
                icon.id === "left" ? -340 : 340);
            handleIcons(scrollWidth);
        });
    });

    allTabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            tabsBox.querySelector(".active").classList.remove("active");
            tab.classList.add("active");
        });
    });

    const dragging = (e) => {
        if (!isDragging) return;
        tabsBox.classList.add("dragging");
        tabsBox.scrollLeft -= e.movementX;
        handleIcons(tabsBox.scrollLeft);
    };

    const dragStop = () => {
        isDragging = false;
        tabsBox.classList.remove("dragging");
    };

    tabsBox.addEventListener("mousedown", () => (isDragging = true));
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
            success: function (response) {
                if (response) {
                    updateArticles(response.article_data, tagId, locale);
                } else {
                    console.error(
                        "Invalid or missing articles data in the response:",
                        response
                    );
                }
            },
            error: function (error) {
                console.error("Error fetching articles:", error);
            },
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
            year: "numeric",
        });

        var formattedTime = createdAt.toLocaleString("en-US", {
            hour: "numeric",
            minute: "numeric",
            hour12: false,
        });

        descriptionWrapper.innerHTML = `
            <h3 class="redtxt">${article.judul}</h3>
            <p class="gray"></p> 
            <a href="#"><button class="unique-button green">Lihat Detail</button></a>
            <div class="datetime gray">
                <p>${formattedDate}, ${formattedTime}</p>
            </div>`;

        descriptionWrapper.querySelector(".gray").innerHTML = article.isi;

        articleContainer.appendChild(descriptionWrapper);
        articleContainer.style.display = "none";
        document
            .getElementById("article-wrapper")
            .appendChild(articleContainer);
            $(articleContainer).fadeIn();
        descriptionWrapper
            .querySelector(".unique-button")
            .addEventListener("click", function () {
                var url = "/" + locale + "/article-detail/" + article.id;
                
                window.open(url, "_blank");
            });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    $(document).ready(function () {
        if (typeof showArticles === "function") {
        } else {
            console.error("showArticles function is not defined");
        }
        const articleData = document.getElementById("article-wrapper");
    });
});
