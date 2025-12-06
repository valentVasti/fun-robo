let count = 0;
const intervalTime = 1000;
const maxDuration = 120000;

document.addEventListener("DOMContentLoaded", function () {
    window.localStorage.setItem("firstTime", true);
    // fetchChangeLog();
    asyncFetchChangeLog();

    const testAnimation = document.getElementById("test-animation");
    var activityItem = document.getElementsByClassName("activity-item");

    // testAnimation.addEventListener("click", function () {
    //     const lastElement = activityItem[activityItem.length - 1];
    //     lastElement.classList.toggle("out");
    //     setTimeout(function () {
    //         lastElement.remove();
    //         console.log("deleted");
    //     }, 2000);

    //     setTimeout(function () {
    //         for (let i = 0; i < 4; i++) {
    //             activityItem[i].classList.toggle("down");
    //         }
    //     }, 200);

    //     console.log(lastElement);
    // });
});

const asyncFetchChangeLog = async () => {
    const preloader = document.getElementById("preloader");
    const recentActivitiesContainer =
        document.getElementById("activity-container");

    console.log(count++);
    count++;

    if (count * intervalTime < maxDuration) {
        setTimeout(asyncFetchChangeLog, intervalTime);
    } else {
        console.log("Stopped");
        return false;
    }

    try {
        const response = await fetch("logs");

        if (!response.ok) {
            throw new Error("Network response was not ok.");
        }

        const data = await response.json();
        if (window.localStorage.getItem("firstTime") == "true") {
            recentActivitiesContainer.style.display = "none";
            preloader.style.display = "flex";

            window.localStorage.setItem("countChangeLog", data.length);
            setRecentActivities(data);
        }
        if (data.length > window.localStorage.getItem("countChangeLog")) {
            recentActivitiesContainer.style.display = "none";
            preloader.style.display = "flex";

            window.localStorage.setItem(
                "oldCountChangeLog",
                window.localStorage.getItem("countChangeLog")
            );
            window.localStorage.setItem("countChangeLog", data.length);
            setRecentActivities(data);
        }

        setTimeout(function () {
            preloader.style.display = "none";
            recentActivitiesContainer.style.display = "";
        }, 1000);

        return data;
    } catch (error) {
        console.error("Error fetching data:", error);
        throw error;
    }
};

function fetchChangeLog() {
    console.log("RunLog");
    fetch("logs", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.head.querySelector(
                'meta[name="csrf-token"]'
            ).content,
        },
    })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            if (window.localStorage.getItem("firstTime") == "true") {
                window.localStorage.setItem("countChangeLog", data.length);
                setRecentActivities(data);
            }

            if (data.length > window.localStorage.getItem("countChangeLog")) {
                window.localStorage.setItem("countChangeLog", data.length);
                setRecentActivities(data);
            }
        })
        .catch((error) => {
            console.log(error);
        });

    const recentActivitiesContainer =
        document.getElementById("activity-container");

    count++;

    if (count * intervalTime < maxDuration) {
        setTimeout(fetchChangeLog, intervalTime);
    } else {
        console.log("Stopped");
    }
}

function setRecentActivities(data) {
    const recentActivitiesContainer =
        document.getElementById("activity-container");

    var activityItem = document.getElementsByClassName("activity-item");

    let firstTime = window.localStorage.getItem("firstTime");

    // while (recentActivitiesContainer.firstChild) {
    //     recentActivitiesContainer.removeChild(
    //         recentActivitiesContainer.firstChild
    //     );
    // }

    console.log("FirstTime String:", window.localStorage.getItem("firstTime"));
    if (firstTime == "true") {
        console.log("Initiate Element");
        window.localStorage.setItem("firstTime", false);

        data.some((log, index) => {
            if (index <= 4) {
                var activityItem = document.createElement("div");
                activityItem.classList.add("activity-item");

                var activityIcon = document.createElement("div");
                activityIcon.classList.add("activity-icon");
                activityIcon.style.backgroundColor = log.color;

                var icon = document.createElement("i");

                switch (log.action) {
                    case "deleted":
                        icon.classList.add("fa-solid", "fa-trash", "fa-xl");
                        break;

                    case "created":
                        icon.classList.add(
                            "fa-solid",
                            "fa-circle-plus",
                            "fa-xl"
                        );
                        break;

                    case "updated":
                        icon.classList.add(
                            "fa-solid",
                            "fa-pen-to-square",
                            "fa-xl"
                        );
                        break;

                    default:
                        break;
                }

                activityIcon.appendChild(icon);

                var activityDetail = document.createElement("div");
                activityDetail.classList.add("activity-detail");
                var tableName = document.createElement("p");
                tableName.style.fontSize = "large";
                tableName.innerHTML = log.table_name.toUpperCase();
                var timestamp = document.createElement("p");
                timestamp.style.fontSize = "smaller";
                timestamp.innerHTML = formatDate(log.created_at);
                activityDetail.append(tableName, timestamp);

                // var newDataJson = "";
                // var oldDataJson = "";

                // if(log.new_data != null){
                //     var newDataJson = JSON.parse(log.new_data);
                // }

                // if(log.old_data != null){
                //     var oldDataJson = JSON.parse(log.old_data);
                // }

                // var dataDetail = document.createElement("div");
                // dataDetail.classList.add("data-detail");
                // var detailIcon = document.createElement("i");
                // detailIcon.classList.add("fa-solid", "fa-info", "fa-2xs");

                // dataDetail.addEventListener("click", function () {
                //     Swal.fire({
                //         title: log.action,
                //         html:
                //             `
                //             <p>New Data:<br> ` +
                //             newDataJson +
                //             `</p>
                //             <p>Old Data:<br> ` +
                //             oldDataJson +
                //             `</p>
                //         `,
                //     });
                // });

                // dataDetail.appendChild(detailIcon);

                activityItem.append(activityIcon, activityDetail);
                recentActivitiesContainer.appendChild(activityItem);
            } else {
                return true;
            }
        });
    } else {
        console.log("New Data In Out");
        var oldCountChangeLog =
            window.localStorage.getItem("oldCountChangeLog");
        var countChangeLog = window.localStorage.getItem("countChangeLog");

        var differenceChangeLog = countChangeLog - oldCountChangeLog;
        console.log("differenceChangeLog:", differenceChangeLog);

        // out
        for (let i = 4; i >= 0; i--) {
            var child = activityItem[i];

            if (i >= 5 - differenceChangeLog) {
                console.log("Out index: ", i);
                child.remove();
            } else {
                console.log("Down index: ", i);
            }
        }

        // in
        for (let i = 0; i < differenceChangeLog; i++) {
            var log = data[0];
            console.log("jalan ke:", i);
            var activityItem = document.createElement("div");
            activityItem.classList.add("activity-item");

            var activityIcon = document.createElement("div");
            activityIcon.classList.add("activity-icon");
            activityIcon.style.backgroundColor = log.color;

            var icon = document.createElement("i");

            switch (log.action) {
                case "deleted":
                    icon.classList.add("fa-solid", "fa-trash", "fa-xl");
                    break;

                case "created":
                    icon.classList.add("fa-solid", "fa-circle-plus", "fa-xl");
                    break;

                case "updated":
                    icon.classList.add("fa-solid", "fa-pen-to-square", "fa-xl");
                    break;

                default:
                    break;
            }

            activityIcon.appendChild(icon);

            var activityDetail = document.createElement("div");
            activityDetail.classList.add("activity-detail");
            var tableName = document.createElement("p");
            tableName.style.fontSize = "large";
            tableName.innerHTML = log.table_name.toUpperCase();
            var timestamp = document.createElement("p");
            timestamp.style.fontSize = "smaller";
            timestamp.innerHTML = formatDate(log.created_at);
            activityDetail.append(tableName, timestamp);

            // var dataDetail = document.createElement("div");
            // dataDetail.classList.add("data-detail");
            // var detailIcon = document.createElement("i");
            // detailIcon.classList.add("fa-solid", "fa-info", "fa-2xs");
            // dataDetail.appendChild(detailIcon);

            const existingFirstChild =
                recentActivitiesContainer.firstElementChild;

            const index = Array.from(
                recentActivitiesContainer.children
            ).indexOf(existingFirstChild);
            console.log("Index of the first exist child element:", index);

            activityItem.append(activityIcon, activityDetail);

            recentActivitiesContainer.insertBefore(
                activityItem,
                existingFirstChild
            );
        }
    }
}

function formatDate(dateData) {
    // Convert the timestamp string to a JavaScript Date object
    const date = new Date(dateData);

    // Create a function to pad single digits with a leading zero
    const pad = (num) => (num < 10 ? `0${num}` : num);

    // Get individual date and time components
    const day = pad(date.getUTCDate());
    const month = pad(date.getUTCMonth() + 1); // Month starts from zero, so add 1
    const year = date.getUTCFullYear();
    const hours = pad(date.getUTCHours());
    const minutes = pad(date.getUTCMinutes());
    const seconds = pad(date.getUTCSeconds());

    // Construct the desired date-time string in the format dd-mm-YYYY hh:mm:ss
    const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

    return formattedDateTime; // Output: "08-12-2023 08:59:09"
}
