


window.addEventListener("resize", function (e) {
    var content = document.querySelector('#custom-accordion .elementor-tab-content');
    var filter = document.querySelector('#filter-container');
    var select = document.querySelector('.woof_container_mselect');


    if (e.target.outerWidth < 1024) {
        if (!content.querySelector('#filter-container') || !content.querySelector('.woof_container_mselect')) {
            content.append(filter)
            content.append(select)
        }
    } else if (content.querySelector('#filter-container') || content.querySelector('.woof_container_mselect')) {

        document.querySelector('#main-filter').append(filter)
        document.querySelector('.custom-filter').append(select)
    }
})