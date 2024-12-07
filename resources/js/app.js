import { handleSubmit } from "./watchlist.js";

//Animate on Scroll - Init
AOS.init({
    once: true,
});

// Header Responsive
let burger = document.querySelector(".burger");
let close_nav = document.getElementById("close-nav");
burger.addEventListener("click", function () {
    document.body.classList.add("nav-is-open");
    document.body.style.overflowY = "hidden";
});
close_nav.addEventListener("click", function () {
    document.body.classList.remove("nav-is-open");
    document.body.style.overflowY = "visible";
});

// dark/light mode
$(".mode-toggle").on("click", function () {
    let modeIcon = $(".mode-toggle").html();
    if (modeIcon.includes("fa-moon")) {
        
        $(".mode-toggle").html('<i class="fa-solid fa-sun"><span class="hover-caption">light mode</span></i>');
        localStorage.setItem("theme", "dark");
    } else if (modeIcon.includes("fa-sun")) {

        $(".mode-toggle").html('<i class="fa-solid fa-moon"><span class="hover-caption">dark mode</span></i>');
        localStorage.setItem("theme", "light");
    }
    $("body").toggleClass("light-mode");
});

// Apply theme on page load
$(document).ready(function () {
    let theme = localStorage.getItem("theme");
    if (theme === "light") {
        document.body.classList.add("light-mode");
        $(".mode-toggle").html('<i class="fa-solid fa-moon"><span class="hover-caption">dark mode</span></i>');
    } else {
        document.body.classList.remove("light-mode");
        $(".mode-toggle").html('<i class="fa-solid fa-sun"><span class="hover-caption">light mode</span></i>');
    }
});

// Function to move the log into the nav container when the screen size is less than 600px
function moveLog() {
    const navContainer = document.querySelector('.nav-menu');
    const logContainer = document.querySelector('.log');
    
    // Check if the nav container and log container exist
    if (navContainer && logContainer) {
        // If the screen width is less than 600px, move the log
        if (window.innerWidth <= 600) {
            // Move the log container inside the nav div
            if (!navContainer.contains(logContainer)) {
                navContainer.appendChild(logContainer);
            }
        } else {
            const wrapperIcon = document.querySelector('.wrapper-icon .log-container');
            if (wrapperIcon && !wrapperIcon.contains(logContainer)) {
                wrapperIcon.prepend(logContainer);
            }
        }
    }
}
moveLog();
window.addEventListener('resize', moveLog);


function main() {
    const forms = document.querySelectorAll('.icon form');
    forms.forEach(form => { form.addEventListener("submit", handleSubmit) });
}
main();