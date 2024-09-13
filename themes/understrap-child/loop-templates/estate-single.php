<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article class="real-estate-single" id="post-<?php the_ID(); ?>">

	<div class="entry-thumbnail flex-grow-1">
		<?php
			echo get_the_post_thumbnail( $post->ID, 'large' );
		?>
	</div>

	<div class="entry-content">

		<div class="entry-title d-flex justify-content-between align-items-center">
			<div class="col mr-auto"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></div>
			<div class="">
				<a href="https://www.google.com/maps/place/<?php the_field('coordinates'); ?>" target="_blank" class="wp-block-search__button btn btn-primary wp-element-button m-0">Подивитись на мапі</a>
			</div>
		</div>

		<div class="row d-flex">
			<div class="apartment-list col-xl-8 order-xl-0 order-lg-1 order-md-1 order-sm-1 order-1">

				<?php
//				echo '<div class="apartment-item">';
//				echo '<p>Room Number: ' . esc_html($room_number) . '</p>';
//				echo '<p>Size: ' . esc_html($size) . ' sq ft</p>';
//				echo '<p>Price: $' . esc_html($price) . '</p>';
//				echo '</div>';
				?>

				<?php if( have_rows('apartment') ):?>
					<?php while( have_rows('apartment') ): the_row();?>
						<?php
						$image = get_sub_field('gallery');
						$area = get_sub_field('area');
						$rooms_count = get_sub_field('rooms_count');
						$balcony = get_sub_field('balcony');
						$bathroom = get_sub_field('bathroom');
						?>
						<div class="apartment-item d-flex align-items-center">
							<div class="apartment-item__thumb">
								<img class="apartment-item__img" src="<?php echo esc_html($image);?>" alt="img">
							</div>
							<div class="apartment-item__content flex-grow-1">

								<div class="apartment-option-item d-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center">
										<img class="apartment-option-item__icon" src="http://localhost:8888/wp-content/uploads/2024/09/target-space-object-select.1.svg" alt="Environmental">
										<span class="apartment-option-item__title">Площа</span>
									</div>
									<span class="apartment-option-item__value ml-auto"><?php echo esc_html($area);?></span>
								</div>

								<div class="apartment-option-item d-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center">
										<img class="apartment-option-item__icon" src="http://localhost:8888/wp-content/uploads/2024/09/door-exit-2.svg" alt="Environmental">
										<span class="apartment-option-item__title">Кількість кімнат</span>
									</div>
									<span class="apartment-option-item__value ml-auto"><?php echo esc_html($rooms_count);?></span>
								</div>

								<div class="apartment-option-item d-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center">
										<img class="apartment-option-item__icon" src="http://localhost:8888/wp-content/uploads/2024/09/balcony.svg" alt="Environmental">
										<span class="apartment-option-item__title">Балкон</span>
									</div>
									<span class="apartment-option-item__value ml-auto"><?php echo esc_html($balcony);?></span>
								</div>

								<div class="apartment-option-item d-flex justify-content-between align-items-center">
									<div class="d-flex align-items-center">
										<img class="apartment-option-item__icon" src="http://localhost:8888/wp-content/uploads/2024/09/Bath-Bathroom.svg" alt="Environmental">
										<span class="apartment-option-item__title">Ванна кімната</span>
									</div>
									<span class="apartment-option-item__value ml-auto"><?php echo esc_html($bathroom);?></span>
								</div>

							</div>
						</div>
					<?php endwhile;?>
				<?php else :?>
					<p>No apartments listed.</p>
				<?php endif;?>


			</div>
			<div class="options-list col-xl-4 order-xl-1 order-lg-0 order-md-0 order-sm-0 order-0 mb-xl-0 mb-md-4 mb-4">

				<div class="option-item d-flex justify-content-between align-items-center">
					<div class="d-flex align-items-center">
						<img class="option-item__icon" src="http://localhost:8888/wp-content/uploads/2024/09/hotel-building-2.svg" alt="floor">
						<span class="option-item__title">Поверхів</span>
					</div>
					<span class="option-item__value ml-auto"><?php the_field('floors_count'); ?></span>
				</div>
				<div class="option-item d-flex justify-content-between align-items-center">
					<div class="d-flex align-items-center">
						<img class="option-item__icon" src="http://localhost:8888/wp-content/uploads/2024/09/building-wall-bricks.svg" alt="type">
						<span class="option-item__title">Тип будівлі</span>
					</div>
					<span class="option-item__value ml-auto"><?php the_field('building_type'); ?></span>
				</div>
				<div class="option-item d-flex justify-content-between align-items-center">
					<div class="d-flex align-items-center">
						<img class="option-item__icon" src="http://localhost:8888/wp-content/uploads/2024/09/park-tree-bench.svg" alt="Environmental">
						<span class="option-item__title">Екологічність</span>
					</div>
					<span class="option-item__value ml-auto"><?php the_field('environmental_friendliness'); ?></span>
				</div>

			</div>
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
