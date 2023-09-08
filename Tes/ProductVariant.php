<?php

add_shortcode('product_variant', function() {
	$id = get_the_ID();
	$product_cats = wp_get_post_terms( $id, 'product_cat' );
	$single_cat = array_shift( $product_cats );

	$args = array(
		'post_type' => 'product',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $single_cat->name
			)
		)
	);
	$products = new WP_Query( $args );
	if ( $products->have_posts() ) {
		$html = "<div class='custom-variant'>";
		$count = 0;
		while ( $products->have_posts() ) {
			$products->the_post();
			$color = get_field('color');
			$link = get_permalink();
			$count++;
			if($id == get_the_ID()) {
				$html .= "<div><a href='$link' class='circle active' style='background-color:$color'></a></div>";
			}else {
				$html .= "<div><a href='$link' class='circle' style='background-color:$color'></a></div>";
			}

		}
		$html .= "</div>";
		if($count > 0) return $html;
		wp_reset_postdata();
	}
});