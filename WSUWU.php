<?php
/**
 * Plugin Name: WP Search User By Website Url
 * Plugin URI: 
 * Description: A plugin which provide search by user's website's url in admin users listing.
 * Version: 1.0.0
 * Author: Smit Kalwal
 * Author URI: 
 */

//avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}

add_filter('manage_users_columns' , 'wsuwu_add_website_url_column');
add_filter('manage_users_custom_column', 'manage_website_url_column', 10, 3);
add_filter('user_search_columns', 'wsuwu_search_website_url',10, 3);


function wsuwu_add_website_url_column($columns) {
	return array_merge( $columns,  array('user_url' => __('Website')) );
}

function manage_website_url_column($empty='', $column_name, $userID) {
	
	$user_url = get_the_author_meta( 'user_url', $userID );
		
	if ( 'user_url' == $column_name )
		return '<a href="'.$user_url.'" target="_blank" alt="'.$user_url.'" >'.$user_url.'</a>';

}

function wsuwu_search_website_url( $search_columns, $search,  $this  ) {
	$search_columns[] = 'user_url';
	return $search_columns;
}

	