<?php

function cwr_testimonial_page_register_post_type() {
	$labels = array(
		 'name' => __( 'Testimonials', 'cwr' ),
		 'singular_name' => __( 'Testimonial', 'cwr' ),
		 'add_new' => __( 'New Testimonial', 'cwr' ),
		 'add_new_item' => __( 'Add New Testimonial', 'cwr' ),
		 'edit_item' => __( 'Edit Testimonial', 'cwr' ),
		 'new_item' => __( 'New Testimonial', 'cwr' ),
		 'view_item' => __( 'View Testimonial', 'cwr' ),
		 'search_items' => __( 'Search Testimonials', 'cwr' ),
		 'not_found' =>  __( 'No Testimonials Found', 'cwr' ),
		 'not_found_in_trash' => __( 'No Tesimonials found in Trash', 'cwr' ),
	);

	$supports = array(
		'title',
		'editor',
		'revisions',
		'custom-fields',
		'page-attributes'
	);

	$args = array(
		'labels' => $labels,
		'has_archive' => false,
		'public' => false, // include in search and queries
		'publicly_queryable' => true,
		'show_in_admin_bar' => true,
		'show_ui' => true,
		'hierarchical' => false,
		'supports' => $supports,
		'rewrite' => array( 'slug' => 'testimonial', 'with_front' => false ),
		'show_in_rest' => true
	);

	register_post_type( 'cwr_testimonial_page', $args);
}
add_action('init', 'cwr_testimonial_page_register_post_type');

/** Disable block editor */
function cwr_testimonial_disable_gutenberg($can_block_edit, $post_type)
{
	if ( 'cwr_testimonial_page' === $post_type ) return false;

	return $can_block_edit;
}
add_filter('use_block_editor_for_post_type',
	'cwr_testimonial_disable_gutenberg', 10, 2);

/**
 * Add custom post fields.
 *
 * This relies on the Meta Box plugin ... to make life simplej.
 *
 * @see https://developer.wordpress.org/reference/functions/add_meta_box/
 * @see https://docs.metabox.io/filters/rwmb-meta-boxes/
 */
function cwr_register_testimonial_meta( $meta_boxes ) {
    $prefix = 'cwr_testimonial_';

    $meta_boxes[] = [
		'title'      => esc_html__( 'Testimonial Details',
						  'cwr-testimonial-block' ),
        'id'         => 'testimonial',
        'post_types' => ['cwr_testimonial_page'],
        'context'    => 'normal',
        'fields'     => [
            [
                'type' => 'range',
				'name' => esc_html__( 'Star Rating', 'cwr-testimonial-block' ),
                'id'   => $prefix . 'star_rating',
                'std'  => 5,
                'max'  => 5,
                'step' => 0.1,
            ],
            [
                'type' => 'text',
                'name' => esc_html__( 'Job/Role', 'cwr-testimonial-block' ),
                'id'   => $prefix . 'jobrole',
            ],
            [
                'type'             => 'image',
                'name'             => esc_html__( 'Profile Pic', 'cwr-testimonial-block' ),
                'id'               => $prefix . 'profile_pic',
                'max_file_uploads' => 1,
            ],
        ],
    ];


    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'cwr_register_testimonial_meta' );
