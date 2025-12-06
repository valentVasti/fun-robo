// document.addEventListener("DOMContentLoaded", function () {
//     var config = {};

//     // register search disini
//     switch (table.dataset.page) {
//         case "user":
//             config = {
//                 data_key: ["username"],
//                 page: "user",
//             };
//             break;
//         case "faq":
//             config = {
//                 data_key: ["question", "answer"],
//                 page: "faq",
//             };
//             break;
//         case "awards":
//             config = {
//                 data_key: ["achievement", "event", "year", "place"],
//                 page: "awards",
//             };
//             break;
//         case "testimoni":
//             config = {
//                 data_key: [
//                     "nama_testimoni",
//                     "keterangan_testimoni",
//                     "umur_testimoni",
//                     "isi_testimoni",
//                 ],
//                 page: "testimoni",
//             };
//             break;
//         case "article":
//             config = {
//                 data_key: ["penulis", "judul", "isi"],
//                 page: "article",
//             };
//             break;
//         case "branch":
//             config = {
//                 data_key: [
//                     "nama_branch",
//                     "alamat",
//                     "kota",
//                     "provinsi",
//                     "gambar_branch",
//                     "gambar_branch_desc",
//                     "phone_num",
//                     "instagram",
//                     "link_instagram",
//                     "facebook",
//                     "link_facebook",
//                     "link_gmaps",
//                 ],
//                 page: "branch",
//             };
//             break;
//         default:
//             config = {
//                 data_key: [],
//                 page: "",
//             };
//             break;
//     }

//     if (config.data_key.length > 0) {
//         config.data_key.push("created_at");
//         config.data_key.push("updated_at");
//     }

//     var data_key = config.data_key;
//     var json = JSON.parse(table.dataset.json);

//     search.addEventListener("input", function () {
//         var value = search.value;
//         json.forEach((data) => {
//             var row = document.getElementById(data.id);

//             for (let item in data_key) {
//                 if (checkAllKey(value, data)) {
//                     console.log(row)
//                     row.style.display = "";
//                     // break;
//                 } else {
//                     row.style.display = "none";
//                 }
//             }
//         });
//     });

//     function checkSearch(str1, str2) {
//         if (str1 != "") {
//             if (str2.includes(str1)) {
//                 return true; // Found a common character
//             }
//         } else {
//             return true;
//         }

//         return false; // No common character found
//     }

//     function checkAllKey(value, data) {
//         let temp_arr = [];
//         for (let index in data_key) {
//             if (
//                 data_key[index] === "created_at" ||
//                 data_key[index] === "updated_at"
//             ) {
//                 temp_arr.push(
//                     checkSearch(value, formatDateTime(data[data_key[index]]))
//                 );
//             } else {
//                 temp_arr.push(
//                     checkSearch(value, data[data_key[index]].toString())
//                 );
//             }
//         }

//         return temp_arr.reduce(
//             (accumulator, currentValue) => accumulator || currentValue,
//             false
//         );
//     }

//     function formatDateTime(datetime) {
//         // PHP datetime string
//         const phpDateTime = datetime;

//         // Parse the PHP datetime string into a JavaScript Date object
//         const dateObj = new Date(phpDateTime);

//         // Formatting the date to the desired string format ("YYYY-MM-DD HH:mm:ss")
//         const year = dateObj.getFullYear();
//         const month = String(dateObj.getMonth() + 1).padStart(2, "0");
//         const day = String(dateObj.getDate()).padStart(2, "0");
//         const hours = String(dateObj.getHours()).padStart(2, "0");
//         const minutes = String(dateObj.getMinutes()).padStart(2, "0");
//         const seconds = String(dateObj.getSeconds()).padStart(2, "0");

//         // Construct the formatted date string
//         return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
//     }
// });

// nyoba pake API

document.addEventListener("DOMContentLoaded", function () {
    var config = {};
    const loading = document.getElementById("preloader");

    // register search disini
    switch (table.dataset.page) {
        case "user":
            config = {
                data_key: ["username"],
                page: "user",
                url: "user/search/",
                deleteFunction: "deleteUser",
            };
            break;
        case "tag":
            config = {
                data_key: ["tag_name"],
                page: "tag",
                url: "tag/search/",
                deleteFunction: "deleteTag",
            };
            break;
        case "faq":
            config = {
                data_key: ["question", "answer"],
                page: "faq",
                url: "faq/search/",
                deleteFunction: "deleteFAQ",
            };
            break;
        case "awards":
            config = {
                data_key: ["achievement", "event", "year", "place", "type"],
                page: "awards",
                url: "awards/search/",
                deleteFunction: "deleteAwards",
            };
            break;
        case "testimoni":
            config = {
                data_key: [
                    "nama_testimoni",
                    "keterangan_testimoni",
                    "umur_testimoni",
                    "isi_testimoni",
                ],
                page: "testimoni",
                url: "testimoni/search/",
                deleteFunction: "deleteTestimoni",
            };
            break;
        case "article":
            config = {
                data_key: [
                    "judul",
                    "penulis",
                    "thumbnail",
                    "tag",
                    "highlighted",
                ],
                page: "article",
                url: "article/search/",
                deleteFunction: "deleteArticle",
            };
            break;
        case "branch":
            config = {
                data_key: [
                    "nama_branch",
                    "phone_num",
                    "email",
                    "informasi_detail",
                ],
                page: "branch",
                url: "branch/search/",
                deleteFunction: "deleteBranch",
            };
            break;
        case "curriculum":
            config = {
                data_key: [
                    "curriculum_name",
                    "price",
                    "duration",
                    "age_min",
                    "age_max",
                    "description"
                ],
                page: "curriculum",
                url: "curriculum/search/",
                deleteFunction: "deleteCurriculum",
            };
            break;
        default:
            config = {
                data_key: [],
                page: "",
            };
            break;
    }

    if (config.data_key.length > 0) {
        config.data_key.push("created_at");
        config.data_key.push("updated_at");
        config.data_key.push("action");
    }

    var data_key = config.data_key;
    var url = config.url;
    console.log(url);
    var json = JSON.parse(table.dataset.json);

    search.addEventListener("input", function () {
        var value = search.value;
        loading.style.display = "flex";
        table.style.display = "none";
        table.nextElementSibling.style.display = "none";
        table.nextElementSibling.nextElementSibling.style.display = "none";

        fetch(url + value)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json(); // Parse the JSON from the response
            })
            .then((data) => {
                table.style.display = "";

                if (table) {
                    let rows = table.getElementsByTagName("tr");
                    let rowCount = rows.length;

                    for (let i = rowCount - 1; i > 0; i--) {
                        let row = rows[i];
                        row.style.display = "none";
                    }
                } else {
                    console.log("Table not found");
                }

                setSearchTable(data, value);

                var tableCells = document.querySelectorAll("td");

                tableCells.forEach(function (cell) {
                    var paragraphs = cell.querySelectorAll("p");
                    cell.style.maxWidth = "100px";

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
                loading.style.display = "none";
            })
            .catch((error) => {
                // show all kaya redirect awal
                const notFound = document.getElementById("not-found-text");
                const searchTotal = document.getElementById("search-total");

                if (notFound != null) {
                    notFound.remove();
                }

                if (searchTotal != null) {
                    searchTotal.remove();
                }

                const element = table.parentElement;

                element.children[1].style.display = "";
                element.children[2].style.display = "";
                element.children[3].style.display = "";
                element.children[3].children[0].style.display = "";

                if (table) {
                    table.style.display = "";
                    let rows = table.querySelectorAll("tr[id]");
                    let resultRow =
                        table.getElementsByClassName("search-result");
                    let rowCount = rows.length;

                    for (let i = resultRow.length - 1; i >= 0; i--) {
                        let result = resultRow[i];
                        result.parentNode.removeChild(result);
                    }

                    for (let i = rowCount - 1; i >= 0; i--) {
                        console.log(i);

                        let row = rows[i];
                        console.log(row);
                        row.style.display = "";
                    }
                } else {
                    console.log("Table not found");
                }
                loading.style.display = "none";

                console.error("Fetch error:", error);
            });
    });

    function setSearchTable(data, value) {
        const resultArr = data.search;
        const dataStatus = data.status;
        const notFound = document.getElementById("not-found-text");
        const searchTotal = document.getElementById("search-total");
        const element = table.parentElement;
        element.children[2].style.display = "none";

        var i = 1;
        if (dataStatus == "Found") {
            if (notFound != null) {
                notFound.remove();
            }

            const total = element.children[3];
            total.style.display = "";

            if (searchTotal == null) {
                const searchTotal = document.createElement("span");
                searchTotal.id = "search-total";
                searchTotal.innerHTML =
                    "Found and showing " + resultArr.length + " results";
                total.children[0].style.display = "none";
                total.append(searchTotal);
            } else {
                searchTotal.innerHTML =
                    "Found and showing " + resultArr.length + " results";
                total.children[0].style.display = "none";
            }

            resultArr.forEach(function (element) {
                var resultRow = document.createElement("tr");
                var tdNumber = document.createElement("td");

                resultRow.classList.add("search-result");

                tdNumber.innerHTML = i++;
                resultRow.appendChild(tdNumber);

                config.data_key.forEach(function (key) {
                    var tdData = document.createElement("td");

                    if (key == "created_at" || key == "updated_at") {
                        tdData.innerHTML = formatDateTime(element[key]);
                        tdData.classList.add("truncate");
                    } else if (key == "action") {
                        var edit = document.createElement("a");
                        edit.href = config.page + "/edit/" + element["id"];

                        var editBtn = document.createElement("button");
                        var editIcon = document.createElement("i");
                        editIcon.classList.add(
                            "fa-regular",
                            "fa-pen-to-square"
                        );
                        editBtn.appendChild(editIcon);
                        edit.appendChild(editBtn);

                        var deleteBtn = document.createElement("button");
                        deleteBtn.id = "delete-btn";
                        deleteBtn.setAttribute(
                            "onclick",
                            config.deleteFunction + "('" + element["id"] + "')"
                        );
                        var deleteIcon = document.createElement("i");
                        deleteIcon.classList.add("fa-solid", "fa-trash");
                        deleteBtn.appendChild(deleteIcon);

                        tdData.append(edit, " ", deleteBtn);
                    } else if (key == "tag") {
                        tdData.classList.add("text-center");

                        var tagIcon = document.createElement("i");
                        tagIcon.id = "tag-detail";
                        tagIcon.classList.add(
                            "fa-solid",
                            "fa-tag",
                            "tag-detail",
                            "pointer"
                        );

                        var tagTemplate = document.createElement("div");
                        tagTemplate.id = "search-my-template-" + (i - 1);

                        var swalHtml = document.createElement("swal-html");
                        var judul = document.createElement("h3");
                        judul.innerHTML = "Tag Berita " + element["judul"];
                        var br = document.createElement("br");

                        swalHtml.appendChild(judul);
                        swalHtml.appendChild(br);

                        var tagArr = element[key];

                        console.log("TagArr:", tagArr);

                        tagArr.forEach((tag_data) => {
                            var spanTag = document.createElement("span");
                            spanTag.classList.add("attribute-modal");
                            spanTag.innerText = tag_data["detail"]["tag_name"];
                            swalHtml.appendChild(spanTag);
                        });

                        var swalFunctionParam = document.createElement(
                            "swal-function-param"
                        );
                        swalFunctionParam.setAttribute(
                            "name",
                            "showConfirmButton"
                        );
                        swalFunctionParam.setAttribute("value", "false");

                        tagTemplate.appendChild(swalHtml);

                        tagIcon.addEventListener("click", function () {
                            Swal.fire({
                                width: 500,
                                showConfirmButton: false,
                                position: "bottom-end",
                                toast: true,
                                showClass: {
                                    popup: `
                                        animate__animated
                                        animate__fadeInRight
                                        animate__faster
                                    `,
                                },
                                hideClass: {
                                    popup: `
                                        animate__animated
                                        animate__fadeOutRight
                                        animate__faster
                                    `,
                                },
                                html: tagTemplate,
                            });
                            console.log(tagTemplate.innerHTML);
                        });

                        tdData.appendChild(tagIcon);
                    } else if (key == "informasi_detail") {
                        var tdData = document.createElement("td");
                        tdData.classList.add("text-center");

                        // location
                        var locationSpan = document.createElement("span");
                        var locationBtn = document.createElement("button");
                        locationBtn.id = "location-detail";
                        locationBtn.classList.add("location-detail");
                        var locationIcon = document.createElement("i");
                        locationIcon.classList.add(
                            "fa-solid",
                            "fa-house",
                            "pointer"
                        );
                        locationBtn.appendChild(locationIcon);
                        locationSpan.appendChild(locationBtn);

                        // instagram
                        var instagramSpan = document.createElement("span");
                        var instagramIcon = document.createElement("i");
                        instagramIcon.classList.add(
                            "fa-brands",
                            "fa-instagram",
                            "fa-xl"
                        );
                        var instagramLink = document.createElement("a");
                        instagramLink.href = element["link_instagram"];
                        instagramLink.classList.add("instagram", "pointer");
                        instagramLink.appendChild(instagramIcon);
                        instagramSpan.appendChild(instagramLink);

                        // facebook
                        var facebookSpan = document.createElement("span");
                        var facebookIcon = document.createElement("i");
                        facebookIcon.classList.add(
                            "fa-brands",
                            "fa-facebook",
                            "fa-xl"
                        );
                        var facebookLink = document.createElement("a");
                        facebookLink.href = element["link_facebook"];
                        facebookLink.classList.add("facebook", "pointer");
                        facebookLink.appendChild(facebookIcon);
                        facebookSpan.appendChild(facebookLink);

                        // locationTemplate
                        var locationTemplate = document.createElement("div");
                        locationTemplate.id = "search-my-template-" + (i - 1);

                        var swalHtml = document.createElement("swal-html");
                        var judul = document.createElement("h3");
                        judul.innerHTML =
                            "Detail Lokasi " + element["nama_branch"];
                        var br = document.createElement("br");

                        var alamatLabel = document.createElement("p");
                        alamatLabel.classList.add("attribute-modal");
                        alamatLabel.innerText = "Alamat:";
                        swalHtml.appendChild(alamatLabel);
                        var alamatData = document.createElement("p");
                        alamatData.innerText = element["alamat"];

                        var kotaLabel = document.createElement("p");
                        kotaLabel.classList.add("attribute-modal");
                        kotaLabel.innerText = "Kota:";
                        swalHtml.appendChild(kotaLabel);
                        var kotaData = document.createElement("p");
                        kotaData.innerText = element["kota"];

                        var provinsiLabel = document.createElement("p");
                        provinsiLabel.classList.add("attribute-modal");
                        provinsiLabel.innerText = "Provinsi:";
                        var provinsiData = document.createElement("p");
                        provinsiData.innerText = element["provinsi"];

                        swalHtml.append(
                            judul,
                            br.cloneNode(),
                            alamatLabel,
                            alamatData,
                            br.cloneNode(),
                            kotaLabel,
                            kotaData,
                            br.cloneNode(),
                            provinsiLabel,
                            provinsiData,
                            br.cloneNode()
                        );

                        var swalFunctionParam = document.createElement(
                            "swal-function-param"
                        );
                        swalFunctionParam.setAttribute(
                            "name",
                            "showConfirmButton"
                        );
                        swalFunctionParam.setAttribute("value", "false");

                        locationTemplate.appendChild(swalHtml);

                        locationBtn.addEventListener("click", function () {
                            Swal.fire({
                                width: 500,
                                showConfirmButton: false,
                                position: "bottom-end",
                                toast: true,
                                showClass: {
                                    popup: `
                                        animate__animated
                                        animate__fadeInRight
                                        animate__faster
                                    `,
                                },
                                hideClass: {
                                    popup: `
                                        animate__animated
                                        animate__fadeOutRight
                                        animate__faster
                                    `,
                                },
                                html: locationTemplate,
                            });
                            console.log(locationTemplate);
                        });

                        tdData.append(
                            locationSpan,
                            " ",
                            instagramSpan,
                            " ",
                            facebookSpan
                        );
                    } else if (key == "highlighted") {
                        tdData.classList.add("text-center", "pointer");

                        var highlightedValue = element[key];

                        var iconElement = document.createElement("i");
                        iconElement.classList.add(
                            "fa-solid",
                            "fa-star",
                            "highlighted"
                        );
                        iconElement.setAttribute(
                            "onclick",
                            "updateHighlight(this, " + element["id"] + ")"
                        );
                        iconElement.setAttribute(
                            "data-highlight",
                            highlightedValue
                        );

                        if (highlightedValue == 1) {
                            iconElement.classList.toggle("active");
                        }

                        tdData.appendChild(iconElement);
                    } else {
                        tdData.innerHTML = element[key].toString();
                    }

                    resultRow.appendChild(tdData);
                });

                table.appendChild(resultRow);
            });
        } else {
            element.children[1].style.display = "none";
            element.children[2].style.display = "none";
            element.children[3].style.display = "none";

            if (notFound == null) {
                const notFound = document.createElement("p");
                notFound.classList.add("text-center");
                notFound.id = "not-found-text";
                notFound.innerHTML = '0 result for "' + value + '"';
                notFound.style.fontSize = "x-large";
                element.append(notFound);
            } else {
                notFound.innerHTML = '0 result for "' + value + '"';
            }
        }
    }

    function formatDateTime(datetime) {
        // PHP datetime string
        const phpDateTime = datetime;

        // Parse the PHP datetime string into a JavaScript Date object
        const dateObj = new Date(phpDateTime);

        // Formatting the date to the desired string format ("YYYY-MM-DD HH:mm:ss")
        const year = dateObj.getFullYear();
        const month = String(dateObj.getMonth() + 1).padStart(2, "0");
        const day = String(dateObj.getDate()).padStart(2, "0");
        const hours = String(dateObj.getHours()).padStart(2, "0");
        const minutes = String(dateObj.getMinutes()).padStart(2, "0");
        const seconds = String(dateObj.getSeconds()).padStart(2, "0");

        // Construct the formatted date string
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }
});
