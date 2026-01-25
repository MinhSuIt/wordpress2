const btn = document.getElementById("scrollTo");

window.addEventListener("scroll", function () {
    if (window.scrollY > 300) {
        btn.style.display = "block";
    } else {
        btn.style.display = "none";
    }
});