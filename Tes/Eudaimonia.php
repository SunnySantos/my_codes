<?php
add_shortcode( 'training_course', function () {
	ob_start();
	?>
	<div class="course-wrap">
		<div class="course-filter">
			<div>
				<h4 class="filter-heading">Filter</h4>
				<div class="filter-option">
					<form method="GET" action="/project-management-course-catalog/" id="acf-filter-form">
						<select>
							<option>All Countries</option>
						</select>
						<select>
							<option>Venue</option>
						</select>
						<select>
							<option>Course Delivery Method</option>
						</select>
						<select>
							<option>Trainer</option>
						</select>
					</form>
				</div>
			</div>

			<div>
				<form method="GET" action="/project-management-course-catalog/" class="filter-form">
					<div class="post-filter post-filter-category">
						<h3>Courses Categories</h3>
						<div class="filter-option">
							<?php

							$categories = get_categories(array(
								'taxonomy' => 'training_course_cat',
								'orderby' => 'name',
								'order'   => 'ASC',
								'hide_empty' => false,
								'parent' => 0
							));

							foreach ($categories as $category) :
								$child_terms = get_categories(array(
									'parent'      => $category->term_id,
									'taxonomy' => 'training_course_cat',
									'hide_empty' => false,
								));
								
								?>
								<div class="course-category-item">
									<h5><?= $category->name ?></h5>
									<div class="course-category-child-item">
										<?php foreach ($child_terms as $child_term) : ?>
										<div>
											<input 
											   type="radio" name="category" 
											   id="category-<?= $child_term->term_id ?>"
											   value="<?= $child_term->term_id ?>"
									           <?= $_GET['category'] == $child_term -> term_id ? 'checked' : '' ?>
											>
											<label for="category-<?= $child_term->term_id ?>">
												<?= $child_term->name ?>
											</label>
										</div>
										<?php endforeach ?>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				</form>
			</div>
		</div>
			<?php
									
			// WP_Query arguments
			$args = array(
				'post_type'              => 'training_course',
				'posts_per_page'         => '-1',
				'order'                  => 'ASC',
				'orderby'                  => 'date',
				
			);
	
			if ($_GET['category']) {
				array_push($args, array('tax_query' => array(
					array (
						'taxonomy' => 'training_course_cat',
						'field' => 'id',
						'terms' => $_GET['category'],
					)
				)));
			}
	
			// The Query
			$query = new WP_Query($args);
			?>
        <div>    
            <div class="button-wrapper">
			    <a href="#">All courses</a>
			    <a href="#">Guaranteed to run</a>
		    </div>
			<div class="course-loop-wrap <?= $query->have_posts() ? '' : 'no-result' ?>">
            <?php
			// The Loop
			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();

					$course_hours = get_field('course_hours');
					$course_price = get_field('course_price');

			?>

					<div class="course-item">
						<?php
						echo has_post_thumbnail() ? the_post_thumbnail() : '<img src="/wp-content/uploads/2022/09/exam-preparation-training.jpg" />';
						?>
						<div class="course-item-bottom">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<?php the_excerpt(); ?>
							<div class="course-meta">
								<?php
								echo $course_hourse ? '<span class="course-hours">' . $course_hourse . '</span>' : $course_hourse;
								echo $course_price ? '<span class="course-price">from $' . $course_price . '</span>' : $course_price;
								?>
							</div>
						</div>
						<div class="course-item-link">
							<a href="<?php the_permalink(); ?>">View upcoming dates</a>
						</div>
					</div>

			<?php
				}
			} else {
				// no posts found
				echo 'No Result Found';
			}

			// Restore original Post Data
			wp_reset_postdata();
			?>
		    </div>
	    </div>
        </div>
	<script>
		(function(){
			document.querySelector('.filter-form').addEventListener('input', function(){
				this.submit()
			})
			
			for(let title of document.querySelectorAll('.course-category-item > h5')) title.onclick = () => title.classList.toggle('open')
		})()		
	</script>
	<?php
	return ob_get_clean();
});