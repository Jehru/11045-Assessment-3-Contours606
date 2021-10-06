<?php
/**
 * Manage Marker Categories
 * @package Maps
 */

  $form  = new WPGMP_Template();
  echo wp_kses_post( $form->show_header() );
  
  if(!class_exists('WP_List_Table_Helper')){
	
	$tabular_file = WPGMP_CORE_CLASSES.'class.tabular.php';
	if ( file_exists( $tabular_file ) ) {
	   require_once( $tabular_file );
	}
	
   }

if ( class_exists( 'WP_List_Table_Helper' ) and ! class_exists( 'Wpgmp_Manage_Group_Table' ) ) {

	/**
	 * Display categories manager.
	 */
	class Wpgmp_Manage_Group_Table extends WP_List_Table_Helper {

	  	/**
	  	 * Intialize manage category table.
	  	 * @param array $tableinfo Table's properties.
	  	 */
	  	public function __construct($tableinfo) {
			parent::__construct( $tableinfo ); }
		/**
		 * Show marker image assigned to category.
		 * @param  array $item Category row.
		 * @return html       Image tag.
		 */
	  	public function column_group_marker($item) {
	  		if ( strstr( $item->group_marker, 'wp-google-map-pro/icons/' ) !== false ) {
	  			$item->group_marker = str_replace( 'icons', 'assets/images/icons', $item->group_marker );
	  		}
			return sprintf( '<img src="'.$item->group_marker.'" name="group_image[]" value="%s" />', $item->group_map_id );
		}
		/**
		 * Show category's parent name.
		 * @param  [type] $item Category row.
		 * @return string       Category name.
		 */
	  	public function column_group_parent($item) {

			 global $wpdb;
			 $parent = $wpdb->get_col( $wpdb->prepare( 'SELECT group_map_title FROM '.$this->table.' where group_map_id = %d',$item->group_parent ) );
			 $parent = ( ! empty( $parent )) ? ucwords( $parent[0] ) : '---';
			 return $parent;

		}


	}
	global $wpdb;
	$columns   = array(
	'group_map_title'  => esc_html__('Category Title','wp-google-map-plugin'),
			           'group_marker' => esc_html__('Marker Image','wp-google-map-plugin'),
			           'group_parent' => esc_html__('Parent Category','wp-google-map-plugin'),
			           'group_added' => esc_html__('Updated On', 'wp-google-map-plugin'),
	);
	$sortable  = array( 'group_map_title' );
	$tableinfo = array(
	'table' => $wpdb->prefix.'group_map',
	'plugin' => 'wp-google-map-plugin',
	'textdomain' => 'wp-google-map-plugin',
	'singular_label' => esc_html__( 'Marker Category', 'wp-google-map-plugin' ),
	'plural_label' => esc_html__( 'Marker Categories', 'wp-google-map-plugin' ),
	'admin_listing_page_name' => 'wpgmp_manage_group_map',
	'admin_add_page_name' => 'wpgmp_form_group_map',
	'primary_col' => 'group_map_id',
	'columns' => $columns,
	'sortable' => $sortable,
	'per_page' => 20,
	'col_showing_links' => 'group_map_title',
	'searchExclude'           => array( 'group_parent' ),
	'bulk_actions'            => array( 'delete' => esc_html__( 'Delete', 'wp-google-map-plugin' ) ),
	'translation' => array(
		'manage_heading'      => esc_html__( 'Manage Categories', 'wp-google-map-plugin' ),
		'add_button'          => esc_html__( 'Add Category', 'wp-google-map-plugin' ),
		'delete_msg'          => esc_html__( 'Category deleted successfully', 'wp-google-map-plugin' ),
		'insert_msg'          => esc_html__( 'Category added successfully', 'wp-google-map-plugin' ),
		'update_msg'          => esc_html__( 'Category updated successfully', 'wp-google-map-plugin' ),
	)
	);
	return new Wpgmp_Manage_Group_Table( $tableinfo );

}
?>
