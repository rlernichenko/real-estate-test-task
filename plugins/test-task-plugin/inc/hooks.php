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
	// Конструктор класу
	public function __construct() {
		add_action( 'pre_get_posts', array( $this, 'modify_real_estate_query' ) );
	}

	// Метод для модифікації основного query
	public function modify_real_estate_query( $query ) {
		// Перевіряємо, чи основний query та чи це запит кастомного типу постів 'real-estate'
		if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'real-estate' ) ) {
			// Сортуємо пости за кастомним полем 'ecological_rating' (екологічність)
			$query->set( 'meta_key', 'environmental_friendliness' );  // вкажіть правильну назву поля
			$query->set( 'orderby', 'meta_value_num' );  // сортуємо як числа
			$query->set( 'order', 'DESC' );  // сортування від більшого до меншого
		}
	}
}

// Ініціалізація класу
new Real_Estate_Query();

