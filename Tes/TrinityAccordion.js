var accordionItems = document.querySelectorAll('.elementor-accordion-item');

function accordion( accordionItem ) {
    var accordionTitle = accordionItem.querySelector('.elementor-tab-title');
    var accordionContent = accordionItem.querySelector('.elementor-tab-content');

    accordionTitle.addEventListener("click", function () {
        console.log(document.querySelectorAll('.elementor-accordion-item .elementor-active'))
    })
    
}

accordionItems.forEach( accordionItem => accordion( accordionItem ));