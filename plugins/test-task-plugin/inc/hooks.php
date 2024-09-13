<?php

function add_real_estate_posts_to_menu( $menu_id, $menu_item_db_id, $args ) {
	$buildings_menu_id = 53;

	if ( $menu_item_db_id == $buildings_menu_id ) {
		$posts = get_posts(array(
			'post_type' => 'real-estate',
			'numberposts' => -1
		));

		foreach ( $posts as $post ) {
			if ( ! get_post_meta( $post->ID, '_menu_item_added', true ) ) {
				wp_update_nav_menu_item($menu_id, 0, array(
					'menu-item-title' => $post->post_title,
					'menu-item-object-id' => $post->ID,
					'menu-item-object' => 'real-estate',
					'menu-item-type' => 'post_type',
					'menu-item-status' => 'publish',
					'menu-item-parent-id' => $menu_item_db_id
				));
				update_post_meta($post->ID, '_menu_item_added', 'yes');
			}
		}
	}
}
add_action( 'wp_update_nav_menu_item', 'add_real_estate_posts_to_menu', 10, 3 );


class Real_Estate_Query {
	public function __construct() {
		add_action( 'pre_get_posts', array( $this, 'modify_real_estate_query' ) );
	}

	public function modify_real_estate_query( $query ) {
		if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'real-estate' ) ) {
			$query->set( 'meta_key', 'environmental_friendliness' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'DESC' );
		}
	}
}

new Real_Estate_Query();

