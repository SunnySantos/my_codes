var clientAccordion = document.querySelector('#client-accordion');
var clientAccordionBtn = document.querySelector('#client-accordion .dropdown-btn')

clientAccordionBtn.addEventListener("click", dropdown(clientAccordion))

function dropdown(accordion) {
    console.log(accordion);
    return () => {
        if (accordion.classList.contains('accordion-hide')) {
            accordion.classList.remove('accordion-hide');
        } else {
            accordion.classList.add('accordion-hide');
        }
    }
}

var bdis = document.querySelectorAll('#home-products .woocommerce-Price-amount bdi');
bdis.forEach(bdi => {
    var start = bdi.innerText.indexOf('.') + 1
    var sub = bdi.innerText.substr(start).sup()
    bdi.innerHTML = bdi.innerHTML.replace(bdi.innerText.substr(start), sub)
})


var form = document.querySelector('#custom-atc form.cart');

// CREATE QUANTITY CONTAINER
var div = document.createElement('div');
div.classList.add('quantity-container');
div.append(form.querySelector('.quantity'));
form.append(div);

// CREATE BUTTONS CONTAINER
div = document.createElement('div');
div.classList.add('buttons-container');
div.append(document.querySelector('#single-product-wishlist'));
div.append(form.querySelector('button'));
form.append(div);




document.querySelectorAll('#custom-account form.edit-account p.woocommerce-form-row').forEach(row => {
    row.querySelector('input').setAttribute('placeholder', row.querySelector('label').innerText);
});

var label = document.createElement('label');
label.id = 'custom-label';
label.innerText = 'Billing Address is the same as shipping address';
var checkbox = document.createElement('input');
checkbox.type = 'checkbox';
checkbox.id = 'custom-checkbox';

document.querySelector('.col-2 .woocommerce-shipping-fields').prepend(label);
label.prepend(checkbox);
checkbox.addEventListener('change', function (e) {
    document.querySelector('#custom-checkout h3#ship-to-different-address label').click()
});

// document.querySelector('#custom-checkout h3#ship-to-different-address label').prepend(checkbox);
