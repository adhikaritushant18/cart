document.addEventListener("DOMContentLoaded", function() {
    var swiper = new Swiper(".home-slider", {
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});