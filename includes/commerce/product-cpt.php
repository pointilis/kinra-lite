<?php

// Register Custom Post Type
function kinra_product_cpt() {

	$labels = array(
		'name'                  => _x( 'Products', 'Post Type General Name', 'kinra-lite' ),
		'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'kinra-lite' ),
		'menu_name'             => __( 'Products', 'kinra-lite' ),
		'name_admin_bar'        => __( 'Product', 'kinra-lite' ),
		'archives'              => __( 'Item Archives', 'kinra-lite' ),
		'attributes'            => __( 'Item Attributes', 'kinra-lite' ),
		'parent_item_colon'     => __( 'Parent Item:', 'kinra-lite' ),
		'all_items'             => __( 'All Items', 'kinra-lite' ),
		'add_new_item'          => __( 'Add New Item', 'kinra-lite' ),
		'add_new'               => __( 'Add New', 'kinra-lite' ),
		'new_item'              => __( 'New Item', 'kinra-lite' ),
		'edit_item'             => __( 'Edit Item', 'kinra-lite' ),
		'update_item'           => __( 'Update Item', 'kinra-lite' ),
		'view_item'             => __( 'View Item', 'kinra-lite' ),
		'view_items'            => __( 'View Items', 'kinra-lite' ),
		'search_items'          => __( 'Search Item', 'kinra-lite' ),
		'not_found'             => __( 'Not found', 'kinra-lite' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'kinra-lite' ),
		'featured_image'        => __( 'Featured Image', 'kinra-lite' ),
		'set_featured_image'    => __( 'Set featured image', 'kinra-lite' ),
		'remove_featured_image' => __( 'Remove featured image', 'kinra-lite' ),
		'use_featured_image'    => __( 'Use as featured image', 'kinra-lite' ),
		'insert_into_item'      => __( 'Insert into item', 'kinra-lite' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'kinra-lite' ),
		'items_list'            => __( 'Items list', 'kinra-lite' ),
		'items_list_navigation' => __( 'Items list navigation', 'kinra-lite' ),
		'filter_items_list'     => __( 'Filter items list', 'kinra-lite' ),
	);
	$args = array(
		'label'                 => __( 'Product', 'kinra-lite' ),
		'description'           => __( 'Simple product listing', 'kinra-lite' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-products',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'taxonomies'          	=> array( 'category' ),
	);
	register_post_type( 'kinra_product', $args );

}
add_action( 'init', 'kinra_product_cpt', 0 );

/**
 * Add custom meta box for product details
 */
add_filter( 'rwmb_meta_boxes', 'kinra_product_meta_box' );
function kinra_product_meta_box( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => __( 'Product Details', 'kinra-lite' ),
        'post_types' => 'kinra_product',
        'fields'     => array(
            array(
                'id'   => 'seller_name',
                'name' => __( 'Seller Name', 'kinra-lite' ),
                'type' => 'text',
            ),
            array(
                'id'   => 'seller_phone_number',
                'name' => __( 'Seller Phone Number', 'kinra-lite' ),
                'type' => 'tel',
            ),
            array(
                'id'   => 'seller_email',
                'name' => __( 'Seller Email', 'kinra-lite' ),
                'type' => 'email',
            ),
            array(
                'id'    => 'gallery',
                'name'  => __( 'Gallery', 'kinra-lite' ),
                'type'  => 'image_upload',
                'clone' => true,
            ),
        ),
    );

    return $meta_boxes;
}

/**
 * Register custom fields for REST API
 */
function kinra_product_register_fields() {
    register_meta('post', 'seller_name', array(
        'object_subtype'    => 'kinra_product',
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
    ));

    register_meta('post', 'seller_phone_number', array(
        'object_subtype'    => 'kinra_product',
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
    ));

    register_meta('post', 'seller_email', array(
        'object_subtype'    => 'kinra_product',
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
    ));
}
add_action( 'rest_api_init', 'kinra_product_register_fields' );

/**
 * Added post meta after post content
 */
add_filter( 'the_content', 'kinra_product_meta_after_content' );
function kinra_product_meta_after_content( $content ) {
	if ( get_post_type() === 'kinra_product' ) {
		$content .= '<div class="product-meta">
			<h3 class="kn-text-xl kn-mb-2 kn-font-semibold">' . __( 'Seller Details', 'kinra-lite' ) . '</h3>
			<p class="!kn-mb-1 !kn-mt-0"><strong>' . __( 'Name', 'kinra-lite' ) . ':</strong> ' . get_post_meta( get_the_ID(), 'seller_name', true ) . '</p>
			<p class="!kn-mb-1 !kn-mt-0"><strong>' . __( 'Phone Number', 'kinra-lite' ) . ':</strong> ' . get_post_meta( get_the_ID(), 'seller_phone_number', true ) . '</p>
			<p class="!kn-mb-1 !kn-mt-0"><strong>' . __( 'Email', 'kinra-lite' ) . ':</strong> ' . get_post_meta( get_the_ID(), 'seller_email', true ) . '</p>
		</div>';
	}

	return $content;
}