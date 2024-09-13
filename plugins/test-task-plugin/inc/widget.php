<?php

class Real_Estate_Filter_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'real_estate_filter_widget',
			'Real Estate Filter',
			['description' => 'Filters for Real Estate Listings']
		);
	}

	public function widget($args, $instance) {
		echo $args['before_widget'];
		?>
		<form id="realEstateWidget">
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
				$('#realEstateWidget').on('submit', function(e) {
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
		echo $args['after_widget'];
	}

	public function form($instance) {
	}
	public function update($new_instance, $old_instance) {
		return $new_instance;
	}
}

function register_real_estate_filter_widget() {
	register_widget('Real_Estate_Filter_Widget');
}
add_action('widgets_init', 'register_real_estate_filter_widget');
