const menuToggle = document.getElementById("menu-toggle");
const menuNav = document.getElementById("menu-nav");

const toggleMenu = () => {
    console.log("called toggleMenu")
    menuNav.classList.toggle("menu-toggle");
}

menuToggle.addEventListener("click", toggleMenu);

const acc = document.getElementsByClassName("budgetaccordion");
let i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
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