window.deleteUser = deleteUser
window.deleteFAQ = deleteFAQ
window.deleteAwards = deleteAwards
window.deleteTestimoni = deleteTestimoni
window.deleteArticle = deleteArticle
window.deleteBranch = deleteBranch
window.deleteTag = deleteTag
window.deleteCurriculum = deleteCurriculum

const deleteBtn = document.getElementById("delete-btn");
console.log(document.head.querySelector('meta[name="csrf-token"]').content);

function deleteUser($id) {
    Swal.fire({
        title: "Do you want to delete this user?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Cancel`,
        icon: "warning",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("user/delete/" + $id, {
                method: "DELETE",
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
                    // Handle the response data
                    if (data.status == "Failed") {
                        Swal.fire({
                            title: "Failed!",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "OK!",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    // Handle errors
                    Swal.fire({
                        title: "Error!",
                        text: error,
                        icon: "error",
                    });
                });
        }
    });
}

function deleteFAQ($id) {
    Swal.fire({
        title: "Do you want to delete this FAQ?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Cancel`,
        icon: "warning",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("faq/delete/" + $id, {
                method: "DELETE",
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
                    // Handle the response data
                    if (data.status == "Failed") {
                        Swal.fire({
                            title: "Failed!",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "OK!",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    // Handle errors
                    Swal.fire({
                        title: "Error!",
                        text: error,
                        icon: "error",
                    });
                });
        }
    });
}

function deleteAwards($id) {
    Swal.fire({
        title: "Do you want to delete this Awards?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Cancel`,
        icon: "warning",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("awards/delete/" + $id, {
                method: "DELETE",
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
                    // Handle the response data
                    if (data.status == "Failed") {
                        Swal.fire({
                            title: "Failed!",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "OK!",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    // Handle errors
                    Swal.fire({
                        title: "Error!",
                        text: error,
                        icon: "error",
                    });
                });
        }
    });
}

function deleteTestimoni($id) {
    Swal.fire({
        title: "Do you want to delete this Testimoni?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Cancel`,
        icon: "warning",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("testimoni/delete/" + $id, {
                method: "DELETE",
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
                    // Handle the response data
                    if (data.status == "Failed") {
                        Swal.fire({
                            title: "Failed!",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "OK!",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    // Handle errors
                    Swal.fire({
                        title: "Error!",
                        text: error,
                        icon: "error",
                    });
                });
        }
    });
}

function deleteArticle($id) {
    Swal.fire({
        title: "Do you want to delete this Article?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Cancel`,
        icon: "warning",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("article/delete/" + $id, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            })
                .then((response) => {
                    console.log("Response:", response);
                    return response.json();
                })
                .then((data) => {
                    // Handle the response data
                    if (data.status == "Failed") {
                        Swal.fire({
                            title: "Failed!",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "OK!",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    console.log("Error:", error);
                    // Handle errors
                    Swal.fire({
                        title: "Error!",
                        text: error,
                        icon: "error",
                    });
                });
        }
    });
}

function deleteBranch($id) {
    Swal.fire({
        title: "Do you want to delete this Branch?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Cancel`,
        icon: "warning",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("branch/delete/" + $id, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            })
                .then((response) => {
                    console.log("Response:", response);
                    return response.json();
                })
                .then((data) => {
                    // Handle the response data
                    if (data.status == "Failed") {
                        Swal.fire({
                            title: "Failed!",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "OK!",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    console.log("Error:", error);
                    // Handle errors
                    Swal.fire({
                        title: "Error!",
                        text: error,
                        icon: "error",
                    });
                });
        }
    });
}

function deleteTag($id) {
    Swal.fire({
        title: "Do you want to delete this Tag?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Cancel`,
        icon: "warning",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("tag/delete/" + $id, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.head.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
            })
                .then((response) => {
                    console.log("Response:", response);
                    return response.json();
                })
                .then((data) => {
                    // Handle the response data
                    if (data.status == "Failed") {
                        Swal.fire({
                            title: "Failed!",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "OK!",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    console.log("Error:", error);
                    // Handle errors
                    Swal.fire({
                        title: "Error!",
                        text: error,
                        icon: "error",
                    });
                });
        }
    });
}

function deleteCurriculum($id) {
    Swal.fire({
        title: "Do you want to delete this Curriculum?",
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: `Cancel`,
        icon: "warning",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            fetch("curriculum/delete/" + $id, {
                method: "DELETE",
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
                    // Handle the response data
                    if (data.status == "Failed") {
                        Swal.fire({
                            title: "Failed!",
                            text: data.message,
                            icon: "error",
                            confirmButtonText: "OK!",
                        });
                    } else {
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "OK!",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                })
                .catch((error) => {
                    // Handle errors
                    Swal.fire({
                        title: "Error!",
                        text: error,
                        icon: "error",
                    });
                });
        }
    });
}
