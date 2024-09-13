<?php
/**
 * Template Name: Homepage
 *
 * This template can be used to override the default template and sidebar setup
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

				<div class="<?php echo is_active_sidebar( 'right-sidebar' ) ? 'col-xl-9 col-lg-9 col-md-12' : 'col-md-12'; ?> content-area" id="primary">

					<main class="site-main" id="main" role="main">

						<?php
						$args = array(
							'post_type'         => array( 'real-estate' ),
							'post_status'       => array( 'publish' ),
							'nopaging'          => false,
							'posts_per_page'    => '10',
							'meta_key'          => 'environmental_friendliness',
							'orderby'           => 'meta_value_num',
							'order'             => 'DESC'
						);
						$query = new WP_Query( $args );

						if ( $query->have_posts() ) {

							echo "<div class='real-estate-list row'>";

							while ( $query->have_posts() ) {
								$query->the_post();
								get_template_part( 'loop-templates/content', 'estate' );
							}

							echo "</div>";
						} else {
							echo '<p>Пости відсутні.</p>';
						}

						wp_reset_postdata();
						?>


					</main>

				</div><!-- #primary -->

				<?php get_template_part( 'sidebar-templates/sidebar', 'right' ); ?>

			</div><!-- .row -->

		</div><!-- #content -->

	</div><!-- #page-wrapper -->


<?php
get_footer();
