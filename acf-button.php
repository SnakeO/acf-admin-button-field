<?php
/*
	Plugin Name: Advanced Custom Fields: Button
	Plugin URI: https://github.com/envex/acf-button-field
	Description: Creates a set of button fields for the Advanced Custom Fields plugin
	Version: 1.0.0
	Author: Matt Cromwell
	Author URI: http://mattcromwell.com
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_button( $version ) {
	
	include_once('button-v5.php');
	
}

add_action('acf/include_field_types', 'include_field_types_button');	




// 3. Include field type for ACF4
function register_fields_button() {
	
	include_once('button-v4.php');
	
}

add_action('acf/register_fields', 'register_fields_button');	



	
?>