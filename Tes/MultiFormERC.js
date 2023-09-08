var wrapper = document.querySelector('#multi-form .elementor-form-fields-wrapper');
var h3 = document.querySelector('.custom-h3-1');
var text = document.querySelector('.custom-text-1');
var divider = document.querySelector('.custom-divider-1');

var input = document.querySelector('#multi-form .e-form__step > div:nth-child(8)');

insertAfter(document.querySelector('#multi-form .e-field-step'), h3);
insertAfter(h3, text);
insertAfter(input, divider);

h3 = document.querySelector('.custom-h3-2');
text = document.querySelector('.custom-text-2-1');
insertAfter(divider, h3);
insertAfter(h3, text)
input = document.querySelector('#multi-form .e-form__step > .elementor-field-required:nth-child(15)');
divider = document.querySelector('.custom-divider-2');
insertAfter(input, divider);
text = document.querySelector('.custom-text-2-2');
insertAfter(divider, text);

function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}


var bdis = document.querySelectorAll('#custom-atc .woocommerce-Price-amount bdi');
bdis.forEach(bdi => {
    var start = bdi.innerText.indexOf('.') + 1;
    var sub = bdi.innerText.substr(start).sup();
    if (bdi.innerText.substr(start) !== '00') {
        bdi.innerHTML = bdi.innerHTML.replace('.' + bdi.innerText.substr(start), '.' + sub);
    } else {
        bdi.innerHTML = bdi.innerHTML.replace('.' + bdi.innerText.substr(start), '');
    }
});


var totalRating = 0;

document.querySelectorAll('#custom-data-tabs .rating').forEach(rating => {
    totalRating += parseFloat(rating.innerText);
})

console.log(totalRating / document.querySelectorAll('#custom-data-tabs .rating').length);