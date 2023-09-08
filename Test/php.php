<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;
wp_enqueue_style('slick_css');
wp_enqueue_script('slick_js');
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

//$pm = get_post_meta(get_the_ID());
//p_r($pm);

global $cartagena;

$selected_language = apply_filters('wpml_current_language', null);
$base_post_id = $cartagena->base_post_id($post->ID);
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>


    <div class="ilab-custom-sec">
        <h2><?php echo get_the_title(); ?></h2>
        <?php
        $stitle = get_the_title();
        ?>
        <input id="copy-link" type="hidden" value="<?php echo get_the_permalink() ?>" />
        <div class="ilab-ss">
            <ul class="">
                <li class="ilab-share"><i class="fa fa-share-square"></i> Share <i class="fa fa-caret-down"></i></li>
                <div class="ss-dd">
                    <span class="ilab-custom-close"><i class="fa fa-times"></i></span>
                    <li><a onclick="copyFunction()"><i class="fa fa-link"></i> <span class="ilab-copy-text">Copy Link</span></a></li>
                    <li><a href="mailto:?body=I found this on Everything Cartagena and thought youd love it:<?php echo urldecode(urlencode($stitle)); ?> %0D%0A%0D%0ACheck it out - <?php echo get_the_permalink() ?> &subject=Check out this Experience on Everything Cartagena!"><i class="fa fa-envelope"></i> Email</a></li>
                </div>
                <li><?php echo do_shortcode('[favorite_button post_id="' . get_the_id() . '" site_id=""]') ?></li>
            </ul>
        </div>
    </div>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    //do_action( 'woocommerce_before_single_product_summary' );

    ?>
    <div class="woocommerce-product-gallery woocommerce-product-gallery--without-images woocommerce-product-gallery--columns-4 images">
        <?php


        if (have_rows('images', $base_post_id)) :

            $service_image = "";

            while (have_rows('images', $base_post_id)) : the_row();
                if (!empty($service_image)) break;
                $service_image = get_sub_field('image', $base_post_id);
            endwhile;
        endif;

        $product_video = get_field("video_en");

        if ($product_video) {
        ?>
            <video id="ilab-prod-video" style="width:100%;" poster="<?php echo get_the_post_thumbnail_url() ?>" controls src="<?php echo $product_video; ?>">
                Your browser does not support the
                <code>audio</code> element.
            </video>
        <?php
        } else if (!$product_video && $service_image) {

        ?>
            <div class="lightgallery">
                <a href="<?php echo $service_image ?>"><img src="<?php echo $service_image ?>" /></a>
            </div>

        <?php
        } else {
            // load featured image;
            global $post;
            $image_url = get_the_post_thumbnail_url($post);
        ?>
            <img src="<?php echo $image_url ?>" />
        <?php
        }
        $html = '<div class="ilab-st-wpr">';
        $html .= '<div class="ilab-st-inr">';

        $service_time = get_field("service_time");
        if ($service_time) :

            $html .= '<p><i class="fa fa-clock-o"></i>' . $service_time . '</p>';
        endif;
        $html .= '</div>';
        $html .= '<div class="ilab-st-inr ilab-sl">';
        $html .= '<p><i class="fa fa-map-marker"></i>' . get_field("location") . '</p>';
        $html .= '</div>';
        $html .= '</div>';
        //echo $html;
        ?>

        <div class="tour_info_box bookable_product_tour_info">
            <?php
            $tour_info_header         = get_field('tour_info_header');

            $location_text            = get_field('location_text');
            $location                = get_field('location');

            $operation_time_text    = get_field('operation_time_text');
            $pack_durations            = get_field('pack_duration');

            $operation_time            = get_field('operation_time');

            $duration_time            = get_field('duration_time');
            $duration_description    = get_field('duration_description');

            $group_size_text        = get_field('group_size_text');
            $group_size                = get_field('group_size');

            $f_five__header      = get_field('f_five__header');
            $f_five__text       = get_field('f_five__text');

            $pdf_link_text            = get_field('pdf_link_text');
            $pdf_link                = get_field('pdf_link');


            ?>
            <?php if ($tour_info_header) { ?>
                <h4 class="tour_info_heading"><?php echo $tour_info_header; ?></h4>
                <hr>
            <?php } ?>

            <?php if ($location_text) { ?>
                <span class="location_text"><span class="tour-info-sh"><?php echo $location_text; ?>:</span> <?php echo $location; ?></span>
                <br>
            <?php } ?>

            <?php if ($operation_time_text) { ?>
                <span class="operation_time_text"><span class="tour-info-sh"><?php echo $operation_time_text; ?>:</span> <?php echo $operation_time; ?></span>
                <br>
            <?php } ?>



            <?php


            if ($pack_durations) {
                $time_slot_heading;
                $time_slots;
                $timeSlots = [];

                foreach ($pack_durations as $pack_duration) {
                    $time_slot_heading     = $pack_duration['time_slot_heading'];
                    $time_slots            = $pack_duration['time_slot'];

                    $timeSlots[$time_slot_heading] = $time_slots;
                }

                $time_slot_heading     = explode('-', $time_slot_heading);
                $time_slots         = explode('to', $time_slots);

                $currentDay = date('l');
                $newTimeSlots = [];
                foreach ($timeSlots as $key => $val) {
                    if ($key == $currentDay) {
                        //echo $val;

                        function SplitTime($StartTime, $EndTime, $Duration = "60")
                        {
                            $ReturnArray = array(); // Define output
                            $StartTime    = strtotime($StartTime); //Get Timestamp
                            $EndTime      = strtotime($EndTime); //Get Timestamp

                            $AddMins  = $Duration * 60;

                            while ($StartTime <= $EndTime) //Run loop
                            {
                                $ReturnArray[] = date("g:i a", $StartTime);
                                $StartTime += $AddMins; //Endtime check
                            }
                            return $ReturnArray;
                        }

                        $val = explode('to', $val);

                        $startTime = $val[0];
                        $endTime     = $val[1];
                        $newEndTime = date('H:i:s', strtotime($endTime) - (15 * 60));

                        $newTimeSlots[] = SplitTime($startTime, $newEndTime, "15");

                        //print_r($newTimeSlots); 

                    }
                }
            }

            add_shortcode(
                'TimeSlots',
                function ($attributes, $content, $shortcode_name) use ($newTimeSlots) {
                    ob_start();
                    if ($newTimeSlots) :
                        echo '<div class="custom_time_picker"><div id="time_slots"><ul>';
                        //$lastSlot = sizeof($newTimeSlots);
                        //print_r($newTimeSlots);
                        foreach ($newTimeSlots as $timeSlot) :
                            foreach ($timeSlot as $key => $val) :
            ?>
                            <li class="<?php if ($_COOKIE["selectedTime"] == $val) { ?> selected<?php } ?>"><?php echo $val; ?></li>
            <?php
                            endforeach;
                        endforeach;
                        echo '</ul></div></div>';
                    endif;
                    return ob_get_clean();
                }
            );
            ?>

            <?php if ($duration_time) { ?>
                <span class="duration_time"><span class="tour-info-sh"><?php echo $duration_time; ?>:</span> <?php echo $duration_description; ?></span>
                <br>
            <?php } ?>

            <?php if ($group_size_text) { ?>
                <span class="group_size_text"><span class="tour-info-sh"><?php echo $group_size_text; ?>:</span> <?php echo $group_size; ?></span>
            <?php } ?>
            <?php if ($pdf_link_text) { ?>
                <br>
                <a class="ilab-btn" href="<?php echo $pdf_link_text; ?>" target="_blank"><?php echo $pdf_link; ?></a>
            <?php } ?>

            <?php if ($f_five__text) { ?>
                <span class="operation_time_text"><span class="tour-info-sh"><?php echo $f_five__header; ?>:</span> <?php echo $f_five__text; ?></span>
                <br>
            <?php } ?>
        </div>

        <?php
        $google_reviews_map_embed_code = get_field("google_reviews_map_embed_code", $base_post_id);

        if ($google_reviews_map_embed_code) {
        ?>
            <div class="for-desktop" id="google_review_frame">

                <?php echo $google_reviews_map_embed_code; ?>
                <!--<iframe src="<?php echo strip_tags($google_reviews_map_embed_code); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
            </div>
        <?php
        }
        ?>

    </div>

    <div class="summary entry-summary">
        <?php

        echo '<b>' . get_field("descripcion_short_en", $base_post_id) . '</b>';

        ?>
        <div class="price-adj price_adj_<?php echo $base_post_id; ?>">
            <p class="price-per-person"><?php echo get_post_meta($base_post_id, "_phive_booking_pricing_display_cost_suffix", true); ?></p>
            <?php echo do_shortcode('[ilab-product-price]'); ?>
            <?php //echo $product->get_price_html(); 
            ?>
        </div>

        <?php //$__base_price = $product->get_price(); 
        ?>
        <?php //echo do_shortcode('[woomc-convert value="'.$__base_price.'"]'); 
        ?>
        <?php //echo do_shortcode('[woomc-convert value="'.$__base_price.'" currency="EUR"]'); 
        ?>
        <?php

        //$pm = get_post_meta(get_the_ID());

        //p_r($pm);

        /**
         * Hook: woocommerce_single_product_summary.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         * @hooked WC_Structured_Data::generate_product_data() - 60
         */



        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        do_action('woocommerce_single_product_summary');

        if (has_term('dining', 'product_cat')) {
            echo '<div id="makereservation">';
            echo do_shortcode('[gravityform id="1" title="true"]');
            echo '</div>';
            /*
            $time_interval = get_field('time_interval');
            //print_r($time_interval);
            if($time_interval):
            echo '<div class="custom_time_picker"><div class="time-intervals">';
            foreach($time_interval as $val) {
              echo '<div class="selectbtn" data-value="'.$val['value'].'" data-pid="'.get_the_ID().'">'.$val['label'].'</div>';
            }
            echo '</div>';
            echo '<div id="time_slots"></div></div>';
            endif;
			*/
        ?>
            <style>
                .custom_time_picker {
                    grid-column: span 12;
                }

                #time_slots {
                    /*
          background: #f5f5f5 !important;
			*/
                }

                #time_slots ul {
                    grid-gap: 0;
                    margin: 0;
                    padding: 0;
                    list-style: none;
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    flex-wrap: wrap;
                }

                #time_slots ul li {
                    color: #777;
                    list-style-type: none !important;
                    display: inline-block;
                    text-align: center;
                    margin-bottom: 0;
                    width: 100%;
                    max-width: calc(25% - 1px);
                    font-size: 15px;
                    background-color: #f5f5f5;
                    cursor: pointer;
                    margin: 0px;
                    border: 0 solid #fff;
                }

                #time_slots ul li.selected,
                #time_slots ul li.selected:hover,
                #time_slots ul li:hover {
                    background-color: #1f4ca2;
                    color: #fff;
                }

                .gform-theme-datepicker:not(.gform-legacy-datepicker) .ui-datepicker-header {
                    border-radius: 0;
                }

                .gform_confirmation_wrapper+script+.custom_time_picker {
                    display: none;
                }
            </style>
            <script>
                jQuery(function($) {
                    $(document).ready(function() {
                        /*
                           $('#input_1_21').val('<?php echo $google_reviews_map_embed_code; ?>');
                           */
                        $("#input_1_20_raw").keyup(function() {
                            $("#input_1_19").val($('#input_1_20').val());
                        });

                        $(document).on('gform_confirmation_loaded', function(event, formId) {
                            //$('.custom_time_picker').remove();
                            document.cookie = "selectedTime=";
                        });

                        jQuery(document).bind('gform_post_render', function() {
                            //$('.custom_time_picker').remove();
                            document.cookie = "selectedTime=";
                        });

                        $('.custom_time_picker').insertAfter('#field_1_13');


                        $('#input_1_12').on('change', function() {
                            const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

                            const d = new Date($(this).val());
                            console.log(d)
                            let day = weekday[d.getDay()];
                            //alert(day);
                            var pid = <?php echo get_the_ID(); ?>;
                            $.ajax({
                                type: "POST",
                                url: ajax_get_time_slots.ajaxurl,
                                data: {
                                    action: 'get_time_slots',
                                    day: day,
                                    pid: pid,
                                    //date: $(this).val()
                                },
                                success: function(data) {
                                    //console.log(data);
                                    $('.get-time-slots').html(data);
                                },
                                error: function(e) {
                                    //alert('system error');
                                }
                            });
                        });

                        console.log($('#input_1_12').val());

                        $(window).load(function() {
                            if ($('#input_1_12') != '') {
                                const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

                                const d = new Date($('#input_1_12').val());
                                console.log(d)
                                let day = weekday[d.getDay()];
                                //alert(day);
                                var pid = <?php echo get_the_ID(); ?>;
                                $.ajax({
                                    type: "POST",
                                    url: ajax_get_time_slots.ajaxurl,
                                    data: {
                                        action: 'get_time_slots',
                                        day: day,
                                        pid: pid,
                                        date: $('#input_1_12').val()
                                    },
                                    success: function(data) {
                                        //console.log(data);
                                        $('.get-time-slots').html(data);
                                    },
                                    error: function(e) {
                                        //alert('system error');
                                    }
                                });
                            }

                        });


                        $(document).on('click', '#time_slots ul li', function() {
                            var inputVal = $(this).html();
                            var inputVal2 = $('#input_1_13').val();
                            $('#input_1_13').val(inputVal);
                            $(this).addClass('selected');
                            $(this).siblings('li').removeClass('selected');
                            document.cookie = "selectedTime=" + inputVal;
                            //$.cookie('selectedTime', inputVal, { path: '/' });
                        });
                    });
                });
            </script>
        <?php
        }

        ?>
    </div>

    <div class="clear clearfix 11"></div>



    <?php
    ilab_service_misc($base_post_id, $selected_language, $slider_images);

    //add_action( 'woocommerce_after_single_product_summary', 'ilab_service_time', 5 );
    //add_action( 'woocommerce_after_single_product_summary', 'ilab_service_misc', 10 );
    /*function ilab_service_time(){
	$html = '<div class="ilab-st-wpr">';
    	$html .= '<div class="ilab-st-inr">';
        	
            	$service_time = get_field("service_time");
                if ($service_time) :
            
            $html .= '<p><i class="fa fa-clock-o"></i>'. $service_time.' Hours</p>';
            endif;
        $html .= '</div>';
        $html .= '<div class="ilab-st-inr ilab-sl">';
        	$html .= '<p>'.get_field("location").'</p>';
        $html .= '</div>';
    $html .= '</div>';
	echo $html;
}*/
    function ilab_service_misc($base_post_id, $selected_language)
    {
    ?>
        <?php
        $slider_images = array();

        $total_images = get_post_meta($base_post_id, "images", true);

        if ($total_images) {
            for ($i = 0; $i < $total_images; $i++) {
                $attachment_id =  get_post_meta($base_post_id, "images_{$i}_image", true);
                $slider_images[] = wp_get_attachment_url($attachment_id);
            }
        }


        ?>
        <div class="et_pb_row et_pb_row_3" style="padding-top: 1%;">
            <div class="et_pb_column et_pb_column_4_4 et_pb_column_7  et_pb_css_mix_blend_mode_passthrough et-last-child">



                <?php /*  
                        <div class="et_pb_module et_pb_accordion et_pb_accordion_0">*/ ?>
                <div class="et_pb_module ">

                    <?php
                    $full_description = get_field("description_large_en", $base_post_id);
                    $policies = get_field("policies_en", $base_post_id);
                    $what_included = get_field("what_included_en", $base_post_id);
                    $faq = get_field("faq_en", $base_post_id);
                    $excpectations = get_field("excpectations_en", $base_post_id);
                    $information = get_field("information_en", $base_post_id);

                    if ($full_description) {
                    ?>
                        <div class="et_pb_toggle et_pb_module et_pb_accordion_item et_pb_accordion_item_1 et_pb_toggle_close">
                            <h5 class="et_pb_toggle_title"><?php

                                                            echo __("Full Description", "travely-for-divi");

                                                            ?></h5>
                            <div class="et_pb_toggle_content clearfix"><?php echo $full_description; ?></div>
                        </div>
                    <?php
                    }

                    if ($policies) {
                    ?>
                        <div class="et_pb_toggle et_pb_module et_pb_accordion_item et_pb_accordion_item_2 et_pb_toggle_close">
                            <h5 class="et_pb_toggle_title"><?php

                                                            echo __("Cancellation & Refund Policy", "travely-for-divi");

                                                            ?></h5>
                            <div class="et_pb_toggle_content clearfix"><?php echo $policies; ?></div>
                        </div>
                    <?php
                    }

                    if ($what_included) {
                    ?>
                        <div class="et_pb_toggle et_pb_module et_pb_accordion_item et_pb_accordion_item_3 et_pb_toggle_close">
                            <h5 class="et_pb_toggle_title"><?php

                                                            echo __("What's Included", "travely-for-divi");

                                                            ?></h5>
                            <div class="et_pb_toggle_content clearfix"><?php echo $what_included; ?></div>
                        </div>
                    <?php
                    }

                    // FAQ Code here
                    if ($faq) {
                    ?>
                        <div class="et_pb_toggle et_pb_module et_pb_accordion_item et_pb_accordion_item_4 et_pb_toggle_open">
                            <h5 class="et_pb_toggle_title">
                                <?php
                                echo __("FAQ", "travely-for-divi");

                                ?>
                            </h5>
                            <div class="et_pb_toggle_content clearfix"><?php echo $faq; ?></div>
                        </div>
                    <?php
                    }

                    if ($excpectations) {
                    ?>
                        <div class="et_pb_toggle et_pb_module et_pb_accordion_item et_pb_accordion_item_5 et_pb_toggle_close">
                            <h5 class="et_pb_toggle_title"><?php

                                                            echo __("What to Expect", "travely-for-divi");

                                                            ?>
                            </h5>
                            <div class="et_pb_toggle_content clearfix"><?php echo $excpectations; ?></div>
                        </div>
                    <?php
                    }

                    if ($information) {
                    ?>
                        <div class="et_pb_toggle et_pb_module et_pb_accordion_item et_pb_accordion_item_6 et_pb_toggle_close">
                            <h5 class="et_pb_toggle_title"><?php

                                                            echo __("Additional Information", "travely-for-divi");

                                                            ?></h5>
                            <div class="et_pb_toggle_content clearfix"><?php echo $information; ?></div>
                        </div>
                    <?php
                    }

                    /*
                            if( have_rows('miscellaneous_sections') ):
                                while ( have_rows('miscellaneous_sections') ) : the_row();
                                    $title = get_sub_field('title');
                                    $description = get_sub_field('description');
									if($title != 'Full Description'){
                                    ?>
                            <div class="et_pb_toggle et_pb_module et_pb_accordion_item et_pb_accordion_item_0 et_pb_toggle_close">
				<h5 class="et_pb_toggle_title"><?php echo $title; ?></h5>
				<div class="et_pb_toggle_content clearfix"><?php echo $description; ?></div>
                            </div>
                                    <?php
									}
                                endwhile;
                            endif;
                            */

                    ?>
                </div>

                <div class="et_pb_module et_pb_text et_pb_text_7  et_pb_text_align_left et_pb_bg_layout_light">


                    <div class="et_pb_text_inner">

                        <div class="ec_images_slider lightgallery" id="lightgallery">
                            <?php
                            foreach ($slider_images as $si) {
                            ?>
                                <div>
                                    <a href="<?php echo $si; ?>">
                                        <img src="<?php echo $si; ?>" />

                                    </a>
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <?php
                $google_reviews_map_embed_code = get_field("google_reviews_map_embed_code", $base_post_id);

                if ($google_reviews_map_embed_code) {
                ?>
                    <div class="for-mobile" id="google_review_frame">

                        <?php echo $google_reviews_map_embed_code; ?>
                        <!--<iframe src="<?php echo strip_tags($google_reviews_map_embed_code); ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
                    </div>
                <?php
                }
                ?>


                <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js" integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <script>
                    jQuery(function($) {
                        $(document).ready(function() {
                            $('.lightgallery').magnificPopup({
                                delegate: 'a', // child items selector, by clicking on it popup will open
                                type: 'image',
                                gallery: {
                                    enabled: true,

                                    navigateByImgClick: true,
                                }
                            });
                        });
                    });
                </script>
            </div>


        </div>
    <?php
    }
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');


    ?>

</div>
<?php
$product_css = get_field("product_css", $base_post_id);
if ($product_css) {
?>
    <style>
        <?php echo $product_css; ?>
    </style>
<?php
}
?>
<?php do_action('woocommerce_after_single_product'); ?>