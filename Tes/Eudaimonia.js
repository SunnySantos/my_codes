document.addEventListener("DOMContentLoaded", () => {
    const rating = document.querySelector('.custom-testimonials .elementor-star-rating');
    const title = document.querySelector('.custom-testimonials .elementor-testimonial__title');
    const content = document.querySelector('.custom-testimonials .elementor-testimonial__content');
    content.prepend(rating)
    content.prepend(title)
});




