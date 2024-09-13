<?php


function real_estate_filter_shortcode() {
	ob_start();
	?>
	<form id="realEstateFilter">
		<label for="building_type">Building Type:</label>
		<select name="building_type" id="building_type">
			<option value="">Виберіть</option>
			<option value="panel">Панель</option>
			<option value="brick">Цегла</option>
			<option value="foam">Піноблок</option>
		</select>

		<br><br>

		<label for="floors_count">Floors Count:</label>
		<input type="number" name="floors_count" id="floors_count">

		<br><br>

		<label for="environmental_friendliness">Environmental Friendliness:</label>
		<input type="number" name="environmental_friendliness" id="environmental_friendliness">

		<br><br>

		<label for="min_area">Minimum Area (sq ft):</label>
		<input type="number" name="min_area" id="min_area">

		<label for="max_area">Maximum Area (sq ft):</label>
		<input type="number" name="max_area" id="max_area">

		<br><br>

		<label for="rooms_count">Rooms Count:</label>
		<input type="number" name="rooms_count" id="rooms_count">

		<br><br>

		<label for="balcony">Balcony:</label>
		<select name="balcony" id="balcony">
			<option value="">Any</option>
			<option value="yes">Yes</option>
			<option value="no">No</option>
		</select>

		<br><br>

		<label for="bathroom">Bathroom:</label>
		<select name="bathroom" id="bathroom">
			<option value="">Any</option>
			<option value="yes">Yes</option>
			<option value="no">No</option>
		</select>

		<br><br>

		<input type="submit" value="Filter">
	</form>

	<script>
		jQuery(document).ready(function($) {
			$('#realEstateFilter').on('submit', function(e) {
				e.preventDefault();
				let formData = $(this).serialize();
				$.ajax({
					url: '<?php echo admin_url('admin-ajax.php');?>',
					type: 'POST',
					data: formData + '&action=filter_real_estate',
					success: function(response) {
						$('.real-estate-list').html(response);
					}
				});
			});
		});
	</script>

	<?php
	return ob_get_clean();
}
add_shortcode('real_estate_filter', 'real_estate_filter_shortcode');




function filter_real_estate_callback() {

	$args = [
		'post_type' => 'real-estate',
		'post_status' => 'publish',
		'posts_per_page' => 10,
		'meta_query' => []
	];

	if (!empty($_POST['building_type'])) {
		$args['meta_query'][] = [
			'key' => 'building_type',
			'value' => $_POST['building_type'],
			'compare' => '='
		];
	}

	if (!empty($_POST['floors_count'])) {
		$args['meta_query'][] = [
			'key' => 'floors_count',
			'value' => intval($_POST['floors_count']),
			'compare' => '='
		];
	}

	if (!empty($_POST['environmental_friendliness'])) {
		$args['meta_query'][] = [
			'key' => 'environmental_friendliness',
			'value' => intval($_POST['environmental_friendliness']),
			'compare' => '='
		];
	}



	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();

			$add_post = false;

			if ( empty($_POST['min_area']) && empty($_POST['max_area']) && empty($_POST['rooms_count']) &&
			     empty($_POST['balcony']) && empty($_POST['bathroom']) ){
				$add_post = true;
			}

			if( have_rows('apartment') ){
				while( have_rows('apartment') ){
					the_row();
					$area = intval(get_sub_field('area'));
					$rooms_count = intval(get_sub_field('rooms_count'));
					$balcony = get_sub_field('balcony');
					$bathroom = get_sub_field('bathroom');

					if (!empty($_POST['min_area']) && $area >= intval($_POST['min_area'])) {
						$add_post = true;
					}
					if (!empty($_POST['max_area']) && $area <= intval($_POST['max_area'])) {
						$add_post = true;
					}
					if (!empty($_POST['rooms_count']) && $rooms_count === intval($_POST['rooms_count'])) {
						$add_post = true;
					}
					if (!empty($_POST['balcony']) && $balcony === $_POST['balcony']) {
						$add_post = true;
					}
					if (!empty($_POST['bathroom']) && $bathroom === $_POST['bathroom']) {
						$add_post = true;
					}

					if ($add_post) break;
				}
			}

			if ($add_post) {
				get_template_part('loop-templates/content', 'estate');
			}
		}
	} else {
		echo '<p>No posts found.</p>';
	}

	wp_reset_postdata();
	die();
}
add_action('wp_ajax_filter_real_estate', 'filter_real_estate_callback');
add_action('wp_ajax_nopriv_filter_real_estate', 'filter_real_estate_callback');
