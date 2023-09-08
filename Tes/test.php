<?php 


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );}
	

//======================================================================
// CUSTOM DASHBOARD
//======================================================================
// ADMIN FOOTER TEXT
function remove_footer_admin () {
    echo "Divi Child Theme";
} 

add_filter('admin_footer_text', 'remove_footer_admin');



function diwp_create_shortcode_weekend_post_type()
{

    /****
  				$args = array(
                    'post_type'      => 'upcoming-events',
                    'posts_per_page' => '2',
                    'publish_status' => 'published',
					 'orderby' => 'date',
   					 'order'   => 'DESC',
                 );
     *****/

    $today = current_time('Ymd');
    $args = array(
        'posts_per_page' => 2,
        'post_type' => 'upcoming-events',
        'publish_status' => 'published',
        'meta_query' => array(
            array(
                'key' => 'ue_event_date_start',
                'compare' => '>=', // Upcoming Events - Greater than or equal to today
                'value' => $today,
            )
        ),
        'meta_key' => 'ue_event_date_start',
        'orderby' => 'meta_value',
        'order' => 'ASC',
    );

    $query = new WP_Query($args);
    $total = $query->found_posts;
    $i = 0;
    $tp = 0;
    $result = '';
    if ($query->have_posts()) :
        $result .= '<div class="flip-card-wrap">';
        while ($query->have_posts()) :
            $i = $i + 1;
            $tp = $tp + 1;
            if ($i == 1 || $i == 3 || $i == 5 || $i == 7 || $i == 9) {
                $result .= '<div class="flip-wrapper">';
            }
            $query->the_post();

            $cf1 = get_field("ue_short_blurb");
            $cf2 = get_field("ue_event_date_start");
            $cf3 = get_field("ue_where");

            $format_in = 'Ymd'; // the format your value is saved in (set in the field options)
            $format_out = 'l F d , Y'; // the format you want to end up with

            $cf4 = DateTime::createFromFormat($format_in, get_field('ue_event_date_start'));
            $cf4 = $cf4->format($format_out);


            $result .= '<div class="flip-card">';
            $result .= ' <div class="flip-card-inner">';
            $result .= '<div class="flip-card-front">';
            $result .= '<div class="event-date">' . $cf4 . '</div>';
            $result .= '<div class="event-image">' . get_the_post_thumbnail() . '</div>';
            $result .= '<div class="event-title">' . get_the_title() . '</div>';
            $result .= '<div class="event-title event-loc">' . $cf3 . '</div>';
            $result .= '</div>';
            $result .= '<div class="flip-card-back">';
            $result .= '<div class="shot-blurb">' . $cf1 . '</div>';
            $result .= '<div class="view-event"><a href="' . get_permalink() . '">View Details</a></div>';
            //$result .= '<div class="content">'. get_the_content() . '</div>'; 
            $result .= '<div class="cfields">' . $ex1 . '</div>';
            $result .= '<div class="cfields">' . $ex2 . '</div>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '</div>';

            if ($i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10) {
                $result .= '</div>';
                $i = 0;
            }

            if ($tp >= $total) {
                /* $result .= '</div>';*/
            }
        endwhile;

        wp_reset_postdata();
        $result .= '</div>';
    endif;

    return $result;
}

  
add_shortcode( 'weekend-list', 'diwp_create_shortcode_weekend_post_type' ); 


function diwp_create_shortcode_weekdays_post_type()
{


    $today = current_time('Ymd');
    $args = array(
        'posts_per_page' => 2,
        'post_type' => 'upcoming-events-days',
        'publish_status' => 'published',
        'meta_query' => array(
            array(
                'key' => 'ue_event_date_start',
                'compare' => '>=', // Upcoming Events - Greater than or equal to today
                'value' => $today,
            )
        ),
        'meta_key' => 'ue_event_date_start',
        'orderby' => 'meta_value',
        'order' => 'ASC',
    );

    $query = new WP_Query($args);
    $total = $query->found_posts;
    $i = 0;
    $tp = 0;
    $result = '';
    if ($query->have_posts()) :
        $result .= '<div class="flip-card-wrap">';
        while ($query->have_posts()) :
            $i = $i + 1;
            $tp = $tp + 1;
            if ($i == 1 || $i == 3 || $i == 5 || $i == 7 || $i == 9) {
                $result .= '<div class="flip-wrapper">';
            }
            $query->the_post();

            $cf1 = get_field("ue_short_blurb");
            $cf2 = get_field("ue_event_date_start");
            $cf3 = get_field("ue_where");


            $format_in = 'Ymd'; // the format your value is saved in (set in the field options)
            $format_out = 'l F d , Y'; // the format you want to end up with

            $cf4 = DateTime::createFromFormat($format_in, get_field('ue_event_date_start'));
            $cf4 = $cf4->format($format_out);

            $result .= '<div class="flip-card">';
            $result .= ' <div class="flip-card-inner">';
            $result .= '<div class="flip-card-front">';
            $result .= '<div class="event-date altdate">' . $cf4 . '</div>';
            $result .= '<div class="event-image">' . get_the_post_thumbnail() . '</div>';
            $result .= '<div class="event-title">' . get_the_title() . '</div>';
            $result .= '<div class="event-title event-loc">' . $cf3 . '</div>';
            $result .= '</div>';
            $result .= '<div class="flip-card-back">';
            $result .= '<div class="shot-blurb">' . $cf1 . '</div>';
            $result .= '<div class="view-event"><a href="' . get_permalink() . '">View Details</a></div>';
            //$result .= '<div class="content">'. get_the_content() . '</div>'; 


            $result .= '</div>';
            $result .= '</div>';
            $result .= '</div>';

            if ($i == 2 || $i == 4 || $i == 6 || $i == 8 || $i == 10) {
                $result .= '</div>';
                $i = 0;
            }
            if ($tp >= $total) {
                /* $result .= '</div>';*/
            }
        endwhile;

        wp_reset_postdata();
        $result .= '</div>';
    endif;

    return $result;
}
  
add_shortcode( 'weekdays-list', 'diwp_create_shortcode_weekdays_post_type' ); 


/**slide**/
function diwp_create_shortcode_slide_weekends_post_type(){
  
    $args = array(
                    'post_type'      => 'upcoming-events',
                    'posts_per_page' => '10',
                    'publish_status' => 'published',
   		'meta_query' => array(
        array(
            'key' => 'ue_event_date_start',
            'compare' => '>=', // Upcoming Events - Greater than or equal to today
            'value' => $today,
        )
    ),
   'meta_key' => 'ue_event_date_start',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    );
  
    $query = new WP_Query($args);
	$total = $query->found_posts;
	if($total <=3 ){
	$total = 2;
}
	if($total == 1){
		$total = 1;
	}
	
	if($total >=3 ){
	$total = 3;
}

    if($query->have_posts()) :
	
  	$result .= '
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.3.11/min/tiny-slider.js"></script>
	<ul class="controls" id="customize-controls" aria-label="Carousel Navigation" tabindex="0">
        <li class="prev" data-controls="prev" aria-controls="customize" tabindex="-1">
           
        </li>
        <li class="next" data-controls="next" aria-controls="customize" tabindex="-1">
                    
        </li>
    </ul>
	<div class="slider-container">
    <div class="my-slider">';
	
        while($query->have_posts()) :
   

            $query->the_post() ;
                      
	$cf1 = get_field( "ue_short_blurb" );
	$cf2 = get_field( "ue_event_date_start" );
	$cf3 = get_field( "ue_where" );
	
	
		$format_in = 'Ymd'; // the format your value is saved in (set in the field options)
$format_out = 'l F d , Y'; // the format you want to end up with

	if(get_field("ue_event_date_start")){
$cf4 = DateTime::createFromFormat($format_in, get_field('ue_event_date_start'));
$cf4 = $cf4 ->format( $format_out );
	}else{
		$cf4 ="";
		
	}
	
		$result .= '<div class="slider-item flip-cardx">';
			$result .= ' <div class="flip-card-inner">';
				$result .= '<div class="flip-card-front">';
				$result .= '<div class="event-date">'. $cf4 .'</div>';
				$result .= '<div class="event-image">'. get_the_post_thumbnail() .'</div>';
				$result .= '<div class="event-title">'. get_the_title() .'</div>';
				$result .= '<div class="event-title event-loc">'. $cf3 .'</div>';
				$result .= '<div class="event-sb">'. $cf1 .'</div>';
				$result .='<div class="view-event"><a href="'.get_permalink().'">View Details</a></div>';
				$result .= '</div>';

			$result .= '</div>';
		$result .= '</div>';
  
        endwhile;
  
        wp_reset_postdata();
  $result .= '</div></div>
   <script>
  const slider = tns({
  container: ".my-slider",
  loop: true,
  items: 1,
  slideBy: "page",
  nav: true,
  autoplay: true,
  speed: 400,
  autoplayButtonOutput: false,
  mouseDrag: true,
  lazyload: true,
  controlsContainer: "#customize-controls",
  responsive: {
    640: {
      items: 1 },


    768: {
      items: '.$total.' } } });

  </script>
  
  ';

	
    endif;    
  
    return $result;            
}
  
add_shortcode( 'weekends-slide', 'diwp_create_shortcode_slide_weekends_post_type' );


/**slide days**/
function diwp_create_shortcode_slide_days_post_type(){
  
    $args = array(
                    'post_type'      => 'upcoming-events-days',
                    'posts_per_page' => '10',
                    'publish_status' => 'published',
   		'meta_query' => array(
        array(
            'key' => 'ue_event_date_start',
            'compare' => '>=', // Upcoming Events - Greater than or equal to today
            'value' => $today,
        )
    ),
   'meta_key' => 'ue_event_date_start',
    'orderby' => 'meta_value',
    'order' => 'ASC',
    );
  
    $query = new WP_Query($args);
	$total = $query->found_posts;
	
if($total <=3 ){
	$total = 2;
}
	if($total == 1){
		$total = 1;
	}
	
    if($query->have_posts()) :
	
  	$result .= '
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.3.11/min/tiny-slider.js"></script>
	    <ul class="controls" id="customize-controls" aria-label="Carousel Navigation" tabindex="0">
        <li class="prev" data-controls="prev" aria-controls="customize" tabindex="-1">
           
        </li>
        <li class="next" data-controls="next" aria-controls="customize" tabindex="-1">
                    
        </li>
    </ul>
	<div class="slider-container">

<div class="my-slider">';
	
        while($query->have_posts()) :
   

            $query->the_post() ;
                      
	$cf1 = get_field( "ue_short_blurb" );
	$cf2 = get_field( "ue_event_date_start" );
	$cf3 = get_field( "ue_where" );
	
	
		$format_in = 'Ymd'; // the format your value is saved in (set in the field options)
$format_out = 'l F d , Y'; // the format you want to end up with

	if(get_field("ue_event_date_start")){
$cf4 = DateTime::createFromFormat($format_in, get_field('ue_event_date_start'));
$cf4 = $cf4 ->format( $format_out );
	}else{
		$cf4 ="";
		
	}
	
		$result .= '<div class="slider-item flip-cardx">';
			$result .= ' <div class="flip-card-inner">';
				$result .= '<div class="flip-card-front">';
				$result .= '<div class="event-date">'. $cf4 .'</div>';
				$result .= '<div class="event-image">'. get_the_post_thumbnail() .'</div>';
				$result .= '<div class="event-title">'. get_the_title() .'</div>';
				$result .= '<div class="event-title event-loc">'. $cf3 .'</div>';
				$result .= '<div class="event-sb">'. $cf1 .'</div>';
				$result .='<div class="view-event"><a href="'.get_permalink().'">View Details</a></div>';
				$result .= '</div>';

			$result .= '</div>';
		$result .= '</div>';
  
        endwhile;
  
        wp_reset_postdata();
  $result .= '</div></div>
  <script>
  const slider = tns({
  container: ".my-slider",
  loop: true,
  items: 1,
  slideBy: "page",
  nav: true,
  autoplay: true,
  speed: 400,
  autoplayButtonOutput: false,
  mouseDrag: true,
  lazyload: true,
  controlsContainer: "#customize-controls",
  responsive: {
    640: {
      items: 1 },


    768: {
      items: '.$total.' } } });

  </script>
  ';

	
    endif;    
  
    return $result;            
}
  
add_shortcode( 'days-slide', 'diwp_create_shortcode_slide_days_post_type' );