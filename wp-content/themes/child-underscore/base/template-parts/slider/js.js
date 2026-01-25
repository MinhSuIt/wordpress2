var swiper = new Swiper(".mySwiper", {
    loop: true,
    spaceBetween: 15,
    // centeredSlides: true,
    slidesPerView: 1,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            // spaceBetween: 20,
        },
        768: {
            slidesPerView: 4,
            // spaceBetween: 40,
        },
        1024: {
            slidesPerView: 5,
            // spaceBetween: 50,
        },
    },

    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});