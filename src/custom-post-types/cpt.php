<?php
/**
 * Register the custom post types
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function atomic_testimonials_register() {

	/* Register the Testimonial post type. */
	register_post_type(
		'testimonial',
		array(
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_nav_menus'   => false,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => null,
			'menu_icon'           => 'dashicons-testimonial',
			'can_export'          => true,
			'delete_with_user'    => false,
			'hierarchical'        => false,
			'has_archive'         => 'testimonials',
			'query_var'           => 'testimonial',
			'show_in_rest'       => true,

			/* The rewrite handles the URL structure. */
			'rewrite' => array(
				'slug'       => 'testimonials',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
				'ep_mask'    => EP_PERMALINK,
			),

			/* What features the post type supports. */
			'supports' => array(
				'title',
				'editor',
				'author',
				'thumbnail'
			),

			/* Labels used when displaying the posts. */
			'labels' => array(
				'name'               => __( 'Testimonials',                   'array-toolkit' ),
				'singular_name'      => __( 'Testimonial',                    'array-toolkit' ),
				'menu_name'          => __( 'Testimonials',                   'array-toolkit' ),
				'name_admin_bar'     => __( 'Testimonial',                    'array-toolkit' ),
				'add_new'            => __( 'Add New',                        'array-toolkit' ),
				'add_new_item'       => __( 'Add New Testimonial',            'array-toolkit' ),
				'edit_item'          => __( 'Edit Testimonial',               'array-toolkit' ),
				'new_item'           => __( 'New Testimonial',                'array-toolkit' ),
				'view_item'          => __( 'View Testimonial',               'array-toolkit' ),
				'search_items'       => __( 'Search Testimonials',            'array-toolkit' ),
				'not_found'          => __( 'No testimonials found',          'array-toolkit' ),
				'not_found_in_trash' => __( 'No testimonials found in trash', 'array-toolkit' ),
				'all_items'          => __( 'Testimonials',                   'array-toolkit' ),
			)
		)
	);
}
add_action( 'init', 'atomic_testimonials_register' );


/* Add template to testimonial post type */
function atomic_testimonial_templates( $args, $post_type ) {

	if ( 'testimonial' == $post_type ) {
	  
		// Lock the template
		$args['template_lock'] = true;
		
		// Setup the template
		$args['template'] = [
			[ 
				'atomic/atomic-toolbox-testimonial', [
				//'placeholder' => 'Custom placeholder',
				]
			]
		];
	}
	return $args;
}
add_filter( 'register_post_type_args', 'atomic_testimonial_templates', 20, 2 );


function atomic_testimonial_list_render( $attributes ) {

    $posts = wp_get_recent_posts( array(
        'numberposts' => 5,
        'post_status' => 'publish',
    ) );

    if ( count( $posts ) === 0 ) {
        return 'No posts';
    }

    $markup = '<ul>';
    foreach( $posts as $post ) {

      $markup .= sprintf(
          '<li><a class="wp-block-my-plugin-latest-post" href="%1$s">%2$s</a></li>',
          esc_url( get_permalink( $post['ID'] ) ),
          esc_html( get_the_title( $post['ID'] ) )
      );

    }

    return $markup;

}

// Server side rendering
// register_block_type( 'atomic/atomic-toolbox-testimonial-list', [
//     'render_callback' => 'atomic_testimonial_list_render',
// ] );