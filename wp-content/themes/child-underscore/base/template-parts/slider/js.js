let config = {
    loop: true,
    spaceBetween: 0,
    // centeredSlides: true,
    slidesPerView: 1,
    autoplay: {
        delay: 1500,
        disableOnInteraction: false,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 15,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 25,
        },
    },
}
if (sliderData.display_pagination == "1") {
    config.pagination = {
        el: ".swiper-pagination",
        clickable: true,
    }
}
if (sliderData.display_prev_next == "1") {
    config.navigation = {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    }
}
var swiper = new Swiper(".mySwiper", config);