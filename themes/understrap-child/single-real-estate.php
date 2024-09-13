<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

	<div class="wrapper" id="single-wrapper">

		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<div class="row">

				<div class="<?php echo is_active_sidebar( 'right-sidebar' ) ? 'col-md-9' : 'col-md-12'; ?> content-area" id="primary">

					<main class="site-main" id="main">

						<?php
						while ( have_posts() ) {
							the_post();
							get_template_part( 'loop-templates/estate', 'single' );
						}
						?>

					</main>

				</div>

				<?php get_template_part( 'sidebar-templates/sidebar', 'right' ); ?>

			</div><!-- .row -->

		</div><!-- #content -->

	</div><!-- #single-wrapper -->

<?php
get_footer();
