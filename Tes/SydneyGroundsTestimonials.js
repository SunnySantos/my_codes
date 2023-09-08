window.addEventListener('load', function () {
    var testimonials = document.querySelectorAll('#custom-testimonials .elementor-testimonial');
    var bullets = document.querySelectorAll('#custom-testimonials .swiper-pagination-bullet');

    if (testimonials && bullets) {
        testimonials.forEach((testimonial, index) => {
            testimonial.append(testimonial.querySelector('.elementor-testimonial__name'));
            bullets[index].append(testimonial.querySelector('.elementor-testimonial__image'));
        });
    }
});


var div = document.createElement('div');
div.classList.add('scrollable-locations');
var locations = document.querySelectorAll('.location-blurb');
var locationColumn = document.querySelector('.locations-col');

locationColumn.append(div);
locations.forEach(location => {
    div.append(location);
})

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const yearParam = urlParams.get('yearparam');
const monthParam = urlParams.get('monthparam');


document.querySelectorAll('#publication-card').forEach(card => {
    const year = card.querySelector('.publication-year').innerText;
    const month = card.querySelector('.publication-month').innerText;
    if (yearParam !== year && monthParam !== month) {
        card.remove();
    }
})



document.querySelectorAll('#cart-table .quantity').forEach(qty => {
    var text = qty.querySelector('input');
    var plus = document.createElement('button');
    var minus = document.createElement('button');
    plus.innerText = "+";
    plus.type = "button";
    minus.innerText = "-";
    minus.type = "button";
    qty.append(plus);
    qty.append(minus);

    plus.addEventListener('click', function() {
        text.value = ++text.value
    })

    minus.addEventListener('click', function() {
        text.value = --text.value
    })
})