<?php

// HGC
add_shortcode('custom_post_widget', function ($attributes) {
	ob_start();

	$args = array(
		'post_type'=> 'post',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'ASC',
		'posts_per_page' => -1 
	);
	$result = new WP_Query( $args );
	
	if($result->have_posts()) {
		while($result->have_posts()) {
			$result->the_post();
			echo "<a class='custom__post' href='" . get_permalink() . "'>
					<div class='custom__post-overlay' style='background: url(" . get_the_post_thumbnail_url() .")'></div>
					<h2 class='custom__post-title-overlay'>" . get_the_title() . "</h2>
					<div class='custom__post-content'>
						<h3 class='custom__post-title'>" . get_the_title() . "</h3>
						<p class='custom__post-excerpt'>
							" . get_the_excerpt() . "
						</p>
					</div>
				</a>";
		}
	}else {
		wp_reset_postdata();
	}
	
	return ob_get_clean();
});

echo "<div class='dropdown-wrapper'>
		<form action='/advocacy/publications-v2/'>
			<select name='year' id='year'>
			<option value=''>Year</option>";
foreach($post_years as $value => $val) {
	echo "<option value='$val'>$val</option>";
}
						
echo "</select>
			<select name='month' id='month'>
				<option value=''>Month</option>
			</select>
			<select name='filter-tag' id='filter-tag'>
				<option value=''>Filter tag</option>
			</select>
		</form>
	</div>";






















	// KALEIDO GRID POST

	add_shortcode("custom_learning_centre_posts", function() {
	
		$paged = ( $_GET['currentpage'] ) ? $_GET['currentpage'] : 1; // Get the current page number
		$args = array(
			'post_type' => 'learning-centre-post',
			'posts_per_page' => 12,
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
			'paged' => $paged // Set the current page number
		);
		
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo "<div class='custom-post-grid'>";
			while ( $query->have_posts() ) {
				$query->the_post();
				$post_id = get_the_ID();
				$permalink = get_permalink( $post_id );
				$post_title = esc_html( get_the_title() );
				$post_excerpt = esc_html( get_the_excerpt() );
	
				echo "<div class='custom-post-grid__item'>
						<div class='custom-post-grid__header'>
							<h3>$post_title</h3>
						</div>
						<div class='custom-post-grid__content'>
							<div class='categories'>";
				getTaxonomy($post_id, 'learning-centre-category');
				echo "		</div>
							<p>$post_excerpt</p>
						</div>
						<div class='custom-post-grid__footer'>
							<a href='$permalink'>Get started</a>
						</div>
					</div>";
			}
			echo "</div>";
			echo "<div class='custom-post-pagination'>";
			if(($paged-1) != 0) {
				echo "<a class='previous button' href='/learning-centre/?currentpage=" . ($paged-1) . "'>Previous</a>";
			}
			
			if(is_numeric($paged) && $query->max_num_pages > 1) {
				$paged = intval($paged);
				for($i=0; $i<$query->max_num_pages; $i++) {
					$currentpage = $i+1;
					echo "<a class='number' href='/learning-centre/?currentpage=$currentpage'>$currentpage</a>";
				}
			}
			
			if($query->max_num_pages > 1) {
				echo "<a class='next button' href='/learning-centre/?currentpage=" . $query->max_num_pages . "'>Next</a>";
			}
			echo "</div>";
			wp_reset_postdata();
			
		}
	});
	
	function getTaxonomy($id, $taxonomy) {
		$terms = get_the_terms($id, $taxonomy);
	
		if ($terms && ! is_wp_error($terms) ) {
			foreach ($terms as $term) {
				echo '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
			}
		}
	}









	add_action( ‘woocommerce_before_add_to_cart_button’, ‘njengah_fields_before_add_to_cart’ );
function njengah_fields_before_add_to_cart( ) {
?;
&lt;table;
&lt;tr;
&lt;td;
&lt;?php _e( "Name:", "aoim"); ?;
&lt;/td;
&lt;td;
&lt;input type = "text" name = "customer_name" id = "customer_name" placeholder = "Name on Gift Card";
&lt;/td;
&lt;/tr;
&lt;tr;
&lt;td;
&lt;?php _e( "Message:", "aoim"); ?;
&lt;/td;
&lt;td;
&lt;input type = "text" name = "customer_message" id = "customer_message" placeholder = "Your Message on Gift Card";
&lt;/td;
&lt;/tr;
&lt;/table;
&lt;?php
}
/**
* Add data to cart item
*/
add_filter( ‘woocommerce_add_cart_item_data’, ‘njengah_cart_item_data’, 25, 2 );
function njengah_cart_item_data( $cart_item_meta, $product_id ) {
if ( isset( $_POST [‘customer_name’] ) &amp;&amp; isset( $_POST [‘customer_message’] ) ) {
$custom_data = array() ;
$custom_data [ ‘customer_name’ ] = isset( $_POST [‘customer_name’] ) ? sanitize_text_field ( $_POST [‘customer_name’] ) : "" ;
$custom_data [ ‘customer_message’ ] = isset( $_POST [‘customer_message’] ) ? sanitize_text_field ( $_POST [‘customer_message’] ): "" ;
$cart_item_meta [‘custom_data’] = $custom_data ;
}
return $cart_item_meta;
}
/**
* Display the custom data on cart and checkout page
*/
add_filter( ‘woocommerce_get_item_data’, ‘njengah_item_data’ , 25, 2 );
function njengah_item_data ( $other_data, $cart_item ) {
if ( isset( $cart_item [ ‘custom_data’ ] ) ) {
$custom_data = $cart_item [ ‘custom_data’ ];
$other_data[] = array( ‘name’ =; ‘Name’,
‘display’ =; $custom_data[‘customer_name’] );
$other_data[] = array( ‘name’ =; ‘Message’,
‘display’ =; $custom_data[‘customer_message’] );
}
return $other_data;
}
/**
* Add order item meta
*/
add_action( ‘woocommerce_add_order_item_meta’, ‘njengah_order_item_meta’ , 10, 2);
function njengah_order_item_meta ( $item_id, $values ) {
if ( isset( $values [ ‘custom_data’ ] ) ) {
$custom_data = $values [ ‘custom_data’ ];
wc_add_order_item_meta( $item_id, ‘Name’, $custom_data[‘customer_name’] );
wc_add_order_item_meta( $item_id, ‘Message’, $custom_data[‘customer_message’] );
}
}








<form class='product-customization-form' method='post'>
    <p>
        <label for='custom_name'>Name:</label>
        <input type='text' name='custom_name' id='custom_name' required>
    </p>
    <p>
        <label for='custom_message'>Message:</label>
        <textarea name='custom_message' id='custom_message' required></textarea>
    </p>
    <p>
        <input type='submit' name='submit_customization' value='Submit'>
    </p>
</form>