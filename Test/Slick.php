<?php
function initSlickSlider()
{
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'initSlickSlider');


add_action("wp_footer", function () {
?>
    <script>
        jQuery(function($) {
            $(document).ready(function() {
                $('#explore-slider').slick({
                    dots: false,
                    arrows: false,
                    infinite: true,
                    speed: 300,
                    autoplay: false,
                    autoplaySpeed: 2000,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    responsive: [
                        {
                            breakpoint: 900,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                            },
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                            },
                        },
                    ],
                });
            });
        });
    </script>
<?php
});
