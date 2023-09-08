window.addEventListener("scroll", function () {
    var banner = document.querySelector('#banner');
    var height = banner.offsetHeight;
    var scrollTop = document.documentElement.scrollTop;
    banner.style.setProperty('--background', `rgba(0, 0, 0, ${scrollTop / height})`)
});



window.addEventListener("scroll", function () {
    var whatWeDo = document.querySelector('#what-we-do');
    var height = whatWeDo.offsetHeight;
    var iconBoxes = whatWeDo.querySelectorAll('.custom-iconbox');
    var scrollTop = whatWeDo.querySelector('.elementor-row').offsetTop
    iconBoxes.forEach((e, i) => {
        var translate = ((i + 1) * (height * 0.13)) - scrollTop;
        e.setAttribute('style', `transform: translate3D(0,${translate > 0 ? translate : 0}px, 0)`)
    })
});


const whatWeDo = document.querySelector('#what-we-do');
const iconBoxes = whatWeDo.querySelectorAll('.custom-iconbox');
const row = whatWeDo.querySelector('.elementor-row');
const scrollTop = row.getBoundingClientRect().top;
for (let i = 0; i < iconBoxes.length; i++) {
    const e = iconBoxes[i];
    var translate = ((i + 1) * (height * 0.13)) - scrollTop;
    e.setAttribute('style', `transform: translate3D(0,${translate > 0 ? translate : 0}px, 0)`)
}

function updatePositions() {
    window.requestAnimationFrame(updatePositions);
}

window.addEventListener('scroll', updatePositions);

window.addEventListener("scroll", function () {
    var target = document.getElementById("hehe");

    var height = window.innerHeight;

    console.log(height);

    var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;

    // Change this if you want it to fade faster
    height = height / 1;

    target.style.opacity = (height - scrollTop) / height;
})


var animatedHeadline = document.querySelectorAll('#banner h1 span');
animatedHeadline.forEach(a => {
    var char = a.innerHTML.split('');
    console.log(char);
    // a.innerHTML = "";
    // char.forEach(ch => {
    //     console.log(ch);
    //     // var span = document.createElement('span');
    //     // span.innerText = ch
    //     // a.append(span)
    // })
})


const headlines = document.querySelectorAll('.elementor-headline > span');
const text = [...headlines].map(headline => headline.innerText);

text.forEach((t, i) => {
    const letters = t.split('').map((letter, index) => {
        const span = document.createElement('span');
        span.innerText = letter === ' ' ? '\xa0' : letter;
        span.style.transform = 'translateY(100px)';
        span.style.display = 'inline-block';
        span.style.transition = 'all 200ms ease';
        span.style.opacity = 0;
        setTimeout(() => {
            span.style.transform = "translateY(0)"
            span.style.opacity = 1
        }, (index + 1) * 100);
        return span;
    });

    headlines[i].innerHTML = '';
    headlines[i].append(...letters);
});








var projects = document.querySelectorAll('.project-post-card');
var projectPopupTitle = '', projectPopupLocation = '', projectPopupDescription = '';
var projectAccordion;

projects.forEach((project, index) => {
    const readMore = project.querySelector('.read-more-btn');
    readMore.addEventListener('click', function () {
        projectPopupTitle = project.querySelector('.project-title h3').innerText;
        projectPopupLocation = project.querySelector('.project-location .elementor-widget-container').innerText;
        projectPopupDescription = project.querySelector('.project-description p').innerText;
        projectAccordion = project.querySelector('.project-accordion').cloneNode(true);
    });
});


jQuery(document).on('elementor/popup/show', () => {
    var popup = document.querySelector('#elementor-popup-modal-2934');
    popup.querySelector('#project-title h2').innerText = projectPopupTitle
    popup.querySelector('#project-location .elementor-widget-container p').innerText = projectPopupLocation;
    popup.querySelector('#project-description p').innerText = projectPopupDescription;
    popup.querySelector('#project-content').append(projectAccordion)
});

document.querySelectorAll('#project-content .jet-accordion__item').forEach(item => {
    item.querySelector('#project-content .jet-toggle__control').addEventListener('click', function () {
        item.querySelector('.jet-toggle__content').classList.toggle('show');
    })
})




// jQuery( document ).on( 'elementor/popup/hide', ( event, id, instance ) => {
// 	if ( id === 2934 ) {
//         console.log(document.querySelector('#elementor-popup-modal-2934 .project-content'));
//         // projects[projectIndex].querySelector('.project-content').append(document.querySelector('#elementor-popup-modal-2934 .project-content'));
// 	}
// } );



window.addEventListener('load', function () {
    document.querySelectorAll('.gazebos-slides .swiper-pagination-bullets > span').forEach((bullet, index) => {
        bullet.innerText = (index + 1)
    })

    var p = document.createElement('p');
    p.innerText = ("/ " + document.querySelectorAll('.gazebos-slides .swiper-pagination-bullets > span').length);

    document.querySelector('.gazebos-slides .swiper-pagination-bullets').append(p);
});














document.querySelectorAll('#cart-btn .cart_item').forEach(item => {
    var price = item.querySelector('.woocommerce-Price-amount').innerText.match(/([0-9]{1,3},([0-9]{3},)*[0-9]{3}|[0-9]+)(.[0-9][0-9])/);
    if (price) {
        var total = (parseInt(item.querySelector('.product-quantity').innerText.replace(' ×', '')) * parseFloat(price[0]));
        item.querySelector('.woocommerce-Price-amount').innerText = (item.querySelector('.woocommerce-Price-currencySymbol').innerText + total.toFixed(2));
    }
});




// ADD PLUS AND MINUS BUTTON ON QUANTITY FIELD
setInterval(() => {
    if(!document.querySelector('#custom-atc .quantity .add')) {
        document.querySelectorAll('#custom-atc .quantity').forEach(qty => {
            var text = qty.querySelector('input');
            var plus = document.createElement('button');
            var minus = document.createElement('button');
            plus.innerText = "+";
            plus.type = "button";
            plus.classList.add('add');
            minus.innerText = "-";
            minus.type = "button";
            minus.classList.add('minus');
            qty.append(plus);
            qty.prepend(minus);

            plus.addEventListener('click', function() {
                var val = ++text.value;
                var regular = document.querySelector('#custom-atc .price').getAttribute('data-regular');
                var sale = document.querySelector('#custom-atc .price').getAttribute('data-sale')
                text.value = val;

                if(document.querySelector('div.product.sale')) { 
                    if(regular && regular.includes('.')) {
                        document.querySelector('#custom-atc del bdi').innerText = '$' + (parseFloat(regular) * val).toFixed(2);
                    }else {
                        document.querySelector('#custom-atc del bdi').innerText = '$' + (parseFloat(regular) * val);
                    }
                }else {
                    if(regular && regular.includes('.')) {
                        document.querySelector('#custom-atc bdi').innerText = '$' + (parseFloat(regular) * val).toFixed(2);
                    }else {
                        document.querySelector('#custom-atc bdi').innerText = '$' + (parseFloat(regular) * val);
                    }
                }


                if(document.querySelector('div.product.sale')) {
                    if(sale && sale.includes('.')) {
                        document.querySelector('#custom-atc ins bdi').innerText = '$' + (parseFloat(sale) * val).toFixed(2);
                    }else {
                        document.querySelector('#custom-atc ins bdi').innerText = '$' + (parseFloat(sale) * val)
                    }
                }

            });

            minus.addEventListener('click', function() {
                var val = --text.value;
                var regular = document.querySelector('#custom-atc .price').getAttribute('data-regular');
                var sale = document.querySelector('#custom-atc .price').getAttribute('data-sale')
                text.value = val;

                if(document.querySelector('div.product.sale')) { 
                    if(regular && regular.includes('.')) {
                        document.querySelector('#custom-atc del bdi').innerText = '$' + (parseFloat(regular) * val).toFixed(2);
                    }else {
                        document.querySelector('#custom-atc del bdi').innerText = '$' + (parseFloat(regular) * val);
                    }
                }else {
                    if(regular && regular.includes('.')) {
                        document.querySelector('#custom-atc bdi').innerText = '$' + (parseFloat(regular) * val).toFixed(2);
                    }else {
                        document.querySelector('#custom-atc bdi').innerText = '$' + (parseFloat(regular) * val);
                    }
                }


                if(document.querySelector('div.product.sale')) {
                    if(sale && sale.includes('.')) {
                        document.querySelector('#custom-atc ins bdi').innerText = '$' + (parseFloat(sale) * val).toFixed(2);
                    }else {
                        document.querySelector('#custom-atc ins bdi').innerText = '$' + (parseFloat(sale) * val)
                    }
                }
            });
        });
    }
}, 1000);




// RESTRUCTURE PRODUCT CATEGORY CHECKBOXES
var ul = document.querySelector('#woof-filter .woof_block_html_items > ul');
var li = ul.querySelectorAll('li');
li.forEach(l => {
    ul.append(l);
});

// REMOVE UNNECESSARY UNORDERED LISTS
ul = ul.querySelectorAll('ul');
ul.forEach(u => {
    u.remove();
});





// program to check an Armstrong number of three digits


[153,234,567,345].forEach(number => console.log(number == number.toString().split('').reduce( (a, b) => parseInt(b)**3 + a, 0 ) ? `${number} is an Armstrong number` : `${number} is not an Armstrong number.`))

[153,234,567,345].forEach(a=>console.log(`${a}`,`${a}`.split('').reduce((b,c)=>b+(c**3),0)==a?'is':`is not`, 'an armstrong number'))

[153,234,567,345].forEach(a => console.log(a == eval(`${a}`.split('').map(b => b**3).join('+')) ? `${a} Is Armstrong number` : `${a} is not an armstrong number`))




[1001, 223, 4455, 292, 11, 45].forEach(a => console.log(`${a}`,`${a}`.split('').reverse().join('') == a ? 'is' : 'is not', 'palindrome numbers'))



[1001, 223, 4455, 292, 11, 45].forEach(a => console.log(`${a}`,`${a}`.split('').reverse().join('') == a ? 'is' : 'is not', 'palindrome numbers'))




function wrap(nodes) {
    var div = document.createElement('div')
    div.className = 'wrapper'
    div.append(...nodes)
    return div;
}
const get = (c) => document.querySelector(c);
const getAll = (c) => document.querySelectorAll(c);
getAll('.title').forEach(t => get('.post-section .e-con-inner').append(wrap([get('.title'), get('.content'), get('.button')])))




const cat = [
    {
        name: 'Category 1',
        children: [
            {
                name: 'Category 1 - 1'
            },
            {
                name: 'Category 1 - 2'
            },
        ]
    },
    {
        name: 'Category 2'
    }
]