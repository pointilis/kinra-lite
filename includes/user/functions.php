<?php

/**
 * Register custom fields for REST API
 */
function kinra_user_register_fields() {
    register_meta('user', 'phone_number', array(
        'show_in_rest'      => true,
        'single'            => true,
        'type'              => 'string',
    ));
}
add_action( 'rest_api_init', 'kinra_user_register_fields' );

/**
 * Generates a unique username.
 *
 * @param string $username Username to check.
 * @return string username
 */
function generate_unique_username( $username ) {
	$username = sanitize_user( $username );

	static $i;
	if ( null === $i ) {
		$i = 1;
	} else {
		$i ++;
	}
	if ( ! username_exists( $username ) ) {
		return $username;
	}
	$new_username = sprintf( '%s-%s', $username, $i );
	if ( ! username_exists( $new_username ) ) {
		return $new_username;
	} else {
		return call_user_func( __FUNCTION__, $username );
	}
}

add_filter( 'rest_pre_insert_user', 'kinra_rest_pre_insert_user', 10, 2 );
function kinra_rest_pre_insert_user( $prepared_user, $request ) {
    $prepared_user->user_login = generate_unique_username( $prepared_user->display_name );

    return $prepared_user;
}