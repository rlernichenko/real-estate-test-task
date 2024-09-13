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

	<div class="wrapper" id="page-wrapper">

		<div class="<?php echo esc_attr( $container ); ?>" id="content">

			<div class="row">

				<?php get_template_part( 'sidebar-templates/sidebar', 'left' ); ?>

				<div class="<?php echo is_active_sidebar( 'right-sidebar' ) ? 'col-xl-9 col-lg-9 col-md-12' : 'col-md-12'; ?> content-area" id="primary">

					<main class="site-main" id="main" role="main">

						<?php
						echo "<div class='real-estate-list row'>";
						while ( have_posts() ) {
							the_post();
							get_template_part( 'loop-templates/content', 'estate' );
						}
						echo "</div>";
						?>

					</main>

				</div><!-- #primary -->

			</div><!-- .row -->

		</div><!-- #content -->

	</div><!-- #page-wrapper -->

<?php
get_footer();
