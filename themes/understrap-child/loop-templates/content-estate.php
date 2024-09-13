<?php
/**
 * Partial template for content in page.php
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article class="real-estate-item col-xl-6 col-md-6 col-sm-12 d-flex flex-column" id="post-<?php the_ID(); ?>">

	<div class="entry-thumbnail flex-grow-1">
	<?php
		echo get_the_post_thumbnail( $post->ID, 'large' );
	?>
	</div>

	<div class="entry-content">

		<?php
		if ( ! is_page_template( 'page-templates/no-title.php' ) ) {
			the_title(
				'<h3 class="entry-title">',
				'</h3>'
			);
		}
		?>

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
		<div class="option-item d-flex justify-content-between align-items-center">
			<div class="d-flex align-items-center">
				<img class="option-item__icon" src="http://localhost:8888/wp-content/uploads/2024/09/House-Map-Location.svg" alt="location">
				<span class="option-item__title">Координати</span>
			</div>
			<span class="option-item__value ml-auto">
				<a href="https://www.google.com/maps/place/<?php the_field('coordinates'); ?>" target="_blank"><?php the_field('coordinates'); ?></a>
			</span>
		</div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<a href="<?php echo get_post_permalink();?>" class="wp-block-search__button btn btn-primary wp-element-button m-0">Детальніше</a>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
