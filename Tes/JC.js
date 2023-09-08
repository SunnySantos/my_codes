window.addEventListener('load', function () {
    var customReviews = document.querySelector('#custom-reviews');
    if (customReviews) {
        var slides = customReviews.querySelectorAll('.swiper-slide');

        slides.forEach(slide => {
            var name = slide.querySelector('.elementor-testimonial__name');
            var stars = slide.querySelector('.elementor-star-rating');
            slide.querySelector('.elementor-testimonial__content').append(stars);
            slide.querySelector('.elementor-testimonial__content').append(name);
        });

        var arrows = customReviews.querySelectorAll('.elementor-swiper-button');
        var div = document.createElement('div');

        arrows.forEach(arrow => {
            div.append(arrow);
        });

        customReviews.querySelector('.elementor-main-swiper ').append(div);
    }
});