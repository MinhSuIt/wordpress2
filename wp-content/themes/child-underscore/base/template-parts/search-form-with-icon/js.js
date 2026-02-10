const body = document.querySelector("body")
const searchIcon = document.querySelector(".custom-search-icon")
const searchLightbox = document.querySelector("#search-lightbox")

searchIcon.addEventListener("click", (e) => {
    e.preventDefault()
    body.classList.add("body-scroll-lock--active")
    searchLightbox.classList.add("active")
})