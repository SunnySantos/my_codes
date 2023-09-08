<?php

add_shortcode('interesting_products', function() {
	$args = array(
		'post_type' => 'product', // Display products
		'posts_per_page' => 10, // Number of products to display
		'meta_key' => '_wc_average_rating', // Sort by average rating
		'orderby' => 'meta_value_num', // Sort by numeric value of meta key
		'order' => 'DESC', // Sort in descending order
	);

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) {

		echo "<div class='elementor-element elementor-element-17262f9 elementor-product-loop-item--align-center elementor-products-grid elementor-wc-products elementor-show-pagination-border-yes elementor-widget elementor-widget-wc-archive-products' data-element_type='widget'  data-widget_type='wc-archive-products.default'>";
		echo "<div class='woocommerce columns-4 '>";
		echo "<ul class='products elementor-grid columns-4'>";
		while ( $products->have_posts() ) {
			$products->the_post();
			echo "<li class='product type-product has-post-thumbnail shipping-taxable purchasable product-type-simple'>";
			if ( has_post_thumbnail() ) {
				echo "<a href='" . get_permalink() . "' class='woocommerce-LoopProduct-link woocommerce-loop-product__link'>";
				the_post_thumbnail( 'full' );
				echo "</a>";
			}
			echo "<h2 class='woocommerce-loop-product__title'>" . get_the_title() . "</h2><div class='star-rating' role='img' aria-label='" . wc_get_rating_html( get_post_meta( get_the_ID(), '_wc_average_rating', true ) ) . "'><span style='width:100%''>Rated <strong class='rating'>5.00</strong> out of 5</span></div>";
			echo "<span class='price'><span class='woocommerce-Price-amount amount'><bdi>" . woocommerce_template_loop_price() . "</bdi></span></span>";
			woocommerce_template_loop_add_to_cart();
			echo "</li>";
		}
		echo "</div>";
		echo "</ul>";
		echo "</div>";
	}

	wp_reset_postdata();
});