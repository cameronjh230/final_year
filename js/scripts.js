const menuToggle = document.getElementById("menu-toggle");
const menuNav = document.getElementById("menu-nav");

const toggleMenu = () => {
    console.log("called toggleMenu")
    menuNav.classList.toggle("menu-toggle");
}

menuToggle.addEventListener("click", toggleMenu);

const week = document.getElementsByClassName("weeklysummaryaccordion");
    let i;

    for (i = 0; i < week.length; i++) {
        week[i].addEventListener("click", function() {
            this.classList.toggle("active");

            /* Hides and shows active panel */
            let panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
}

const month = document.getElementsByClassName("monthaccordion");
let b;

for (b = 0; b < month.length; b++) {
    month[b].addEventListener("click", function() {
        this.classList.toggle("active");

        /* Hides and shows active panel */
        let panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}



 const details = document.getElementsByClassName("detailsaccordion");
let z;

for (z = 0; z < details.length; z++) {
    details[z].addEventListener("click", function() {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        let panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}

