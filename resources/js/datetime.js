document.addEventListener("DOMContentLoaded", function () {
    const table = document.getElementById("table");
    const search = document.getElementById("search");
    const datetime = document.getElementById("datetime");

    // Create a new Date object representing the current date and time
    const currentDate = new Date();

    // Get various components of the current date and time
    const currentYear = currentDate.getFullYear(); // Get the current year (e.g., 2023)
    const currentMonth = currentDate.getMonth() + 1; // Get the current month (0-11, add 1 to get actual month)
    const currentDay = currentDate.getDate(); // Get the day of the month (1-31)
    const currentHours = currentDate.getHours(); // Get the current hour (0-23)
    const currentMinutes = currentDate.getMinutes(); // Get the current minute (0-59)
    const currentSeconds = currentDate.getSeconds(); // Get the current second (0-59)
    const currentMilliseconds = currentDate.getMilliseconds(); // Get the current millisecond (0-999)

    // Display the current date and time in a desired format
    console.log(`Current Date: ${currentYear}-${currentMonth}-${currentDay}`);
    console.log(
        `Current Time: ${currentHours}:${currentMinutes}:${currentSeconds}`
    );

    datetime.innerHTML = `${currentYear}-${currentMonth}-${currentDay}`;
});
