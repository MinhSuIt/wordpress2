const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const submenuLinks = document.querySelectorAll(".has-submenu>.nav-link");

hamburger.onclick = () => {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
}

/* submenu mobile */
submenuLinks.forEach(link => {
    link.onclick = e => {
        if (window.innerWidth <= 768) {
            e.preventDefault();
            const submenu = link.nextElementSibling;
            document.querySelectorAll(".submenu.active").forEach(m => {
                if (m !== submenu) {
                    m.classList.remove("active");
                    m.previousElementSibling.classList.remove("active");
                }
            });
            submenu.classList.toggle("active");
            link.classList.toggle("active");
        }
    }
});


// Đóng menu khi click ra ngoài
document.addEventListener("click", (e) => {
    if (window.innerWidth <= 768) {
        if (!e.target.closest(".navbar") && navMenu.classList.contains("active")) {
            navMenu.classList.remove("active");
            hamburger.classList.remove("active");

            document.querySelectorAll(".submenu.active").forEach(sub => {
                sub.classList.remove("active");
                sub.previousElementSibling.classList.remove("active");
            });
        }
    }
});
