<?php
/**
 * Map's Center Location setting(s).
 * @package Maps
 */

$form->add_element( 'group', 'map_center_setting', array(
	'value' => esc_html__( 'Map\'s Center', 'wp-google-map-plugin' ),
	'before' => '<div class="fc-12">',
	'after' => '</div>',
));

$form->add_element( 'text', 'map_all_control[map_center_latitude]', array(
	'lable' => esc_html__( 'Center Latitude', 'wp-google-map-plugin' ),
	'value' => (isset($_POST['map_all_control']['map_center_latitude'])) ? sanitize_text_field($_POST['map_all_control']['map_center_latitude']) : '',
	'desc' => esc_html__( 'Enter here the center latitude.', 'wp-google-map-plugin' ),
	'placeholder' => '',
));
$form->add_element( 'text', 'map_all_control[map_center_longitude]', array(
	'lable' => esc_html__( 'Center Longitude', 'wp-google-map-plugin' ),
	'value' => (isset($_POST['map_all_control']['map_center_longitude'])) ? sanitize_text_field($_POST['map_all_control']['map_center_longitude']) : '',
	'desc' => esc_html__( 'Enter here the center longitude.', 'wp-google-map-plugin' ),
	'placeholder' => '',
));
