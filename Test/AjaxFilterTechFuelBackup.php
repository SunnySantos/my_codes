<?php

function ajax_filter_shortcode()
{
    ob_start();
?>
    <form action="" method="GET" id="ajax-filter-form">
        <input type="text" name="search" id="ajax-filter-search" placeholder="Search Terms">
    </form>

    <div id="ajax-filter-results"></div>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var typingTimer;
            var doneTypingInterval = 200; // Adjust the delay between keystrokes as desired

            function fetchCareerCategories() {
                var searchQuery = $('#ajax-filter-search').val();
                var data = {
                    action: 'ajax_filter_search'
                }

                if (searchQuery !== '') {
                    data["search"] = searchQuery
                }

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'GET',
                    dataType: 'json',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            $('#ajax-filter-results').html(response.data);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            fetchCareerCategories();

            $('#ajax-filter-search').on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            });

            function doneTyping() {
                fetchCareerCategories();
                // 			var searchQuery = $('#ajax-filter-search').val();

                // 			if (searchQuery === '') {
                // 				fetchAll();
                // 			} else {
                // 				$.ajax({
                // 					url: '<?php echo admin_url('admin-ajax.php'); ?>',
                // 					type: 'GET',
                // 					dataType: 'json',
                // 					data: {
                // 						action: 'ajax_filter_search',
                // 						search: searchQuery
                // 					},
                // 					success: function(response) {
                // 						if (response.success) {
                // 							$('#ajax-filter-results').html(response.data);
                // 							$('.static-terms').hide();
                // 						}
                // 					},
                // 					error: function(error) {
                // 						console.log(error);
                // 					}
                // 				});
                // 			}
            }

            // 		// Check if the search query is empty when the input is blurred
            // 		$('#ajax-filter-search').on('keyup', function() {
            // 			if ($(this).val() === '') {
            // 				$('.static-terms').show();
            // 			}
            // 		});
        });
    </script>
<?php

    return ob_get_clean();
}
add_shortcode('ajax-filter', 'ajax_filter_shortcode');

// AJAX callback function for handling the search request
function ajax_filter_search_callback()
{
    $search_query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';

    $args = array(
        'taxonomy' => 'career-category',
        'hide_empty' => false
    );

    if (!empty($search_query)) {
        // 		wp_send_json_success('');
        $args = array(
            'taxonomy' => 'career-category',
            'hide_empty' => false,
            'search' => $search_query,
        );
    }


    $terms = get_terms($args);

    // 	$_terms = $terms;

    // 	if (!empty($search_query)) {
    // 		$_terms = array_filter($terms, function($term) use ($search_query) {
    // 			// Convert the term name and description to lowercase for case-insensitive search
    // 			$name = strtolower($term->name);
    // 			$description = strtolower($term->description);
    // 			$search_term = strtolower($search_term);

    // 			// Check if the search term is present in either the name or description
    // 			return (strpos($name, $search_term) !== false || strpos($description, $search_term) !== false);
    // 		});
    // 	}



    ob_start();

    echo '<div id="careers">';

    if (!empty($terms) && !is_wp_error($terms)) {

        foreach ($terms as $term) {
            $term_id = $term->term_id;
            $page_link = get_field('page_link', 'career-category_' . $term_id); // Replace 'career-category' with your custom taxonomy slug
            echo '<div class="careers-wrapper">';
            echo '<div class="bg-grey"></div>';
            echo '<div class="start-end-column">';
            echo '<h3>' . $term->name . '</h3>';
            echo '</div>';
            echo '<div class="content-column">';
            echo '<p>' . $term->description . '</p>';
            echo '</div>';
            echo '<div class="start-end-column">';
            echo '<a class="page-link" href="' . esc_url($page_link) . '">Browse Roles</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="error404">No terms found.</p>';
    }

    echo '</div>';

    $output = ob_get_clean();
    wp_send_json_success($output);
}


add_action('wp_ajax_ajax_filter_search', 'ajax_filter_search_callback');
add_action('wp_ajax_nopriv_ajax_filter_search', 'ajax_filter_search_callback');
