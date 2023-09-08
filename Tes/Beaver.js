jQuery(function ($) {
    $(document).ready(function () {
        $("#wwo-section > div > div > div").slick({
            dots: false,
            arrows: false,
            infinite: true,
            speed: 300,
            autoplay: false,
            autoplaySpeed: 2000,
            slidesToShow: 4,
            slidesToScroll: 1
        });
    });
});

var reviewLink = document.querySelector('.woocommerce-review-link');
var reviewCount = reviewLink.querySelector('.woocommerce-review-link span').innerText;
reviewLink.innerText = '(' + reviewCount + ')';

window.addEventListener('load', function () {
    var login = document.querySelector('.cta-login');
    var lostPassword = login.querySelector('.elementor-lost-password');
    var rememberMe = login.querySelector('.elementor-remember-me');

    rememberMe.append(lostPassword);
});


var customAddToCart = document.querySelector('#custom-atc');
var colors = customAddToCart.querySelectorAll('.color-variable-item');

colors.forEach(color => {
    color.addEventListener('click', function () {
        setTimeout(() => {
            var flavor = customAddToCart.querySelector('#flavor option:last-child').value;
            console.log(flavor);
        }, 100)
    })
});














// Select the element to be observed
var target = document.querySelector("#cart > div > div > div.e-cart__container")

// Create a MutationObserver to observe the target element
var observer = new MutationObserver(function (mutations) {
    // Reapply your JavaScript code here

    document.querySelector('.variations_form').onchange = function () {
        const sku = document.querySelector('.product_meta .sku').textContent;
        const title = document.querySelector('h1.product_title.entry-title');
        const breadcrumbsLast = document.querySelector('.breadcrumb_last');
        const fakePrice = document.querySelector('#custom-price .price');
        const realPrice = document.querySelector('#custom-atc .price');
        title.textContent = sku;
        fakePrice.innerHTML = realPrice.innerHTML;
    }

    var onSale = document.querySelectorAll('.single_variation_wrap .woocommerce-Price-currencySymbol').length > 1
    document.querySelector('.onsale').style.display = onSale ? '' : 'none'

    document.querySelector('.variations_form').onchange = function () {
        var onSale = document.querySelectorAll('.single_variation_wrap .woocommerce-Price-currencySymbol').length > 1

        document.querySelector('.onsale').style.display = onSale ? '' : 'none'

    }
});

// Start observing the target element for changes
observer.observe(target, {
    attributes: true,
    childList: true,
    subtree: true
});





window.addEventListener('load', function () {
    if (!document.querySelector('.variations_form')) return;
    var onSale = document.querySelectorAll('.single_variation_wrap .woocommerce-Price-currencySymbol').length > 1;
    document.querySelector('.onsale').style.display = onSale ? '' : 'none';
    document.querySelector('.variations_form').onchange = function () {
        const sku = document.querySelector('.product_meta .sku').textContent;
        const title = document.querySelector('h1.product_title.entry-title');
        const breadcrumbsLast = document.querySelector('.breadcrumb_last');
        const fakePrice = document.querySelector('#custom-price .price');
        const realPrice = document.querySelector('#custom-atc .price');
        title.textContent = sku;
        fakePrice.innerHTML = realPrice.innerHTML;

        onSale = document.querySelectorAll('.single_variation_wrap .woocommerce-Price-currencySymbol').length > 1;
        var truePrice = document.querySelectorAll('.single_variation_wrap .woocommerce-Price-amount')[onSale ? 1 : 0].innerHTML;

        fakePrice.innerHTML = truePrice;
    }
})


window.addEventListener('load', function () {
    var displayProduct = '';
    var productTableImagesSrc = [];
    var interestedProductImagesSrc = []
    var productTableImages = document.querySelectorAll('#cart table .attachment-woocommerce_thumbnail');
    var products = document.querySelectorAll('#upsell .product');
    productTableImages.forEach(img => {
        productTableImagesSrc.push(img.src)
    })

    products.forEach(product => {
        var src = product.querySelector('.attachment-woocommerce_thumbnail').src
        if (productTableImagesSrc.includes(src)) {
            product.remove()
        }
    })

    products = document.querySelectorAll('#upsell .product');
    console.log(products.length);

    if (products.length > 1) {
        products.forEach((product, index) => {
            if (index !== 0) {
                product.remove()
            }
        })
    }

});

window.addEventListener('load', function () {
    var slides = document.querySelector('#custom-slides .elementor-slides-wrapper');
    if (slides) {
        var button = document.querySelector('#slide-shopnow-btn');
        slides.append(button);
    }
});

var p = document.querySelector('.elementor-element-0ca22c3 p');
var values = [0, 0]

var count2020Currency = 4000;
var count2021Currency = 11550;

document.querySelector('.elementor-field-group-count_2020').addEventListener('input', (e) => compute(e, count2020Currency, 0))
document.querySelector('.elementor-field-group-count_2021').addEventListener('input', (e) => compute(e, count2021Currency, 1))

function compute(e, currency, pos) {
    var value = e.target.value;
    values[pos] = value ? parseFloat(value) * currency : 0;
    if(values[0] <= count2020Currency && values[1] <= count2021Currency) {
        p.innerText = ''
        return
    }
    p.innerText = values.reduce((sum, val) => sum + val, 0);
}








document.querySelector('#custom-cart form').append(document.querySelector('#custom-name-form .custom-form'))

document.querySelector('#custom-cart .woocommerce-variation-add-to-cart button').cloneNode(true)

const tr = document.createElement('tr');
const th = document.createElement('th');
th.classList.add('label')
const td = document.createElement('td')
td.classList.add('value')
tr.append(th)
tr.append(td)
th.append(document.querySelector('#custom-name-form label'))
td.append(document.querySelector('#custom-name-form textarea'))

document.querySelector('#custom-cart .variations tbody tr:first-child').after(document.querySelector('#custom-cart .variations tbody tr:first-child'), tr)