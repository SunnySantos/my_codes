jQuery(function ($) {
    $(document).ready( function() {
        $(window).resize( function() {
            const swiperContainerWidth = $('.elementor-main-swiper').innerWidth();
            if(swiperContainerWidth > 700 && swiperContainerWidth < 838) {
                $('.swiper-slide').css('width', "50%");
            }
        });
    });
})


