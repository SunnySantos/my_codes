var reviewSlides = document.querySelectorAll('.custom-reviews .swiper-slide');


reviewSlides.forEach(slide => {
    slide.querySelector('.elementor-testimonial__cite').prepend(slide.querySelector('.elementor-testimonial__content'));
})