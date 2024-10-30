<?php
	/**
		*
		*
		* @version 1.0.4
		* @package Main
		* @author themeglow
	*/
	/*
		Plugin Name: CleanUp Light
		Plugin URI: http://e-plugins.com/cleanup-light
		Description: Cleanup - Business Directory Plugin for WordPress for cleaning service.
		Author: ThemeGlow
		Author URI: https://e-plugins.com/cleanup-main/
		Version: 1.0.4
		Text Domain: cleanup
		License: GPLv3
		*/
	// Exit if accessed directly
	if (!defined('ABSPATH')) {
		exit;
	}
	if (!class_exists('cleanup_eplugins')) {  	
		final class cleanup_eplugins {
			private static $instance;
			/**
				* The Plug-in version.
				*
				* @var string
			*/
			public $version = "1.0.4";
			/**
				* The minimal required version of WordPress for this plug-in to function correctly.
				*
				* @var string
			*/
			public $wp_version = "3.5";
			public static function instance() {
				if (!isset(self::$instance) && !(self::$instance instanceof cleanup_eplugins)) {
					self::$instance = new cleanup_eplugins;
				}
				return self::$instance;
			}
			/**
				* Construct and start the other plug-in functionality
			*/
			public function __construct() {
				//
				// 1. Plug-in requirements
				//
				if (!$this->check_requirements()) {
					return;
				}
				//
				// 2. Declare constants and load dependencies
				//
				$this->define_constants();
				$this->load_dependencies();
				//
				// 3. Activation Hooks
				//
				register_activation_hook(__FILE__, array($this, 'activate'));
				register_deactivation_hook(__FILE__, array($this, 'deactivate'));
				register_uninstall_hook(__FILE__, 'cleanup_eplugins::uninstall');
				//
				// 4. Load Widget
				//
				add_action('widgets_init', array($this, 'register_widget'));
				//
				// 5. i18n
				//
				add_action('init', array($this, 'i18n'));
				//
				// 6. Actions
				//	
				add_action('wp_ajax_cleanup_check_coupon', array($this, 'cleanup_check_coupon'));
				add_action('wp_ajax_nopriv_cleanup_check_coupon', array($this, 'cleanup_check_coupon'));					
				add_action('wp_ajax_cleanup_check_package_amount', array($this, 'cleanup_check_package_amount'));
				add_action('wp_ajax_nopriv_cleanup_check_package_amount', array($this, 'cleanup_check_package_amount'));
				add_action('wp_ajax_cleanup_update_profile_pic', array($this, 'cleanup_update_profile_pic'));					
				add_action('wp_ajax_cleanup_update_profile_setting', array($this, 'cleanup_update_profile_setting'));
				add_action('wp_ajax_cleanup_update_wp_post', array($this, 'cleanup_update_wp_post'));					
				add_action('wp_ajax_cleanup_save_wp_post', array($this, 'cleanup_save_wp_post'));	
				add_action('wp_ajax_cleanup_update_setting_password', array($this, 'cleanup_update_setting_password'));
				add_action('wp_ajax_cleanup_check_login', array($this, 'cleanup_check_login'));
				add_action('wp_ajax_nopriv_cleanup_check_login', array($this, 'cleanup_check_login'));
				add_action('wp_ajax_cleanup_forget_password', array($this, 'cleanup_forget_password'));
				add_action('wp_ajax_nopriv_cleanup_forget_password', array($this, 'cleanup_forget_password'));					
												
							
				
				add_action('wp_ajax_cleanup_save_favorite', array($this, 'cleanup_save_favorite'));						
				add_action('wp_ajax_cleanup_save_un_favorite', array($this, 'cleanup_save_un_favorite'));				
				
				add_action('wp_ajax_cleanup_save_notification', array($this, 'cleanup_save_notification'));							
				add_action('wp_ajax_cleanup_delete_favorite', array($this, 'cleanup_delete_favorite'));
				
				
				
				add_action('wp_ajax_cleanup_profile_bookmark', array($this, 'cleanup_profile_bookmark'));
				add_action('wp_ajax_cleanup_profile_bookmark_delete', array($this, 'cleanup_profile_bookmark_delete'));
				add_action('wp_ajax_cleanup_author_bookmark', array($this, 'cleanup_author_bookmark'));
				add_action('wp_ajax_cleanup_author_bookmark_delete', array($this, 'cleanup_author_bookmark_delete'));
				add_action('wp_ajax_cleanup_message_delete', array($this, 'cleanup_message_delete'));
				add_action('wp_ajax_cleanup_booking_delete', array($this, 'cleanup_booking_delete'));
				add_action('wp_ajax_cleanup_message_send', array($this, 'cleanup_message_send'));
				add_action('wp_ajax_nopriv_cleanup_message_send', array($this, 'cleanup_message_send'));
				add_action('wp_ajax_cleanup_booking_message_send', array($this, 'cleanup_booking_message_send'));
				add_action('wp_ajax_nopriv_cleanup_booking_message_send', array($this, 'cleanup_booking_message_send'));
				add_action('wp_ajax_cleanup_chatgpt_upload_image', array($this, 'cleanup_chatgpt_upload_image'));				
				add_action('wp_ajax_cleanup_claim_send', array($this, 'cleanup_claim_send'));
				add_action('wp_ajax_nopriv_cleanup_claim_send', array($this, 'cleanup_claim_send'));					
				add_action('wp_ajax_cleanup_cron_listing', array($this, 'cleanup_cron_listing'));
				add_action('wp_ajax_nopriv_cleanup_cron_listing', array($this, 'cleanup_cron_listing'));					
				add_action('wp_ajax_cleanup_author_email_popup', array($this, 'cleanup_author_email_popup'));
				add_action('wp_ajax_nopriv_cleanup_author_email_popup', array($this, 'cleanup_author_email_popup'));				
				add_action('wp_ajax_cleanup_finalerp_csv_product_upload', array($this, 'cleanup_finalerp_csv_product_upload'));
				add_action('wp_ajax_cleanup_save_csv_file_to_database', array($this, 'cleanup_save_csv_file_to_database'));
				add_action('wp_ajax_cleanup_eppro_get_import_status', array($this, 'cleanup_eppro_get_import_status'));		
				add_action('wp_ajax_cleanup_contact_popup', array($this, 'cleanup_contact_popup'));
				add_action('wp_ajax_cleanup_listing_contact_popup', array($this, 'cleanup_listing_contact_popup'));
				add_action('wp_ajax_nopriv_cleanup_listing_contact_popup', array($this, 'cleanup_listing_contact_popup'));
				
				add_action('wp_ajax_cleanup_listing_claim_popup', array($this, 'cleanup_listing_claim_popup'));
				add_action('wp_ajax_nopriv_cleanup_listing_claim_popup', array($this, 'cleanup_listing_claim_popup'));
				
				add_action('wp_ajax_cleanup_listing_booking_popup', array($this, 'cleanup_listing_booking_popup'));
				add_action('wp_ajax_nopriv_cleanup_listing_booking_popup', array($this, 'cleanup_listing_booking_popup'));
				
				add_action('wp_ajax_cleanup_chatgtp_settings_popup', array($this, 'cleanup_chatgtp_settings_popup'));
				add_action('wp_ajax_nopriv_cleanup_chatgtp_settings_popup', array($this, 'cleanup_chatgtp_settings_popup'));
				
				add_action('wp_ajax_cleanup_load_categories_fields2073_wpadmin', array($this, 'cleanup_load_categories_fields_wpadmin'));
				add_action('wp_ajax_nopriv_cleanup_load_categories_fields_wpadmin', array($this, 'cleanup_load_categories_fields_wpadmin'));
				add_action('wp_ajax_cleanup_save_post_without_user', array($this, 'cleanup_save_post_without_user'));
				add_action('wp_ajax_nopriv_cleanup_save_post_without_user', array($this, 'cleanup_save_post_without_user'));	
				add_action('wp_ajax_cleanup_save_user_review', array($this, 'cleanup_save_user_review'));	
				
				add_action('add_meta_boxes', array($this, 'cleanup_custom_meta_cleanup'));
				add_action('save_post', array($this, 'cleanup_meta_save'));	
				
				add_action('wp_ajax_cleanup_chatgpt_post_creator', array($this, 'cleanup_chatgpt_post_creator'));
				add_action('wp_ajax_nopriv_cleanup_chatgpt_post_creator', array($this, 'cleanup_chatgpt_post_creator'));
								
				add_action('pre_get_posts',array($this, 'cleanup_restrict_media_library') );	
				// 7. Shortcode
				add_shortcode('cleanup_price_table', array($this, 'cleanup_price_table_func'));				
				add_shortcode('cleanup_form_wizard', array($this, 'cleanup_form_wizard_func'));
				add_shortcode('cleanup_profile_template', array($this, 'cleanup_profile_template_func'));
				
				add_shortcode('cleanup_profile_public', array($this, 'cleanup_profile_public_func'));	
				add_shortcode('cleanup_login', array($this, 'cleanup_login_func'));
				add_shortcode('cleanup_author_directory', array($this, 'cleanup_author_directory_func'));					
				
				add_shortcode('cleanup_categories', array($this, 'cleanup_categories_func'));
				add_shortcode('cleanup_featured', array($this, 'cleanup_featured_func'));					
				add_shortcode('cleanup_map', array($this, 'cleanup_map_func'));												
				add_shortcode('cleanup_archive_grid_no_map', array($this, 'cleanup_archive_grid_no_map_func'));
				add_shortcode('cleanup_archive_grid', array($this, 'cleanup_archive_grid_func'));
				add_shortcode('cleanup_archive_grid_top_map', array($this, 'cleanup_archive_grid_top_map_func'));
				add_shortcode('cleanup_search', array($this, 'cleanup_search_func'));
				add_shortcode('cleanup_search_popup', array($this, 'cleanup_search_popup_func'));
				add_shortcode('cleanup_listing_filter', array($this, 'cleanup_cleanup_listing_filter_func'));					
				add_shortcode('cleanup_categories_carousel', array($this, 'cleanup_categories_carousel_func'));
				add_shortcode('cleanup_tags_carousel', array($this, 'cleanup_tags_carousel_func'));
				add_shortcode('cleanup_locations_carousel', array($this, 'cleanup_locations_carousel_func'));
				add_shortcode('cleanup_locations', array($this, 'cleanup_locations_func'));						
				add_shortcode('cleanup_reminder_email_cron', array($this, 'cleanup_reminder_email_cron_func'));
				add_shortcode('cleanup_add_listing', array($this, 'cleanup_add_listing_func'));				
				// 8. Filter	
				add_filter( 'template_include', array($this, 'cleanup_include_template_function'), 9, 2  );
								
				add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'cleanup_plugin_action_links' ) );
				
				//---- COMMENT FILTERS ----//		
				add_action('init', array($this, 'cleanup_remove_admin_bar') );	
				add_action( 'init', array($this, 'cleanup_paypal_form_submit') );
				
				add_action( 'init', array($this, 'cleanup_post_type') );
				add_action( 'init', array($this, 'cleanup_create_taxonomy_category'));
				add_action( 'init', array($this, 'cleanup_create_taxonomy_tags'));
				add_action( 'init', array($this, 'cleanup_create_taxonomy_locations'));
				add_action( 'init', array($this, 'ep_cleanup_pdf_cv') );
				add_action('init', array($this, 'cleanup_all_functions'));
				add_action( 'wp_loaded', array($this, 'cleanup_woocommerce_form_submit') );
				add_action( 'init', array($this, 'ep_cleanup_cpt_columns') );
				// Add color script
				add_action('wp_enqueue_scripts', array($this, 'cleanup_color_js') );
			}
			/**
				* Define constants needed across the plug-in.
			*/
			private function define_constants() {
				if (!defined('cleanup_ep_BASENAME')) define('cleanup_ep_BASENAME', plugin_basename(__FILE__));
				if (!defined('cleanup_ep_DIR')) define('cleanup_ep_DIR', dirname(__FILE__));
				if (!defined('cleanup_ep_FOLDER'))define('cleanup_ep_FOLDER', plugin_basename(dirname(__FILE__)));
				if (!defined('cleanup_ep_ABSPATH'))define('cleanup_ep_ABSPATH', trailingslashit(str_replace("\\", "/", WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)))));
				if (!defined('cleanup_ep_URLPATH'))define('cleanup_ep_URLPATH', trailingslashit(plugins_url() . '/' . plugin_basename(dirname(__FILE__))));
				if (!defined('cleanup_ep_ADMINPATH'))define('cleanup_ep_ADMINPATH', get_admin_url());
				$filename = get_stylesheet_directory()."/cleanup/";
				if (!file_exists($filename)) {					
					if (!defined('cleanup_ep_template'))define( 'cleanup_ep_template', cleanup_ep_ABSPATH.'template/' );
					}else{
					if (!defined('cleanup_ep_template'))define( 'cleanup_ep_template', $filename);
				}	
			}				
			public function cleanup_remove_admin_bar() {
				$iv_hide = get_option('cleanup_hide_admin_bar');
				if (!current_user_can('administrator') && !is_admin()) {
					if($iv_hide=='yes'){							
						show_admin_bar(false);
					}
				}	
			}
			public function cleanup_include_template_function( $template_path ) {
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}				
				$post_type = get_post_type();
				if($post_type==''){
					if(is_post_type_archive($cleanup_directory_url)){
						$post_type =$cleanup_directory_url;
					}
				}				
				if ( $post_type ==$cleanup_directory_url ) { 	 
					if ( is_single() ) { 
						$template_path =  cleanup_ep_template. 'listing/single-listing.php';	
					}				
					if( is_tag() || is_category() || is_archive() ){
						$template_path =  cleanup_ep_template. 'listing/listing-layout.php';
					}
				}
				return $template_path;
			}
			public function cleanup_create_taxonomy_category() {
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				register_taxonomy(
				$cleanup_directory_url.'-category',
				$cleanup_directory_url,
				array(
				'label' => esc_html__( 'Categories','cleanup' ),
				'rewrite' => array( 'slug' => $cleanup_directory_url.'-category' ),
				'hierarchical' => true,					
				'show_in_rest' =>	true,
				)
				);
			}
			public function cleanup_post_type() {
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				$cleanup_directory_url_name=ucfirst($cleanup_directory_url);
				$labels = array(
				'name'                => esc_html($cleanup_directory_url_name),
				'singular_name'       => esc_html($cleanup_directory_url_name),
				'menu_name'           => esc_html($cleanup_directory_url_name),
				'name_admin_bar'      => esc_html($cleanup_directory_url_name),
				'parent_item_colon'   => esc_html__( 'Parent Item:', 'cleanup' ),
				'all_items'           => esc_html__( 'All ', 'cleanup' ).$cleanup_directory_url_name,
				'add_new_item'        => esc_html__( 'Add New Item', 'cleanup' ),
				'add_new'             => esc_html__( 'Add New', 'cleanup' ),
				'new_item'            => esc_html__( 'New Item', 'cleanup' ),
				'edit_item'           => esc_html__( 'Edit Item', 'cleanup' ),
				'update_item'         => esc_html__( 'Update Item', 'cleanup' ),
				'view_item'           => esc_html__( 'View Item', 'cleanup' ),
				'search_items'        => esc_html__( 'Search Item', 'cleanup' ),
				'not_found'           => esc_html__( 'Not found', 'cleanup' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'cleanup' ),
				);
				$args = array(
				'label'               => esc_html( $cleanup_directory_url_name ),
				'description'         => esc_html($cleanup_directory_url_name ),
				'labels'              => $labels,
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),					
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu' => 		'cleanup',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,
				'show_in_rest' =>	true,	
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				);
				register_post_type( $cleanup_directory_url, $args );
						///******Review**********
				$labels2 = array(
				'name'                => _x( 'Reviews', 'Post Type General Name', 'cleanup' ),
				'singular_name'       => _x( 'Reviews', 'Post Type Singular Name', 'cleanup' ),
				'menu_name'           => esc_html__( 'Reviews', 'cleanup' ),
				'name_admin_bar'      =>esc_html__( 'Reviews', 'cleanup' ),
				'parent_item_colon'   => esc_html__( 'Parent Item:', 'cleanup' ),
				'all_items'           => esc_html__( 'All Reviews', 'cleanup' ),
				'add_new_item'        => esc_html__( 'Add New Review', 'cleanup' ),
				'add_new'             => esc_html__( 'Add New', 'cleanup' ),
				'new_item'            => esc_html__( 'New Review', 'cleanup' ),
				'edit_item'           => esc_html__( 'Edit Review', 'cleanup' ),
				'update_item'         => esc_html__( 'Update Review', 'cleanup' ),
				'view_item'           => esc_html__( 'View Review', 'cleanup' ),
				'search_items'        => esc_html__( 'Search Review', 'cleanup' ),
				'not_found'           => esc_html__( 'Not found', 'cleanup' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'cleanup' ),
				);
				$args2 = array(
				'label'               => esc_html__( 'Reviews', 'cleanup' ),
				'description'         => esc_html__( 'Reviews: Directory Pro', 'cleanup' ),
				'labels'              => $labels2,
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu' => 		'cleanup',
				'menu_position'       => 5,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'show_in_rest' =>true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				);
				register_post_type( 'cleanup_review', $args2 );
				
				///******Booking**********
				$labels2 = array(
				'name'                => _x( 'Booking', 'Post Type General Name', 'cleanup' ),
				'singular_name'       => _x( 'Booking', 'Post Type Singular Name', 'cleanup' ),
				'menu_name'           => esc_html__( 'Booking', 'cleanup' ),
				'name_admin_bar'      =>esc_html__( 'Booking', 'cleanup' ),
				'parent_item_colon'   => esc_html__( 'Parent Item:', 'cleanup' ),
				'all_items'           => esc_html__( 'All Booking', 'cleanup' ),
				'add_new_item'        => esc_html__( 'Add New Review', 'cleanup' ),
				'add_new'             => esc_html__( 'Add New', 'cleanup' ),
				'new_item'            => esc_html__( 'New Review', 'cleanup' ),
				'edit_item'           => esc_html__( 'Edit Review', 'cleanup' ),
				'update_item'         => esc_html__( 'Update Review', 'cleanup' ),
				'view_item'           => esc_html__( 'View Review', 'cleanup' ),
				'search_items'        => esc_html__( 'Search Review', 'cleanup' ),
				'not_found'           => esc_html__( 'Not found', 'cleanup' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'cleanup' ),
				);
				$args2 = array(
				'label'               => esc_html__( 'Booking', 'cleanup' ),
				'description'         => esc_html__( 'Booking', 'cleanup' ),
				'labels'              => $labels2,
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu' => 		'cleanup',
				'menu_position'       => 6,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'show_in_rest' =>true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				);
				register_post_type( 'cleanup_booking', $args2 );
				
				// Message 
				$labels4 = array(
				'name'                => esc_html__( 'Message', 'Post Type General Name', 'cleanup' ),
				'singular_name'       => esc_html__( 'Message', 'Post Type Singular Name', 'cleanup' ),
				'menu_name'           => esc_html__( 'Message', 'cleanup' ),
				'name_admin_bar'      => esc_html__( 'Message', 'cleanup' ),
				'parent_item_colon'   => esc_html__( 'Parent Item:', 'cleanup' ),
				'all_items'           => esc_html__( 'All Message', 'cleanup' ),
				'add_new_item'        => esc_html__( 'Add New Item', 'cleanup' ),
				'add_new'             => esc_html__( 'Add New', 'cleanup' ),
				'new_item'            => esc_html__( 'New Item', 'cleanup' ),
				'edit_item'           => esc_html__( 'Edit Item', 'cleanup' ),
				'update_item'         => esc_html__( 'Update Item', 'cleanup' ),
				'view_item'           => esc_html__( 'View Item', 'cleanup' ),
				'search_items'        => esc_html__( 'Search Item', 'cleanup' ),
				'not_found'           => esc_html__( 'Not found', 'cleanup' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'cleanup' ),
				);
				$args4 = array(
				'label'               => esc_html__( 'Message', 'cleanup' ),
				'description'         => esc_html__( 'Message', 'cleanup' ),
				'labels'              => $labels4,
				'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),					
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu' => 		'cleanup',
				'menu_position'       => 5,
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'show_in_rest' =>true,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'post',
				);
				register_post_type( 'cleanup_message', $args4 );
			}
			public function cleanup_post_type_tags_fix($request) {
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				if ( isset($request['tag']) && !isset($request['post_type']) ){
					$request['post_type'] = $cleanup_directory_url;
				}
				return $request;
			} 
			public function ep_cleanup_cpt_columns(){ 				
				require_once(cleanup_ep_DIR . '/admin/pages/manage-cpt-columns.php');				
			}
			public function cleanup_plugin_action_links( $links ) {
				return array_merge( array(
				'settings' => '<a href="admin.php?page=cleanup-settings">' . esc_html__( 'Settings', 'cleanup' ).'</a>',
				'doc'  => '<a href="'.esc_url('http://help.eplug-ins.com/cleanup').'">' . esc_html__( 'Docs', 'cleanup' ) . '</a>',
				), $links );
			}	
		
			
			public function author_public_profile() {
				$author = get_the_author();	
				$iv_redirect = get_option('cleanup_profile_public_page');
				if($iv_redirect!='defult'){ 
					$reg_page= get_permalink( $iv_redirect) ; 
					return    $reg_page.'?&id='.$author; 
					exit;
				}
			}
			
			public function cleanup_login_func($atts = ''){
			
				global $current_user;
				ob_start();		
				if($current_user->ID==0){
					include(cleanup_ep_template. 'private-profile/profile-login.php');
					}else{	
					include( cleanup_ep_template. 'private-profile/profile-template-1.php');
				}	
				$content = ob_get_clean();	
				return $content;
			}
			public function cleanup_forget_password(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'cleanup' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $data_a);
				
				if( ! email_exists(sanitize_email($data_a['forget_email'])) ) {
					echo wp_json_encode(array("code" => "not-success","msg"=>"There is no user registered with that email address."));
					exit(0);
				} else {
					require_once( cleanup_ep_ABSPATH. 'inc/forget-mail.php');
					echo wp_json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				}
			}
			public function cleanup_check_login(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'cleanup' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);
				global $user;
				$creds = array();
				$creds['user_login'] =sanitize_text_field($form_data['username']);
				$creds['user_password'] =  sanitize_text_field($form_data['password']);
				$creds['remember'] = 'true';
				$secure_cookie = is_ssl() ? true : false;
				$user = wp_signon( $creds, $secure_cookie );
				if ( is_wp_error($user) ) {
					echo wp_json_encode(array("code" => "not-success","msg"=>$user->get_error_message()));
					exit(0);
				}
				if ( !is_wp_error($user) ) {
					$iv_redirect = get_option('cleanup_profile_page');
					if($iv_redirect!='defult'){
						$reg_page= get_permalink( $iv_redirect); 
						echo wp_json_encode(array("code" => "success","msg"=>$reg_page));
						exit(0);
					}
				}		
			}
			public function get_unique_keyword_values( $post_type , $key = 'keyword' ){
				global $wpdb;
				if( empty( $key ) ){
					return;
				}	
				$res=array();
				$args = array(
				'post_type' => $post_type, // enter your custom post type						
				'post_status' => 'publish',						
				'posts_per_page'=> -1,  // overrides posts per page in theme settings
				);
				$query_auto = new WP_Query( $args );
				$posts_auto = $query_auto->posts;						
				foreach($posts_auto as $post_a) {
					$res[]=$post_a->post_title;
				}	
				return $res;
			}
			public function get_unique_post_meta_values( $post_type, $key = 'postcode' ){
				global $wpdb;
				$cleanup_directory_url=get_option('cleanup_ep_url');
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				if( empty( $key ) ){
					return;
				}	
				$res = $wpdb->get_col( $wpdb->prepare( "SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id WHERE p.post_type=%s AND  pm.meta_key = %s",$post_type, $key) );
				return $res;
			}  
			public function cleanup_check_field_input_access($field_key_pass, $field_value, $user_id, $template='myaccount'){ 
				global $current_user;
				$current_user_id= $current_user->ID;
					
				
				$field_type_opt=  get_option( 'cleanup_field_type' );
				if(!empty($field_type_opt)){
					$field_type=get_option('cleanup_field_type' ); 
					}else{
					$field_type= array();
					$field_type['full_name']='text';					 
					$field_type['tagline']='text';
					$field_type['phone']='text';								
					$field_type['address']='text';
					$field_type['city']='text';
					$field_type['postcode']='text';
					$field_type['state']='text';
					$field_type['country']='text';
					$field_type['website']='url';	
					$field_type['description']='textarea';		
				}
				$field_type_value= get_option( 'cleanup_field_type_value' );
				
				$return_value='';
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='dropdown'){	 								
					$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group">
					<label class="control-label">'. esc_html($field_value).'</label>
					<select name="'. esc_html($field_key_pass).'" id="'.esc_attr($field_key_pass).'" class="form-control col-md-12"  >';				
					foreach($dropdown_value as $one_value){	 
						if(trim($one_value)!=''){
							$return_value=$return_value.'<option '.(trim(get_user_meta($current_user_id,$field_key_pass,true))==trim($one_value)?' selected':'').' value="'. esc_attr($one_value).'">'. esc_html($one_value).'</option>';
						}
					}	
					$return_value=$return_value.'</select></div></div>';					
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='checkbox'){	 								
					$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group">
					<label class="control-label ">'. esc_html($field_value).'</label>						
					';
					$saved_checkbox_value =	explode(',',get_user_meta($current_user_id,$field_key_pass,true));
					foreach($dropdown_value as $one_value){
						if(trim($one_value)!=''){
							$return_value=$return_value.'
							<div class="form-check form-check-inline">
							<label class="form-check-label" for="'. esc_attr($one_value).'">
							<input '.( in_array($one_value,$saved_checkbox_value)?' checked':'').' class=" form-check-input" type="checkbox" name="'. esc_attr($field_key_pass).'[]"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'">
							'. esc_html($one_value).' </label>
							</div>';
						}
					}	
					$return_value=$return_value.'</div></div>';						
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='radio'){	 								
					$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group ">
					<label class="control-label ">'. esc_html($field_value).'</label>
					';						
					foreach($dropdown_value as $one_value){	 
						if(trim($one_value)!=''){
							$return_value=$return_value.'
							<div class="form-check form-check-inline">
							<label class="form-check-label" for="'. esc_attr($one_value).'">
							<input '.(get_user_meta($current_user_id,$field_key_pass,true)==$one_value?' checked':'').' class="form-check-input" type="radio" name="'. esc_attr($field_key_pass).'"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'">
							'. esc_html($one_value).'</label>
							</div>														
							';
						}
					}	
					$return_value=$return_value.'</div></div>';					
				}					 
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='textarea'){	 
					$return_value=$return_value.'<div class="col-md-12"><div class="form-group">';
					$return_value=$return_value.'<label class="control-label ">'. esc_html($field_value).'</label>';
					$return_value=$return_value.'<textarea  placeholder="'.esc_html__('Enter ','cleanup').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-textarea col-md-12"  rows="4"/>'.esc_textarea(get_user_meta($current_user_id,$field_key_pass,true)).'</textarea></div></div>';
						
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='datepicker'){	 
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group ">';
					$return_value=$return_value.'<label class="control-label ">'. esc_html($field_value).'</label>';
					$return_value=$return_value.'<input type="text" placeholder="'.esc_html__('Select ','cleanup').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control epinputdate " value="'.esc_attr(get_user_meta($current_user_id,$field_key_pass,true)).'"/></div></div>';
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='text'){ 
					if($field_value=='address'){								
						$return_value=$return_value.'<input type="hidden" class="form-control" name="address" id="address" value="'. esc_attr(get_user_meta($current_user_id,'address',true)).'" >									
						<div class=" form-group col-md-12">
						<label for="text" class=" control-label">'.esc_html__('Address','cleanup').'</label>
						<div id="map"></div>
						<div id="search-box"></div>
						<div id="result"></div>
						</div>';
						}else{
						$return_value=$return_value.'<div class="col-md-6"><div class="form-group ">';
						$return_value=$return_value.'<label class="control-label ">'. esc_html($field_value).'</label>';
						$return_value=$return_value.'<input type="text" placeholder="'.esc_html__('Enter ','cleanup').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control " value="'.esc_attr(get_user_meta($current_user_id,$field_key_pass,true)).'"/></div></div>';
					}
				}
				if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='url'){	 
					$return_value=$return_value.'<div class="col-md-6"><div class="form-group ">';
					$return_value=$return_value.'<label class="control-label ">'. esc_html($field_value).'</label>';
					$return_value=$return_value.'<input type="text" placeholder="'.esc_html__('Enter ','cleanup').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control " value="'.esc_url(get_user_meta($current_user_id,$field_key_pass,true)).'"/></div></div>';
				}
				return $return_value;
			}
			public function cleanup_check_field_input_access_signup($field_key_pass, $field_value){ 
				$sign_up_array=		get_option( 'cleanup_signup_fields');
				$require_array=		get_option( 'cleanup_signup_require');
				$field_type=  		get_option( 'cleanup_field_type' );
				$field_type_value=  get_option( 'cleanup_field_type_value' );
				$field_type_roles=  get_option( 'cleanup_field_type_roles' );
				$myaccount_fields_array=  get_option( 'cleanup_myaccount_fields' );
				$return_value='';
				$require='no';				
				if(isset($require_array[$field_key_pass]) && $require_array[$field_key_pass] == 'yes') {
					$require='yes';
				}
				if(isset($sign_up_array[$field_key_pass]) && $sign_up_array[$field_key_pass]=='yes'){
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='dropdown'){	 								
						$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
						$return_value=$return_value.'<div class="form-group row">
						<label class="control-label col-md-4">'. esc_html($field_value).'</label>
						<div class="col-md-8"><select name="'. esc_html($field_key_pass).'" id="'.esc_attr($field_key_pass).'" class="form-dropdown col-md-12" '.($require=='yes'?'data-validation="required" data-validation-error-msg="'. esc_html__('This field cannot be left blank','cleanup').'"':'').'>';				
						foreach($dropdown_value as $one_value){	 	
							if(trim($one_value)!=''){
								$return_value=$return_value.'<option value="'. esc_attr($one_value).'">'. esc_html($one_value).'</option>';
							}
						}	
						$return_value=$return_value.'</select></div></div>';					
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='checkbox'){	 								
						$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
						$return_value=$return_value.'<div class="form-group row">
						<label class="control-label col-md-4">'. esc_html($field_value).'</label>
						<div class="col-md-8">
						<div class="" >
						';
						foreach($dropdown_value as $one_value){
							if(trim($one_value)!=''){
								$return_value=$return_value.'
								<div class="form-check form-check-inline col-md-4">
								<input class=" form-check-input" type="checkbox" name="'. esc_attr($field_key_pass).'[]"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'" '.($require=='yes'?'data-validation="required" data-validation-error-msg="'. esc_html__('Required','cleanup').'"':'').'>
								<label class="form-check-label" for="'. esc_attr($one_value).'">							
								'. esc_attr($one_value).' </label>
								</div>';
							}
						}	
						$return_value=$return_value.'</div></div></div>';						
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='radio'){	 								
						$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
						$return_value=$return_value.'<div class="form-group row ">
						<label class="control-label col-md-4">'. esc_html($field_value).'</label>
						<div class="col-md-8">
						<div class="" >
						';						
						foreach($dropdown_value as $one_value){	 		
							if(trim($one_value)!=''){
								$return_value=$return_value.'
								<div class="form-check form-check-inline col-md-4">
								<label class="form-check-label" for="'. esc_attr($one_value).'">
								<input class="form-check-input" type="radio" name="'. esc_attr($field_key_pass).'"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'" '.($require=='yes'?'data-validation="required" data-validation-error-msg="'. esc_html__('Required','cleanup').'"':'').'>
								'. esc_attr($one_value).'</label>
								</div>';
							}
						}	
						$return_value=$return_value.'</div></div></div>';					
					}					 
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='textarea'){	 
						$return_value=$return_value.'<div class="form-group row">';
						$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label><div class="col-md-8">';
						$return_value=$return_value.'<textarea  placeholder="'.esc_html__('Enter ','cleanup').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-textarea col-md-12"  rows="4"/ '.($require=='yes'?'data-validation="length" data-validation-length="2-100"':'').'></textarea></div></div>';
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='datepicker'){	 
						$return_value=$return_value.'<div class="form-group row">';
						$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
						$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Select ','cleanup').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-date col-md-12 epinputdate " '.($require=='yes'?'data-validation="required" data-validation-error-msg="'. esc_html__('This field cannot be left blank','cleanup').'"':'').' /></div></div>';
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='text'){	 
						$return_value=$return_value.'<div class="form-group row">';
						$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
						$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Enter ','cleanup').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-input col-md-12" '.($require=='yes'?'data-validation="length" data-validation-length="2-100"':'').' /></div></div>';
					}
					if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='url'){	 
						$return_value=$return_value.'<div class="form-group row">';
						$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
						$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Enter ','cleanup').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-input col-md-12" '.($require=='yes'?'data-validation="length" data-validation-length="2-100"':'').' /></div></div>';
					}
				}
				return $return_value;
			}
			public function cleanup_chatgpt_upload_image(){
				require_once(ABSPATH . 'wp-admin/includes/media.php');
				require_once(ABSPATH . 'wp-admin/includes/file.php');
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'addlisting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $current_user;				
				parse_str($_POST['form_data'], $form_data);
				if(isset($form_data['gpt_image'])){
					$url = $form_data['gpt_image'];
					$image_url='';$attachment_id='';	
					$attachment_id = media_sideload_image($url, 0, 'Image description','id');			
					if (!is_wp_error($attachment_id)) {
						$image_url_arr = wp_get_attachment_image_src( $attachment_id, 'full' );
						if(isset($image_url_arr[0])){
							$image_url = $image_url_arr[0];
						}						
					}					
				}			
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup'),"attachment_id"=> $attachment_id,"image_url"=> $image_url ));
				exit(0);
			}
		
			public function cleanup_save_user_review(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'listing' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $current_user;
				parse_str($_POST['form_data'], $form_data);
				$post_type = 'cleanup_review';
				$args = array(
				'post_type' => $post_type, 
				'author' => sanitize_text_field($form_data['listingid']),
				);
				$the_query_review = new WP_Query( $args );
				$deleteid ='';
				if ( $the_query_review->have_posts() ) :
				while ( $the_query_review->have_posts() ) : $the_query_review->the_post();
				$deleteid = get_the_ID();
				if(get_post_meta($deleteid,'review_submitter',true)==$current_user->ID){
					wp_delete_post($deleteid );
				}
				endwhile;
				endif;
				$my_post= array();
				$my_post['post_author'] = sanitize_text_field($form_data['listingid']);
				$my_post['post_title'] = sanitize_text_field($form_data['review_subject']);
				$my_post['post_content'] = sanitize_textarea_field($form_data['review_comment']);
				$my_post['post_status'] = 'publish';
				$my_post['post_type'] = $post_type;
				$newpost_id= wp_insert_post( $my_post );
				$review_value=1;
				if(isset($form_data['star']) ){$review_value=sanitize_text_field($form_data['star']);}
				update_post_meta($newpost_id, 'review_submitter', $current_user->ID);
				update_post_meta($newpost_id, 'review_value', $review_value);	
				
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function user_profile_image_upload($userid){
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				require_once(ABSPATH . 'wp-admin/includes/file.php');
				require_once(ABSPATH . 'wp-admin/includes/media.php');
		  
				$iv_membership_signup_profile_pic=get_option('cleanup_signup_profile_pic');
				if($iv_membership_signup_profile_pic=='' ){ $iv_membership_signup_profile_pic='yes';}	
				if($iv_membership_signup_profile_pic=='yes' ){ 
					if ( 0 < $_FILES['profilepicture']['error'] ) { 
										
					}
					else {  
						$new_file_type = mime_content_type( $_FILES['profilepicture']['tmp_name'] );	
						if( in_array( $new_file_type, get_allowed_mime_types() ) ){   
							$upload_dir   = wp_upload_dir();
							$date = gmdate('YmdHis');		
							$upload_overrides = array('test_form' => false);
							$file_name = $date.$_FILES['profilepicture']['name'];	
							
							$file = $_FILES['profilepicture'];
							$return=  wp_handle_upload($file, $upload_overrides);
							
							if ($return && !isset($return['error'])) {
								$image_url= $return['url'];
								update_user_meta($userid, 'cleanup_profile_pic_thum',sanitize_url($image_url));
							}
						}
					}
				}
			}
			public function cleanup_update_wp_post(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'addlisting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'edit_posts' ) ) {
					wp_die( 'Are you cheating:user Permission?' );								
				}
				global $current_user;global $wpdb;	
				$allowed_html = wp_kses_allowed_html( 'post' );	
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				parse_str($_POST['form_data'], $form_data);
				$newpost_id= sanitize_text_field($form_data['user_post_id']);
				$my_post = array();
				$my_post['ID'] = $newpost_id;
				$my_post['post_title'] = sanitize_text_field($form_data['title']);
				$my_post['post_content'] =  wp_kses( $form_data['new_post_content'], $allowed_html);
				$my_post['post_type'] 	= $cleanup_directory_url;					
				$cleanup_user_can_publish=get_option('cleanup_user_can_publish');	
				if($cleanup_user_can_publish==""){$cleanup_user_can_publish='yes';}	
				$my_post['post_status']=$form_data['post_status'];
				if($form_data['post_status']=='publish'){					
					$my_post['post_status']='pending';
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
						$my_post['post_status']='publish';
						}else{ 
						if($cleanup_user_can_publish=="yes"){ 
							$my_post['post_status']='publish';
							}else{
							$my_post['post_status']='pending';
						}								
					}						
				}
				wp_update_post( $my_post );
				if(isset($form_data['feature_image_id'] ) AND $form_data['feature_image_id']!='' ){
					$attach_id =sanitize_text_field($form_data['feature_image_id']);
					set_post_thumbnail( sanitize_text_field($form_data['user_post_id']), $attach_id );
					}else{
					$attach_id='0';
					delete_post_thumbnail( sanitize_text_field($form_data['user_post_id']));
				}
				if(isset($form_data['postcats'] )){ 
					$category_ids = $form_data['postcats'];
					$input_array_data= sanitize_text_field($category_ids) ;
					if(is_array($category_ids)){
						$input_array_data= array();
						foreach($category_ids as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-category');
				}
				if(isset($form_data['new_category'] )){						
					$tag_new= explode(",", $form_data['new_category']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-category');
					}
				}	
				// Location
				if(isset($form_data['location_arr'] )){ 
					$location_arr = $form_data['location_arr'];
					$input_array_data= sanitize_text_field($location_arr) ;
					if(is_array($location_arr)){
						$input_array_data= array();
						foreach($location_arr as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-locations');
				}
				if(isset($form_data['new_location'] )){						
					$tag_new= explode(",", $form_data['new_location']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-locations');
					}
				}	
				// Check Feature*************	
				$post_author_id= $current_user->ID;
				$author_package_id=get_user_meta($post_author_id, 'cleanup_package_id', true);
				$have_package_feature= get_post_meta($author_package_id,'cleanup_package_feature',true);
				$exprie_date= strtotime (get_user_meta($post_author_id, 'cleanup_exprie_date', true));
				$current_date=time();						
				if($have_package_feature=='yes'){
					if($exprie_date >= $current_date){ 
						update_post_meta($newpost_id, 'cleanup_featured', 'featured' );	
					}	
					}else{
					update_post_meta($newpost_id, 'cleanup_featured', 'no' );	
				}
				// listing detail *****	
			
				// For Tag Save tag_arr			
				$tag_all='';
				if(isset($form_data['tag_arr'] )){
					$tag_name= $form_data['tag_arr'] ;	
					$input_array_data= sanitize_text_field($tag_name) ;
					if(is_array($tag_name)){
						$input_array_data= array();
						foreach($tag_name as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					$i=0;$tag_all='';						
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-tag');							
				}
				$tag_all='';
				if(isset($form_data['new_tag'] )){						
					$tag_new= explode(",", $form_data['new_tag']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-tag');											
						$i++;	
					}
				}	
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude']));  
				update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
				update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
				update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
				update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
				update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
				update_post_meta($newpost_id, 'local-area', sanitize_text_field($form_data['local-area'])); 
				
				$opening_day=array();
				if(isset($form_data['day_name'] )){
					$day_name= $form_data['day_name'] ;
					$day_value1 = $form_data['day_value1'];
					$day_value2 = $form_data['day_value2'] ;
					$i=0;
					foreach($day_name  as $one_meta){
						if(isset($day_name[$i]) and isset($day_value1[$i]) ){
							if($day_name[$i] !=''){
								$opening_day[sanitize_text_field($day_name[$i])]= array(sanitize_text_field($day_value1[$i])=>sanitize_text_field($day_value2[$i])) ;
							}
						}
						$i++;
					}
					update_post_meta($newpost_id, '_opening_time', $opening_day);
				}
				// For FAQ Save
				// Delete 1st
				$i=0;
				for($i=0;$i<20;$i++){
					delete_post_meta($newpost_id, 'faq_title'.$i);							
					delete_post_meta($newpost_id, 'faq_description'.$i);
				}
				// Delete End
				if(isset($form_data['faq_title'] )){
					$faq_title= $form_data['faq_title']; //this is array data we sanitize later, when it save				
					$faq_description= $form_data['faq_description'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($faq_title[$i]) AND $faq_title[$i]!=''){
							update_post_meta($newpost_id, 'faq_title'.$i, sanitize_text_field($faq_title[$i]));
							update_post_meta($newpost_id, 'faq_description'.$i, sanitize_textarea_field($faq_description[$i]));
						}
					}
				}
				// End FAQ
				$default_fields = array();
				$field_set=get_option('cleanup_li_fields' );
				if($field_set!=""){ 
					$default_fields=get_option('cleanup_li_fields' );
					}else{	
					$default_fields['cleaning_hours']='Cleaning Hours';
					$default_fields['number_of_cleaner']='Number Of Cleaner';	
				}				
				if(sizeof($default_fields )){			
					foreach( $default_fields as $field_key => $field_value ) { 
						update_post_meta($newpost_id, $field_key, $form_data[$field_key] );							
					}					
				}
				// listing detail*****		
				
				if(isset($form_data['dirpro_email_button'])){						
					update_post_meta($newpost_id, 'dirpro_email_button', sanitize_text_field($form_data['dirpro_email_button'])); 
				}
				if(isset($form_data['dirpro_web_button'])){						
					update_post_meta($newpost_id, 'dirpro_web_button', sanitize_text_field($form_data['dirpro_web_button'])); 
				}
				update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($form_data['gallery_image_ids'])); 
				update_post_meta($newpost_id, 'attached_ids', sanitize_text_field($form_data['attached_ids']));
				update_post_meta($newpost_id, 'topbanner', sanitize_text_field($form_data['topbanner_image_id'])); 
				if(isset($form_data['feature_image_id'] )){
					$attach_id =sanitize_text_field($form_data['feature_image_id']);
					set_post_thumbnail( $newpost_id, $attach_id );					
				}	
				
				update_post_meta($newpost_id, 'price', sanitize_text_field($form_data['price']));
				update_post_meta($newpost_id, 'discount', sanitize_text_field($form_data['discount']));
				update_post_meta($newpost_id, 'whatsapp', sanitize_text_field($form_data['whatsapp']));
				update_post_meta($newpost_id, 'viber', sanitize_text_field($form_data['viber']));
				
				update_post_meta($newpost_id, 'listing_contact_source', sanitize_text_field($form_data['contact_source']));  
				update_post_meta($newpost_id, 'company_name', sanitize_text_field($form_data['company_name']));
				update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
				update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web']));				
				update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
				update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube'])); 
				delete_post_meta($newpost_id, 'cleanup-tags');
				delete_post_meta($newpost_id, 'cleanup-category');
				delete_post_meta($newpost_id, 'cleanup-locations');
				
				if($form_data['post_status']=='publish'){ 
					include( cleanup_ep_ABSPATH. 'inc/add-listing-notification.php');
					include( cleanup_ep_ABSPATH. 'inc/notification.php');
				}
				wp_send_json(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				
				exit(0);				
			}
			public function cleanup_save_wp_post(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'addlisting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				
				$allowed_html = wp_kses_allowed_html( 'post' );	
				global $current_user; global $wpdb;	
				parse_str($_POST['form_data'], $form_data);				
				$my_post = array();
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				$post_type = $cleanup_directory_url;
				$cleanup_user_can_publish=get_option('cleanup_user_can_publish');	
				if($cleanup_user_can_publish==""){$cleanup_user_can_publish='yes';}	
				if($form_data['post_status']=='publish'){					
					$form_data['post_status']='pending';
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
						$form_data['post_status']='publish';
						}else{
						if($cleanup_user_can_publish=="yes"){
							$form_data['post_status']='publish';
							}else{
							$form_data['post_status']='pending';
						}								
					}						
				}
				$my_post['post_title'] = sanitize_text_field($form_data['title']);
				$my_post['post_content'] = wp_kses( $form_data['new_post_content'], $allowed_html); 
				$my_post['post_type'] = $post_type;
				$my_post['post_status'] = sanitize_text_field($form_data['post_status']);										
				$newpost_id= wp_insert_post( $my_post );
				update_post_meta($newpost_id, 'cleanup_listing_status', sanitize_text_field($form_data['listing_type'])); 
				
				if(isset($form_data['postcats'] )){ 				
					$category_ids = $form_data['postcats'];
					$input_array_data= sanitize_text_field($category_ids) ;
					if(is_array($category_ids)){
						$input_array_data= array();
						foreach($category_ids as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-category');
				}
				if(isset($form_data['new_category'] )){						
					$tag_new= explode(",", $form_data['new_category']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-category');							
					}
				}	
				$opening_day=array();
				if(isset($form_data['day_name'] )){
					$day_name= $form_data['day_name'] ;
					$day_value1 = $form_data['day_value1'];
					$day_value2 = $form_data['day_value2'] ;
					$i=0;
					foreach($day_name  as $one_meta){
						if(isset($day_name[$i]) and isset($day_value1[$i]) ){
							if($day_name[$i] !=''){
								$opening_day[sanitize_text_field($day_name[$i])]= array(sanitize_text_field($day_value1[$i])=>sanitize_text_field($day_value2[$i])) ;
							}
						}
						$i++;
					}
					update_post_meta($newpost_id, '_opening_time', $opening_day);
				}
				// For FAQ Save				
				if(isset($form_data['faq_title'] )){
					$faq_title= $form_data['faq_title']; //this is array data we sanitize later, when it save				
					$faq_description= $form_data['faq_description'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($faq_title[$i]) AND $faq_title[$i]!=''){
							update_post_meta($newpost_id, 'faq_title'.$i, sanitize_text_field($faq_title[$i]));
							update_post_meta($newpost_id, 'faq_description'.$i, sanitize_textarea_field($faq_description[$i]));
						}
					}
				}
				// End FAQ
				// Location
				if(isset($form_data['location_arr'] )){ 
					$location_arr = $form_data['location_arr'];
					$input_array_data= sanitize_text_field($location_arr) ;
					if(is_array($location_arr)){
						$input_array_data= array();
						foreach($location_arr as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-locations');
				}
				if(isset($form_data['new_location'] )){						
					$tag_new= explode(",", $form_data['new_location']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-locations');
					}
				}	
				$default_fields = array();
				$field_set=get_option('cleanup_li_fields' );
				if($field_set!=""){ 
					$default_fields=get_option('cleanup_li_fields' );
					}else{	
					$default_fields['cleaning_hours']='Cleaning Hours';
					$default_fields['number_of_cleaner']='Number Of Cleaner';	
				}					
				if(sizeof($default_fields )){			
					foreach( $default_fields as $field_key => $field_value ) { 
						update_post_meta($newpost_id, $field_key, $form_data[$field_key] );							
					}					
				}
				// Check Feature*************	
				$post_author_id= $current_user->ID;
				$author_package_id=get_user_meta($post_author_id, 'cleanup_package_id', true);
				$have_package_feature= get_post_meta($author_package_id,'cleanup_package_feature',true);
				$exprie_date= strtotime (get_user_meta($post_author_id, 'cleanup_exprie_date', true));
				$current_date=time();						
				if($have_package_feature=='yes'){
					if($exprie_date >= $current_date){
						update_post_meta($newpost_id, 'cleanup_featured', 'featured' );	
					}	
					}else{
					update_post_meta($newpost_id, 'cleanup_featured', 'no' );	
				}
				
				// For Tag Save tag_arr
				$tag_all='';
				if(isset($form_data['tag_arr'] )){
					$tag_name= $form_data['tag_arr'] ;	
					$input_array_data= sanitize_text_field($tag_name) ;
					if(is_array($tag_name)){
						$input_array_data= array();
						foreach($tag_name as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					$i=0;$tag_all='';						
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-tag');							
				}
				$tag_all='';
				if(isset($form_data['new_tag'] )){						
					$tag_new= explode(",", $form_data['new_tag']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-tag');											
						$i++;	
					}
				}	
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude'])); 
				update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
				update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
				update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
				update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
				update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
				update_post_meta($newpost_id, 'local-area', sanitize_text_field($form_data['local-area'])); 
				// listing detail*****
								
				if(isset($form_data['dirpro_email_button'])){						
					update_post_meta($newpost_id, 'dirpro_email_button', sanitize_text_field($form_data['dirpro_email_button'])); 
				}
				if(isset($form_data['dirpro_web_button'])){						
					update_post_meta($newpost_id, 'dirpro_web_button', sanitize_text_field($form_data['dirpro_web_button'])); 
				}
				update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($form_data['gallery_image_ids']));
				update_post_meta($newpost_id, 'attached_ids', sanitize_text_field($form_data['attached_ids']));
				update_post_meta($newpost_id, 'topbanner', sanitize_text_field($form_data['topbanner_image_id'])); 
				update_post_meta($newpost_id, 'listing_contact_source', sanitize_text_field($form_data['contact_source']));  
				update_post_meta($newpost_id, 'external_form_url', sanitize_url($form_data['external_form_url']));  
				if(isset($form_data['feature_image_id'] )){
					$attach_id =sanitize_text_field($form_data['feature_image_id']);
					set_post_thumbnail( $newpost_id, $attach_id );					
				}	
				update_post_meta($newpost_id, 'price', sanitize_text_field($form_data['price']));
				update_post_meta($newpost_id, 'discount', sanitize_text_field($form_data['discount']));
				update_post_meta($newpost_id, 'whatsapp', sanitize_text_field($form_data['whatsapp']));
				update_post_meta($newpost_id, 'viber', sanitize_text_field($form_data['viber']));
				update_post_meta($newpost_id, 'company_name', sanitize_text_field($form_data['company_name']));
				update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
				update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web']));
				update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
				update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube']));
				
				include( cleanup_ep_ABSPATH. 'inc/add-listing-notification.php');
				if($form_data['post_status']=='publish'){ 
					include( cleanup_ep_ABSPATH. 'inc/notification.php');
				}
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			// add listing cleanup_save_post_without_user
			public function cleanup_save_post_without_user(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'addlisting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				$allowed_html = wp_kses_allowed_html( 'post' );	
				global $current_user; global $wpdb;	
				parse_str($_POST['form_data'], $form_data);		
				if($form_data['user_id']=='0'){ 					// create new user 
					if($form_data['n_user_email']!='' and $form_data['n_password']!='' ){ 
						$userdata = array();
						$userdata['user_email']=sanitize_email($form_data['n_user_email']);
						$userdata['user_login']='';
						$userdata['user_pass']=sanitize_text_field($form_data['n_password']);
						if ( email_exists($userdata['user_email']) == false ) {						
							$user_id = wp_create_user($userdata['user_email'],$userdata['user_pass'],$userdata['user_email']); 
							
							wp_clear_auth_cookie();
							wp_set_current_user ( $user_id);
							wp_set_auth_cookie  ( $user_id );
							include( cleanup_ep_ABSPATH. 'inc/signup-mail.php');
							}else{
							echo wp_json_encode(array("code" => "error","msg"=>esc_html__( 'Email already exists ', 'cleanup')));
							exit(0);
						}
					}	
				}
				$my_post = array();
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				$post_type = $cleanup_directory_url;
				$cleanup_user_can_publish=get_option('cleanup_user_can_publish');	
				if($cleanup_user_can_publish==""){$cleanup_user_can_publish='yes';}	
				$form_data['post_status']='pending';
				if($form_data['post_status']=='publish'){	
					if($cleanup_user_can_publish=="yes"){
						$form_data['post_status']='publish';
						}else{
						$form_data['post_status']='pending';
					}								
				}
				$my_post['post_title'] = sanitize_text_field($form_data['title']);
				$my_post['post_content'] = wp_kses( $form_data['new_post_content'], $allowed_html); 
				$my_post['post_type'] = $post_type;
				$my_post['post_status'] = sanitize_text_field($form_data['post_status']);										
				$newpost_id= wp_insert_post( $my_post );
				update_post_meta($newpost_id, 'cleanup_listing_status', sanitize_text_field($form_data['listing_type'])); 
				
				if(isset($form_data['postcats'] )){ 				
					$category_ids = $form_data['postcats'];
					$input_array_data= sanitize_text_field($category_ids) ;
					if(is_array($category_ids)){
						$input_array_data= array();
						foreach($category_ids as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-category');
				}
				if(isset($form_data['new_category'] )){						
					$tag_new= explode(",", $form_data['new_category']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-category');							
					}
				}	
				// For FAQ Save				
				if(isset($form_data['faq_title'] )){
					$faq_title= $form_data['faq_title']; //this is array data we sanitize later, when it save				
					$faq_description= $form_data['faq_description'];
					$i=0;
					for($i=0;$i<20;$i++){
						if(isset($faq_title[$i]) AND $faq_title[$i]!=''){
							update_post_meta($newpost_id, 'faq_title'.$i, sanitize_text_field($faq_title[$i]));
							update_post_meta($newpost_id, 'faq_description'.$i, sanitize_textarea_field($faq_description[$i]));
						}
					}
				}
				// End FAQ
				// Location
				if(isset($form_data['location_arr'] )){ 
					$location_arr = $form_data['location_arr'];
					$input_array_data= sanitize_text_field($location_arr) ;
					if(is_array($location_arr)){
						$input_array_data= array();
						foreach($location_arr as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-locations');
				}
				if(isset($form_data['new_location'] )){						
					$tag_new= explode(",", $form_data['new_location']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-locations');
					}
				}	
				$default_fields = array();
				$field_set=get_option('cleanup_li_fields' );
				if($field_set!=""){ 
					$default_fields=get_option('cleanup_li_fields' );
					}else{	
					$default_fields['cleaning_hours']='Cleaning Hours';
					$default_fields['number_of_cleaner']='Number Of Cleaner';	
				}					
				if(sizeof($default_fields )){			
					foreach( $default_fields as $field_key => $field_value ) {
						if(isset($form_data[$field_key])){
							update_post_meta($newpost_id, $field_key, $form_data[$field_key] );				
						}
					}					
				}
				$post_author_id= $current_user->ID;
				update_post_meta($newpost_id, 'listing_education', wp_kses( $form_data['content_education'], $allowed_html));	
				update_post_meta($newpost_id, 'listing_must_have', wp_kses( $form_data['content_must_have'], $allowed_html));
				// For Tag Save tag_arr
				$tag_all='';
				if(isset($form_data['tag_arr'] )){
					$tag_name= $form_data['tag_arr'] ;							
					$i=0;$tag_all='';	
					$input_array_data= sanitize_text_field($tag_name) ;
					if(is_array($tag_name)){
						$input_array_data= array();
						foreach($tag_name as $one_input_field){
							$input_array_data[]=sanitize_text_field($one_input_field);
						}					
					}
					
					wp_set_object_terms( $newpost_id, $input_array_data, $cleanup_directory_url.'-tag');							
				}
				$tag_all='';
				if(isset($form_data['new_tag'] )){						
					$tag_new= explode(",", $form_data['new_tag']); 			
					foreach($tag_new  as $one_tag){	
						wp_add_object_terms( $newpost_id, sanitize_text_field($one_tag), $cleanup_directory_url.'-tag');											
						$i++;	
					}
				}	
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude'])); 
				update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
				update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
				update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
				update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
				update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
			
				// listing detail*****
				update_post_meta($newpost_id, 'educational_requirements', sanitize_text_field($form_data['educational_requirements'])); 
				update_post_meta($newpost_id, 'listing_type', sanitize_text_field($form_data['listing_type'])); 
				update_post_meta($newpost_id, 'cleanup_listing_level', sanitize_text_field($form_data['cleanup_listing_level'])); 
				update_post_meta($newpost_id, 'cleanup_experience_range', sanitize_text_field($form_data['cleanup_experience_range'])); 
				update_post_meta($newpost_id, 'age_range', sanitize_text_field($form_data['age_range'])); 
				update_post_meta($newpost_id, 'gender', sanitize_text_field($form_data['gender'])); 
				update_post_meta($newpost_id, 'vacancy', sanitize_text_field($form_data['vacancy'])); 
				if($form_data['deadline']==''){ 
					$deadline= gmdate("Y-m-d", strtotime("+1 month"));
					}else{
					$deadline=sanitize_text_field($form_data['deadline']);
				}
				update_post_meta($newpost_id, 'deadline', $deadline);  
				update_post_meta($newpost_id, 'workplace', sanitize_text_field($form_data['workplace']));
				update_post_meta($newpost_id, 'salary', sanitize_text_field($form_data['salary']));
				update_post_meta($newpost_id, 'other_benefits', sanitize_text_field($form_data['other_benefits']));
				if(isset($form_data['dirpro_email_button'])){						
					update_post_meta($newpost_id, 'dirpro_email_button', sanitize_text_field($form_data['dirpro_email_button'])); 
				}
				if(isset($form_data['dirpro_web_button'])){						
					update_post_meta($newpost_id, 'dirpro_web_button', sanitize_text_field($form_data['dirpro_web_button'])); 
				}
				update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($form_data['gallery_image_ids'])); 
				update_post_meta($newpost_id, 'attached_ids', sanitize_text_field($form_data['attached_ids']));
				update_post_meta($newpost_id, 'topbanner', sanitize_text_field($form_data['topbanner_image_id'])); 
				update_post_meta($newpost_id, 'listing_contact_source', sanitize_text_field($form_data['contact_source']));  
				update_post_meta($newpost_id, 'external_form_url', sanitize_url($form_data['external_form_url']));  
				if(isset($form_data['feature_image_id'] )){
					$attach_id =sanitize_text_field($form_data['feature_image_id']);
					set_post_thumbnail( $newpost_id, $attach_id );					
				}	
				update_post_meta($newpost_id, 'price', sanitize_text_field($form_data['price']));
				update_post_meta($newpost_id, 'discount', sanitize_text_field($form_data['discount']));
				update_post_meta($newpost_id, 'whatsapp', sanitize_text_field($form_data['whatsapp']));
				update_post_meta($newpost_id, 'viber', sanitize_text_field($form_data['viber']));
				
				update_post_meta($newpost_id, 'company_name', sanitize_text_field($form_data['company_name']));
				update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
				update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
				update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
				update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web']));
				update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
				update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube'])); 
				
					include( cleanup_ep_ABSPATH. 'inc/add-listing-notification.php');
				
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function eppro_upload_featured_image($thumb_url, $post_id ) { 
				require_once(ABSPATH . 'wp-admin/includes/file.php');
				require_once(ABSPATH . 'wp-admin/includes/media.php');
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				// Download file to temp location
				$i=0;$product_image_gallery='';									
				$tmp = download_url( $thumb_url );						
				// Set variables for storage
				// fix file name for query strings
				preg_match('/[^\?]+\.(jpg|JPG|jpe|JPE|jpeg|JPEG|gif|GIF|png|PNG|webp|WEBP)/', $thumb_url, $matches);
				$file_array['name'] = basename($matches[0]);
				$file_array['tmp_name'] = $tmp;
				// If error storing temporarily, unlink
				if ( is_wp_error( $tmp ) ) {
					@unlink($file_array['tmp_name']);
					$file_array['tmp_name'] = '';						
				}
				//use media_handle_sideload to upload img:
				$thumbid = media_handle_sideload( $file_array, $post_id, 'gallery desc' );
				// If error storing permanently, unlink
				if ( is_wp_error($thumbid) ) {
					@unlink($file_array['tmp_name']);										
				}						
				set_post_thumbnail($post_id, $thumbid);	
			}
			public function cleanup_finalerp_csv_product_upload(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'csv' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				$csv_file_id=0;$maping='';
				if(isset($_POST['csv_file_id'])){
					$csv_file_id= sanitize_text_field($_POST['csv_file_id']);
				}
				require(cleanup_ep_DIR .'/admin/pages/importer/upload_main_big_csv.php');
				$total_files = get_option( 'finalerp-number-of-files');
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup'), "maping"=>$maping));
				exit(0);
			}
			public function cleanup_save_csv_file_to_database(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'csv' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$csv_file_id=0;
				if(isset($_POST['csv_file_id'])){
					$csv_file_id= sanitize_text_field($_POST['csv_file_id']);
				}	
				$row_start=0;
				if(isset($_POST['row_start'])){
					$row_start= sanitize_text_field($_POST['row_start']);
				}
				require (cleanup_ep_DIR .'/admin/pages/importer/csv_save_database.php');
				echo wp_json_encode(array("code" => $done_status,"msg"=>esc_html__( 'Updated Successfully', 'cleanup'), "row_done"=>$row_done ));
				exit(0);
			}
			public function cleanup_eppro_get_import_status(){
				$cleanup_total_row = floatval( get_option( 'cleanup_total_row' ));	
				$cleanup_current_row = floatval( get_option( 'cleanup_current_row' ));		
				$progress =  ((int)$cleanup_current_row / (int)$cleanup_total_row)*100;
				if($cleanup_total_row<=$cleanup_current_row){$progress='100';}
				if($progress=='100'){
					echo wp_json_encode(array("code" => "-1","progress"=>(int)$progress, "cleanup_total_row"=>$cleanup_total_row,"cleanup_current_row"=>$cleanup_current_row));	
					}else{
					echo wp_json_encode(array("code" => "0","progress"=>(int)$progress, "cleanup_total_row"=>$cleanup_total_row ,"cleanup_current_row"=>$cleanup_current_row));
				}		  
				exit(0);
			}
			public function ep_cleanup_pdf_cv(){ 				
				require( cleanup_ep_DIR . '/template/pdf/pdf_post.php');
			}
			public function  cleanup_apply_submit_login(){
				global $current_user;
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'listing' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$my_post = array();	
				$allowed_html = wp_kses_allowed_html( 'post' );	
				$cleanup_directory_url='listing_apply';
				$my_post['post_author'] =$current_user->ID;
				$my_post['post_title'] = $current_user->display_name;
				$my_post['post_name'] = $current_user->display_name;
				$my_post['post_content'] =wp_kses( $form_data['cover-content2'], $allowed_html) ;  
				$my_post['post_type'] 	= $cleanup_directory_url;
				$my_post['post_status']='private';						
				$newpost_id= wp_insert_post( $my_post );
				update_post_meta($newpost_id, 'candidate_name', $current_user->display_name); 
				update_post_meta($newpost_id, 'apply_jod_id',  sanitize_text_field($form_data['dir_id']));				
				update_post_meta($newpost_id, 'email_address', $current_user->user_email); 
				update_post_meta($newpost_id, 'user_id', $current_user->ID); 					
				$old_apply=get_user_meta($current_user->ID,'listing_apply_all', true);
				$new_apply=$old_apply.', '.sanitize_text_field($form_data['dir_id']);						
				update_user_meta($current_user->ID,'listing_apply_all',$new_apply);
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Successfully Sent', 'cleanup')));
				// Send Email
				include( cleanup_ep_ABSPATH. 'inc/apply_submit_login.php');
				exit(0);
			}
			public function cleanup_apply_submit_nonlogin(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'listing' ) ) {
				}			
				// Save data
				parse_str($_POST['form_data'], $form_data);
				if ( 0 < $_FILES['file']['error'] ) {
					echo wp_json_encode(array("code" => "Error","msg"=>esc_html__( 'File Error', 'cleanup')));						
				}
				else {									
					$allowed_html = wp_kses_allowed_html( 'post' );								
					if ( ! function_exists( 'wp_handle_upload' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}
					$uploadedfile = $_FILES['file']; 
					$upload_overrides = array(
					'test_form' => false
					);
					$file_url='';$file_name='';
					$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
					if ( $movefile && ! isset( $movefile['error'] ) ) {						
						$file_url = $movefile['url'] ;
						} else {
					}
					// Add post in apply_listing section
					$my_post = array();	
					$cleanup_directory_url='listing_apply';
					$my_post['post_author'] = '0';
					$my_post['post_title'] = sanitize_title($form_data['canname']);
					$my_post['post_name'] = sanitize_text_field($form_data['canname']);
					$my_post['post_content'] =wp_kses( $form_data['cover-content'], $allowed_html) ;  
					$my_post['post_type'] 	= $cleanup_directory_url;
					$my_post['post_status']='private';						
					$newpost_id= wp_insert_post( $my_post );
					update_post_meta($newpost_id, 'candidate_name', sanitize_text_field($form_data['canname'])); 
					update_post_meta($newpost_id, 'apply_jod_id',  sanitize_text_field($form_data['dir_id'])); 
					update_post_meta($newpost_id, 'file_name', $file_name); 
					update_post_meta($newpost_id, 'cv_file_url', $file_url);
					update_post_meta($newpost_id, 'email_address', sanitize_email($form_data['email_address'])); 
					update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['contact_phone'])); 
					echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Successfully Sent', 'cleanup')));
				}
				// Send Email
				include( cleanup_ep_ABSPATH. 'inc/apply_submit_nonlogin.php');
				exit(0);
			}
			public function cleanup_candidate_meeting_popup(){
				$candidate_post_id=$_REQUEST['user_id'];
				include( cleanup_ep_template. 'private-profile/candidate_meeting_popup-file.php');
				exit(0);
			}
			public function cleanup_author_email_popup(){
				include( cleanup_ep_template. 'private-profile/author_email_popup-file.php');
				exit(0);
			}
			public function cleanup_apply_popup(){
				include( cleanup_ep_template. 'listing/apply_popup-file.php');
				exit(0);
			}
			
			
			public function cleanup_woocommerce_form_submit(  ) {
				$iv_gateway = get_option('cleanup_payment_gateway');
				if($iv_gateway=='woocommerce'){ 
					require_once(cleanup_ep_ABSPATH . '/admin/pages/payment-inc/woo-submit.php');
				}	
			}
			
			public function cleanup_contact_popup(){
				include( cleanup_ep_template. 'private-profile/contact_popup.php');
				exit(0);
			}
			public function cleanup_listing_contact_popup(){
				include( cleanup_ep_template. 'listing/contact_popup.php');
				exit(0);
			}
			public function cleanup_chatgtp_settings_popup(){
				include( cleanup_ep_template. 'private-profile/chatgtp_settings_popup.php');
				exit(0);
			}
			public function cleanup_listing_booking_popup(){
				include( cleanup_ep_template. 'listing/booking_popup.php');
				exit(0);
			}
			public function cleanup_get_categories_caching($id, $post_type){				
				if(metadata_exists('post', $id, 'cleanup-category')) {
					$items = get_post_meta($id,'cleanup-category',true );										
					}else{									
					$items=wp_get_object_terms( $id, $post_type.'-category');
					update_post_meta($id, 'cleanup-category' , $items);
				}					
				return $items;
			}
			public function cleanup_get_categories_mapmarker($id, $post_type){	
				$default_marker =cleanup_ep_URLPATH."/admin/files/css/images/marker-icon.png";
				if(metadata_exists('post', $id, 'cleanup-category')) {
					$items = get_post_meta($id,'cleanup-category',true );
					if(isset($items[0]->slug)){										
						foreach($items as $c){
							$map_marker= get_term_meta($c->term_id, 'cleanup_term_mapmarker', true);
							if($map_marker!=''){
								$default_marker =$map_marker;
								break;
							}							
						}
					}
				}			
				return $default_marker;
			}
			public function cleanup_get_location_caching($id, $post_type){				
				if(metadata_exists('post', $id, 'cleanup-locations')) {
					$items = get_post_meta($id,'cleanup-locations',true );										
					}else{									
					$items=wp_get_object_terms( $id, $post_type.'-locations');
					update_post_meta($id, 'cleanup-locations' , $items);
				}					
				return $items;
			}					
			public function cleanup_get_tags_caching($id, $post_type){				
				if(metadata_exists('post', $id, 'cleanup-tags')) {
					$items = get_post_meta($id,'cleanup-tags',true );										
					}else{										
					$items=wp_get_object_terms( $id, $post_type.'-tag');
					update_post_meta($id, 'cleanup-tags' , $items);
				}					
				return $items;
			}
			public function cleanup_listing_default_image() {
				$cleanup_listing_defaultimage=get_option('cleanup_listing_defaultimage');
				if(!empty($cleanup_listing_defaultimage)){
					$default_image_url= wp_get_attachment_image_src($cleanup_listing_defaultimage,'full');		
					if(isset($default_image_url[0])){									
						$default_image_url=$default_image_url[0] ;
					}
					}else{
					$default_image_url=cleanup_ep_URLPATH."/assets/images/default-directory.jpg";
				}
				return $default_image_url;
			}
		
			
			public function cleanup_update_setting_password(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);		
				if(array_key_exists('wp_capabilities',$form_data)){
					wp_die( 'Are you cheating:wp_capabilities?' );		
				}
				global $current_user;										
				if ( wp_check_password( sanitize_text_field($form_data['c_pass']), $current_user->user_pass, $current_user->ID) ){
					if($form_data['r_pass']!=$form_data['n_pass']){
						echo wp_json_encode(array("code" => "not", "msg"=>"New Password & Re Password are not same. "));
						exit(0);
						}else{
						wp_set_password( sanitize_text_field($form_data['n_pass']), $current_user->ID);
						echo wp_json_encode(array("code" => "success","msg"=>"Updated Successfully"));
						exit(0);
					}
					}else{
					echo wp_json_encode(array("code" => "not", "msg"=>esc_html__( 'Current password is wrong.', 'cleanup')));
					exit(0);
				}
			}
			public function cleanup_update_profile_setting(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);		
				if(array_key_exists('wp_capabilities',$form_data)){
					wp_die( 'Are you cheating:wp_capabilities?' );		
				}
				$cleanup_directory_url=get_option('cleanup_ep_url');
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				$allowed_html = wp_kses_allowed_html( 'post' );
				global $current_user;
				// Location
				$all_locations='';
				if(is_array($form_data['location_arr'])){				
				 $all_locations= implode(",",$form_data['location_arr']);
					if(isset($form_data['new_location']) AND $form_data['new_location']!=''){ 
						$all_locations= $all_locations.','.$form_data['new_location'];
					}
				}				
				update_user_meta($current_user->ID, 'all_locations', sanitize_text_field($all_locations)); 
				update_user_meta($current_user->ID, 'new_locations', sanitize_text_field($form_data['new_location']));  
				
				$field_type=array();
				$field_type_opt=  get_option( 'cleanup_field_type' );
				if($field_type_opt!=''){
					$field_type=get_option('cleanup_field_type' );
				}else{
					$field_type['full_name']='text';					 
					$field_type['tagline']='text';
					$field_type['phone']='text';								
					$field_type['address']='text';
					$field_type['city']='text';
					$field_type['postcode']='text';
					$field_type['state']='text';
					$field_type['country']='text';
					$field_type['website']='url';	
					$field_type['description']='textarea';
				}	
				
				foreach ( $form_data as $field_key => $field_value ) { 
					if(strtolower(trim($field_key))!='wp_capabilities'){						
						if(is_array($field_value)){
							$field_value =implode(",",$field_value);
						}
						
						if($field_type[$field_key]=='url'){							
							update_user_meta($current_user->ID, sanitize_text_field($field_key), sanitize_url($field_value)); 
						}elseif($field_type[$field_key]=='textarea'){
							
							update_user_meta($current_user->ID, sanitize_text_field($field_key), sanitize_textarea_field($field_value));  
						}else{
							update_user_meta($current_user->ID, sanitize_text_field($field_key), sanitize_text_field($field_value)); 
						}
					}
				}
				// top banner
				update_user_meta($current_user->ID, 'topbanner', sanitize_text_field($form_data['topbanner'])); 
							
				
					
				 wp_send_json(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_total_listing_count($userid, $allusers='no' ){
				$cleanup_directory_url=get_option('cleanup_ep_url');
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				if($allusers=='yes' ){
					$args = array(
					'post_type' => $cleanup_directory_url, // enter your custom post type
					'paged' => '1',					
					'post_status' => 'publish',	
					'posts_per_page'=>'99999',  // overrides posts per page in theme settings
					);
					}else{
					$args = array(
					'post_type' => $cleanup_directory_url, // enter your custom post type
					'paged' => '1',
					'author'=>$userid ,
					'post_status' => 'publish',	
					'posts_per_page'=>'99999',  // overrides posts per page in theme settings
					);
				}
				$listing_count = new WP_Query( $args );
				$count = $listing_count->found_posts;
				return $count;
			}
			public function cleanup_total_applications_count($listingid ){ 
				$cleanup_directory_url2='listing_apply';		
				$args_apply ='';
				$args_apply = array(
				'post_type' => $cleanup_directory_url2, 
				'paged' => '1',	
				'post_status'=>'Private',
				'posts_per_page'=>'99999', 
				'meta_query' => array(
				array(
				'key' => 'apply_jod_id',
				'value' => $listingid,
				'compare' => '='
				)
				)					
				);				
				$apply_count = new WP_Query( $args_apply );				
				$count = $apply_count->found_posts;
				return $count;
			}
			public function cleanup_restrict_media_library( $wp_query ) {
				if(!function_exists('wp_get_current_user')) { include(ABSPATH . "wp-includes/pluggable.php"); }
				global $current_user, $pagenow;
				if( is_admin() && !current_user_can('edit_others_posts') ) {
					$wp_query->set( 'author', $current_user->ID );
					add_filter('views_edit-post', 'fix_post_counts');
					add_filter('views_upload', 'fix_media_counts');
				}
			}
			
			public function cleanup_update_profile_pic(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $current_user;
				if(isset($_REQUEST['profile_pic_url_1'])){
					$iv_profile_pic_url=sanitize_url($_REQUEST['profile_pic_url_1']);
					$attachment_thum=sanitize_url($_REQUEST['attachment_thum']);
					}else{
					$iv_profile_pic_url='';
					$attachment_thum='';
				}
				update_user_meta($current_user->ID, 'cleanup_profile_pic_thum', $attachment_thum);					
				update_user_meta($current_user->ID, 'iv_profile_pic_url', $iv_profile_pic_url);
				echo wp_json_encode('success');
				exit(0);
			}
			public function cleanup_paypal_form_submit(  ) {
				require_once(cleanup_ep_DIR . '/admin/pages/payment-inc/paypal-submit.php');
			}	
						
			/***********************************
				* Adds a meta box to the post editing screen
			*/
			public function cleanup_custom_meta_cleanup() {
				$cleanup_directory_url=get_option('cleanup_ep_url');
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				add_meta_box('prfx_meta', esc_html__('Claim Approve ', 'cleanup'), array(&$this, 'cleanup_meta_callback'),$cleanup_directory_url,'side');
				add_meta_box('prfx_meta2', esc_html__('Listing Data  ', 'cleanup'), array(&$this, 'cleanup_meta_callback_full_data'),$cleanup_directory_url,'advanced');
			}
			public function cleanup_check_coupon(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'signup' ) ) {
					echo wp_json_encode(array("msg"=>"Are you cheating:wpnonce?"));						
					exit(0);
				}
				global $wpdb;
				$coupon_code=sanitize_text_field($_REQUEST['coupon_code']);
				$package_id=sanitize_text_field($_REQUEST['package_id']);					
				$package_amount=get_post_meta($package_id, 'cleanup_package_cost',true);
				$api_currency =sanitize_text_field($_REQUEST['api_currency']);
				$cleanup_coupon='cleanup_coupon';
				$post_cont = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_title = %s and  post_type=%s",$coupon_code,$cleanup_coupon ));	
				if(sizeof($post_cont)>0 && $package_amount>0){
					$coupon_name = $post_cont->post_title;
					$current_date=$today = gmdate("m/d/Y");
					$start_date=get_post_meta($post_cont->ID, 'cleanup_coupon_start_date', true);
					$end_date=get_post_meta($post_cont->ID, 'cleanup_coupon_end_date', true);
					$coupon_used=get_post_meta($post_cont->ID, 'cleanup_coupon_used', true);
					$coupon_limit=get_post_meta($post_cont->ID, 'cleanup_coupon_limit', true);
					$dis_amount=get_post_meta($post_cont->ID, 'cleanup_coupon_amount', true);							 
					$package_ids =get_post_meta($post_cont->ID, 'cleanup_coupon_pac_id', true);
					$all_pac_arr= explode(",",$package_ids);
					$today_time = strtotime($current_date);
					$start_time = strtotime($start_date);
					$expire_time = strtotime($end_date);
					if(in_array('0', $all_pac_arr)){
						$pac_found=1;
						}else{
						if(in_array($package_id, $all_pac_arr)){
							$pac_found=1;
							}else{
							$pac_found=0;
						}
					}
					$recurring = get_post_meta( $package_id,'cleanup_package_recurring',true); 
					if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found == '1' && $recurring!='on' ){
						$total = $package_amount -$dis_amount;
						$coupon_type= get_post_meta($post_cont->ID, 'cleanup_coupon_type', true);
						if($coupon_type=='percentage'){
							$dis_amount= $dis_amount * $package_amount/100;
							$total = $package_amount -$dis_amount ;
						}
						echo wp_json_encode(array('code' => 'success',
						'dis_amount' => $dis_amount.' '.$api_currency,
						'gtotal' => $total.' '.$api_currency,
						'p_amount' => $package_amount.' '.$api_currency,
						));
						exit(0);
						}else{
						$dis_amount='';
						$total=$package_amount;
						echo wp_json_encode(array('code' => 'not-success-2',
						'dis_amount' => '',
						'gtotal' => $total.' '.$api_currency,
						'p_amount' => $package_amount.' '.$api_currency,
						));
						exit(0);
					}
					}else{
					if($package_amount=="" or $package_amount=="0"){$package_amount='0';}
					$dis_amount='';
					$total=$package_amount;
					echo wp_json_encode(array('code' => 'not-success-1',
					'dis_amount' => '',
					'gtotal' => $total.' '.$api_currency,
					'p_amount' => $package_amount.' '.$api_currency,
					));
					exit(0);
				}
			}
			public function cleanup_check_package_amount(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'signup' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				global $wpdb;
				$coupon_code=(isset($_REQUEST['coupon_code'])? sanitize_text_field($_REQUEST['coupon_code']):'');
				$package_id=sanitize_text_field($_REQUEST['package_id']);
				if( get_post_meta( $package_id,'cleanup_package_recurring',true) =='on'  ){
					$package_amount=get_post_meta($package_id, 'cleanup_package_recurring_cost_initial', true);			
					}else{					
					$package_amount=get_post_meta($package_id, 'cleanup_package_cost',true);
				}
				$api_currency =sanitize_text_field($_REQUEST['api_currency']);			
				$iv_gateway = get_option('cleanup_payment_gateway');
				if($iv_gateway=='woocommerce'){
					if ( class_exists( 'WooCommerce' ) ) {	
						$api_currency= get_option( 'woocommerce_currency' );
						$api_currency= get_woocommerce_currency_symbol( $api_currency );
					}
				}	
				$cleanup_coupon='cleanup_coupon';
				$post_cont = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_title = %s and  post_type=%s", $coupon_code,$cleanup_coupon));	
				if(isset($post_cont->ID)){
					$coupon_name = $post_cont->post_title;
					$current_date=$today = gmdate("m/d/Y");
					$start_date=get_post_meta($post_cont->ID, 'cleanup_coupon_start_date', true);
					$end_date=get_post_meta($post_cont->ID, 'cleanup_coupon_end_date', true);
					$coupon_used=get_post_meta($post_cont->ID, 'cleanup_coupon_used', true);
					$coupon_limit=get_post_meta($post_cont->ID, 'cleanup_coupon_limit', true);
					$dis_amount=get_post_meta($post_cont->ID, 'cleanup_coupon_amount', true);							 
					$package_ids =get_post_meta($post_cont->ID, 'cleanup_coupon_pac_id', true);
					$all_pac_arr= explode(",",$package_ids);
					$today_time = strtotime($current_date);
					$start_time = strtotime($start_date);
					$expire_time = strtotime($end_date);
					$pac_found= in_array($package_id, $all_pac_arr);							
					if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found=="1"){
						$total = $package_amount -$dis_amount;
						echo wp_json_encode(array('code' => 'success',
						'dis_amount' => $api_currency.' '.$dis_amount,
						'gtotal' => $api_currency.' '.$total,
						'p_amount' => $api_currency.' '.$package_amount,
						));
						exit(0);
						}else{
						$dis_amount='--';
						$total=$package_amount;
						echo wp_json_encode(array('code' => 'not-success',
						'dis_amount' => $api_currency.' '.$dis_amount,
						'gtotal' => $api_currency.' '.$total,
						'p_amount' => $api_currency.' '.$package_amount,
						));
						exit(0);
					}
					}else{
					$dis_amount='--';
					$total=$package_amount;
					echo wp_json_encode(array('code' => 'not-success',
					'dis_amount' => $api_currency.' '.$dis_amount,
					'gtotal' => $api_currency.' '.$total,
					'p_amount' => $api_currency.' '.$package_amount,
					));
					exit(0);
				}
			}
			/**
				* Outputs the content of the meta box
			*/
			public function cleanup_meta_callback($post) {
				wp_nonce_field(basename(__FILE__), 'prfx_nonce');
				require_once ('admin/pages/metabox.php');
			}
			public function cleanup_meta_callback_full_data(){
				require_once ('admin/pages/metabox_full_data.php');
			}
			public function cleanup_color_js(){
				$big_button_color=get_option('cleanup_big_button_color');	
				if($big_button_color==""){$big_button_color='#2e7ff5';}	
				$small_button_color=get_option('cleanup_small_button_color');	
				if($small_button_color==""){$small_button_color='#5f9df7';}
				$icon_color=get_option('cleanup_icon_color');	
				if($icon_color==""){$icon_color='#5b5b5b';}	
				$title_color=get_option('cleanup_title_color');	
				if($title_color==""){$title_color='#5b5b5b';}
				$button_font_color=get_option('cleanup_button_font_color');	
				if($button_font_color==""){$button_font_color='#ffffff';}
				$button_small_font_color=get_option('cleanup_button_small_font_color');	
				if($button_small_font_color==""){$button_small_font_color='#ffffff';}
				$content_font_color=get_option('cleanup_content_font_color');	
				if($content_font_color==""){$content_font_color='#66789C';}	
				$border_color=get_option('cleanup_border_color');	
				if($border_color==""){$border_color='#E0E6F7';}	
				wp_enqueue_script('cleanup-dynamic-color', cleanup_ep_URLPATH . 'admin/files/js/dynamic-color.js');
				wp_localize_script('cleanup-dynamic-color', 'cleanup_color', array(
				'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
				'big_button'=>$big_button_color,
				'small_button'=>$small_button_color,
				'button_font'=>$button_font_color,
				'button_small_font'=>$button_small_font_color,
				'title_color'=>$title_color,
				'content_font_color'=>$content_font_color,
				'icon_color'=>$icon_color,
				'max_border_color'=>$border_color,	
				) );	
			}
			public function cleanup_all_functions(){
				include_once('functions/listing-functions.php');
				include_once('functions/open-status-checker.php');				
				include_once('admin/pages/metaboxes/location-meta.php');
				include_once('admin/pages/metaboxes/category-meta.php');
			}
			public function cleanup_meta_save($post_id) {
				global $wpdb;
				$newpost_id=$post_id;
				$is_autosave = wp_is_post_autosave($post_id);
				if (isset($_REQUEST['cleanup_approve'])) {
					if($_REQUEST['cleanup_approve']=='yes'){ 
						update_post_meta($post_id, 'cleanup_approve', sanitize_text_field($_REQUEST['cleanup_approve']));
						// Set new user for post							
						$cleanup_author_id= sanitize_text_field($_REQUEST['cleanup_author_id']);
						$wpdb->query($wpdb->prepare("UPDATE  $wpdb->posts SET post_author=%d  WHERE ID=%d",$cleanup_author_id,$post_id ));	
									
					}
				} 
				if (isset($_REQUEST['cleanup_featured'])) {							
					update_post_meta($post_id, 'cleanup_featured', sanitize_text_field($_REQUEST['cleanup_featured']));
				}
				
				$opening_day=array();
				if(isset($_REQUEST['day_name'] )){
					$day_name= $_REQUEST['day_name'] ;
					$day_value1 = $_REQUEST['day_value1'];
					$day_value2 = $_REQUEST['day_value2'] ;
					$i=0;
					foreach($day_name  as $one_meta){
						if(isset($day_name[$i]) and isset($day_value1[$i]) ){
							if($day_name[$i] !=''){
								$opening_day[sanitize_text_field($day_name[$i])]= array(sanitize_text_field($day_value1[$i])=>sanitize_text_field($day_value2[$i])) ;
							}
						}
						$i++;
					}
					update_post_meta($newpost_id, '_opening_time', $opening_day);
				}
				
				if (isset($_REQUEST['listing_data_submit'])) {
					$newpost_id=$post_id;
					// For FAQ Save
					// Delete 1st
					$i=0;
					for($i=0;$i<20;$i++){
						delete_post_meta($newpost_id, 'faq_title'.$i);							
						delete_post_meta($newpost_id, 'faq_description'.$i);
					}
					// Delete End
					if(isset($_REQUEST['faq_title'] )){
						$faq_title= $_REQUEST['faq_title']; //this is array data we sanitize later, when it save				
						$faq_description= $_REQUEST['faq_description'];
						$i=0;
						for($i=0;$i<20;$i++){
							if(isset($faq_title[$i]) AND $faq_title[$i]!=''){
								update_post_meta($newpost_id, 'faq_title'.$i, sanitize_text_field($faq_title[$i]));
								update_post_meta($newpost_id, 'faq_description'.$i, sanitize_textarea_field($faq_description[$i]));
							}
						}
					}
					// End FAQ
					
					$default_fields = array();
					$field_set=get_option('cleanup_li_fields' );
					if($field_set!=""){ 
						$default_fields=get_option('cleanup_li_fields' );
						}else{
						$default_fields['cleaning_hours']='Cleaning Hours';
						$default_fields['number_of_cleaner']='Number Of Cleaner';	
					}					
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							update_post_meta($newpost_id, $field_key, $_REQUEST[$field_key] );							
						}					
					}
					
					update_post_meta($newpost_id, 'address', sanitize_text_field($_REQUEST['address'])); 
					update_post_meta($newpost_id, 'latitude', sanitize_text_field($_REQUEST['latitude'])); 
					update_post_meta($newpost_id, 'longitude', sanitize_text_field($_REQUEST['longitude']));					
					update_post_meta($newpost_id, 'city', sanitize_text_field($_REQUEST['city'])); 
					update_post_meta($newpost_id, 'state', sanitize_text_field($_REQUEST['state'])); 
					update_post_meta($newpost_id, 'postcode', sanitize_text_field($_REQUEST['postcode'])); 
					update_post_meta($newpost_id, 'country', sanitize_text_field($_REQUEST['country'])); 
					update_post_meta($newpost_id, 'local-area', sanitize_text_field($_REQUEST['local-area'])); 
					// Get latlng from address* START********
					// Get latlng from address* ENDDDDDD********	
					// listing detail*****
					
					if(isset($_REQUEST['dirpro_email_button'])){						
						update_post_meta($newpost_id, 'dirpro_email_button', sanitize_text_field($_REQUEST['dirpro_email_button'])); 
					}
					if(isset($_REQUEST['dirpro_web_button'])){						
						update_post_meta($newpost_id, 'dirpro_web_button', sanitize_text_field($_REQUEST['dirpro_web_button'])); 
					}
					update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($_REQUEST['gallery_image_ids'])); 
					update_post_meta($newpost_id, 'attached_ids', sanitize_text_field($_REQUEST['attached_ids']));
					update_post_meta($newpost_id, 'topbanner', sanitize_text_field($_REQUEST['topbanner_image_id'])); 
					if(isset($_REQUEST['feature_image_id'] )){
						$attach_id =sanitize_text_field($_REQUEST['feature_image_id']);
						set_post_thumbnail( $newpost_id, $attach_id );					
					}
					update_post_meta($newpost_id, 'price', sanitize_text_field($_REQUEST['price']));
					update_post_meta($newpost_id, 'discount', sanitize_text_field($_REQUEST['discount']));
					update_post_meta($newpost_id, 'whatsapp', sanitize_text_field($_REQUEST['whatsapp']));
					update_post_meta($newpost_id, 'viber', sanitize_text_field($_REQUEST['viber']));
					 
					update_post_meta($newpost_id, 'listing_contact_source', sanitize_text_field($_REQUEST['contact_source']));  
					update_post_meta($newpost_id, 'company_name', sanitize_text_field($_REQUEST['company_name']));
					update_post_meta($newpost_id, 'phone', sanitize_text_field($_REQUEST['phone'])); 
					update_post_meta($newpost_id, 'address', sanitize_text_field($_REQUEST['address'])); 
					update_post_meta($newpost_id, 'contact-email', sanitize_text_field($_REQUEST['contact-email'])); 
					update_post_meta($newpost_id, 'contact_web', sanitize_url($_REQUEST['contact_web']));
					update_post_meta($newpost_id, 'vimeo', sanitize_text_field($_REQUEST['vimeo'])); 
					update_post_meta($newpost_id, 'youtube', sanitize_text_field($_REQUEST['youtube'])); 
					delete_post_meta($newpost_id, 'cleanup-tags');
					delete_post_meta($newpost_id, 'cleanup-category');
					delete_post_meta($newpost_id, 'cleanup-locations');
				}
			}
			/**
				* Checks that the WordPress setup meets the plugin requirements
				* @global string $wp_version
				* @return boolean
			*/
			private function check_requirements() {
				global $wp_version;
				if (!version_compare($wp_version, $this->wp_version, '>=')) {
					add_action('admin_notices', 'cleanup_eplugins::display_req_notice');
					return false;
				}
				return true;
			}
			/**
				* Display the requirement notice
				* @static
			*/
			static function display_req_notice() {
				global $cleanup_eplugins;
				echo '<div id="message" class="error"><p><strong>';
				echo esc_html__('Sorry, BootstrapPress re requires WordPress higher. Please upgrade your WordPress setup', 'cleanup');
				echo '</strong></p></div>';
			}
			private function load_dependencies() {
				// Admin Panel
				if (is_admin()) {
					require_once ('admin/admin.php');					
				}
				// Front-End Site
				if (!is_admin()) {
				}
				require_once('functions/listing-functions.php');
				// Global
			}
			/**
				* Called every time the plug-in is activated.
			*/
			public function activate() {				
				require_once ('install/install.php');
			}
			/**
				* Called when the plug-in is deactivated.
			*/
			public function deactivate() {
					global $wpdb;	
				if ( !is_plugin_active('cleanup/plugin.php') ) {	
					$page_name='price-table';	
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}			
					$page_name='registration';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='my-account';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='agent-public';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='login';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
							
					$page_name='author-directory';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='author-profile';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='all-listings';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='all-listings-no-map';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='all-locations';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='all-categories';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
					$page_name='search-form';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}			
					$page_name='add-listing';						
					$page = get_page_by_title($page_name);
					if ($page) {
						wp_delete_post($page->ID, true); 
					}
				}
			}
			/**
				* Called when the plug-in is uninstalled
			*/
			static function uninstall() {
			}
			/**
				* Register the widgets
			*/
			public function register_widget() {
			}
			/**
				* Internationalization
			*/
			public function i18n() {
				load_plugin_textdomain('cleanup', false, basename(dirname(__FILE__)) . '/languages/' );
			}
			/**
				* Starts the plug-in main functionality
			*/
			
			public function cleanup_price_table_func($atts = '', $content = '') {									
				ob_start();					  //include the specified file
				include( cleanup_ep_template. 'price-table/price-table-1.php');
				$content = ob_get_clean();	
				return $content;
			}
			public function cleanup_form_wizard_func($atts = '') {
				global $current_user;
				$template_path=cleanup_ep_template.'signup/';
				ob_start();	 //include the specified file
				if($current_user->ID==0){
					$signup_access= get_option('users_can_register');	
					if($signup_access=='0'){
						esc_html_e( 'Sorry! You are not allowed for signup.', 'cleanup' );
						}else{
						include( $template_path. 'wizard-style-2.php');
					}						
					}else{						  
					include( cleanup_ep_template. 'private-profile/profile-template-1.php');
				}
				$content = ob_get_clean();	
				return $content;
			}
			public function cleanup_profile_template_func($atts = '') {
				global $current_user;
				ob_start();
				if($current_user->ID==0){
					require_once(cleanup_ep_template. 'private-profile/profile-login.php');
					}else{					  
					include( cleanup_ep_template. 'private-profile/profile-template-1.php');
				}
				$content = ob_get_clean();	
				return $content;
			}
			public function cleanup_reminder_email_cron_func ($atts = ''){
				include( cleanup_ep_ABSPATH. 'inc/reminder-email-cron.php');
			}
			public function cleanup_cron_listing(){
				include( cleanup_ep_ABSPATH. 'inc/all_cron_listing.php');
				exit(0);
			}
			public function cleanup_categories_func($atts = ''){
				ob_start();				
				include( cleanup_ep_template. 'listing/listing_categories.php');
				$content = ob_get_clean();
				return $content;	
			}
			public function cleanup_add_listing_func(){
				ob_start();	
				include( cleanup_ep_template. 'private-profile/add-listing-without-user.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_locations_func($atts = ''){
				ob_start();	
				include( cleanup_ep_template. 'listing/listing-locations.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_search_popup_func($atts = ''){
				ob_start();	
				include( cleanup_ep_template. 'listing/listing_search_popup.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_listing_claim_popup(){
				include( cleanup_ep_template. 'listing/single-template/claim.php');
				exit(0);
			}
			public function cleanup_search_func($atts = ''){
				ob_start();	
				include( cleanup_ep_template. 'listing/listing_search.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_categories_carousel_func($atts = ''){
				ob_start();	
				include( cleanup_ep_template. 'listing/carousel/categories-carousel.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_tags_carousel_func($atts = ''){
				ob_start();	
				include( cleanup_ep_template. 'listing/carousel/tags-carousel.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_locations_carousel_func($atts = ''){
				ob_start();	
				include( cleanup_ep_template. 'listing/carousel/locations-carousel.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_map_func($atts = ''){
				ob_start();	
				include( cleanup_ep_template. 'listing/archive-map.php');
				$content = ob_get_clean();
				return $content;
			}				
			public function cleanup_featured_func($atts = ''){
				ob_start();	
				if(isset($atts['style']) and $atts['style']!="" ){
					$tempale=$atts['style']; 
					}else{
					$tempale=get_option('cleanup_featured'); 
				}
				if($tempale==''){
					$tempale='style-1';
				}						
				//include the specified file
				if($tempale=='style-1'){
					include( cleanup_ep_template. 'listing/listing_featured.php');
				}
				$content = ob_get_clean();
				return $content;	
			}	
			public function cleanup_archive_grid_top_map_func($atts=''){
				ob_start();	
				include( cleanup_ep_template. 'listing/archive-grid-top-map.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_archive_grid_func($atts=''){
				ob_start();	
				include( cleanup_ep_template. 'listing/archive-grid.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_archive_grid_no_map_func($atts=''){
				ob_start();	
				include( cleanup_ep_template. 'listing/archive-grid-no-map.php');
				$content = ob_get_clean();
				return $content;
			}
			public function cleanup_cleanup_listing_filter_func($atts=''){
				ob_start();	
				include( cleanup_ep_template. 'listing/listing-filter.php');
				$content = ob_get_clean();
				return $content;				
			}
			public function cleanup_author_directory_func($atts = ''){
				global $current_user;	
				ob_start(); //include the specified file					
				include( cleanup_ep_template. 'user-directory/author-directory.php');
				$content = ob_get_clean();
				return $content;	
			}
			
			public function get_unique_location_values($post_type, $key = 'keyword'  ){
				global $wpdb;
				$post_type=get_option('cleanup_ep_url');
				if($post_type==""){$post_type='cleaning-service';}
				$all_data=array();
				// Area**
				$dir_facet_title=get_option('dir_facet_area_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('Area','cleanup');}
				$res=array();				
				$key = 'area';
				$res = $wpdb->get_col( $wpdb->prepare( "
				SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
				LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				WHERE p.post_type=%s AND  pm.meta_key = %s						
				",$post_type, $key) );	
				foreach($res as $row1){							
					$row_data=array();
					if(!empty($row1)){
						$row_data['label']=$row1;
						$row_data['value']=$row1;
						$row_data['category']= $dir_facet_title;
						array_push( $all_data, $row_data );
					}
				}
				// City ***
				$dir_facet_title=get_option('dir_facet_location_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('City','cleanup');}
				$res=array();
				$key = 'city';
				$res = $wpdb->get_col( $wpdb->prepare( "
				SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id WHERE p.post_type=%s AND  pm.meta_key = %s",$post_type, $key) );
				foreach($res as $row1){							
					$row_data=array();
					if(!empty($row1)){
						$row_data['label']=$row1;
						$row_data['value']=$row1;
						$row_data['category']= $dir_facet_title;
						array_push( $all_data, $row_data );
					}	
				}
				// Zipcode ***
				$dir_facet_title=get_option('dir_facet_zipcode_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('Zipcode','cleanup');}
				$res=array();
				$key = 'postcode';				
				$res = $wpdb->get_col( $wpdb->prepare( "SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id WHERE p.post_type=%s AND  pm.meta_key = %s", $post_type,$key) );			
				foreach($res as $row1){							
					$row_data=array();
					if(!empty($row1)){
						$row_data['label']=$row1;
						$row_data['value']=$row1;
						$row_data['category']= $dir_facet_title;
						array_push( $all_data, $row_data );
					}	
				}
				$all_data_json= wp_json_encode($all_data);		
				return $all_data_json;
			}
			public function get_unique_search_values(){						
				global $wpdb;
				$post_type=get_option('cleanup_ep_url');
				if($post_type==""){$post_type='cleaning-service';}
				$res=array();
				$all_data=array();						
				$partners = array();
				$partners_obj =  get_terms(  array('hide_empty' => true,'taxonomy'   => $post_type.'-category') );
				$dir_facet_title=get_option('dir_facet_cat_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('Categories','cleanup');}
				foreach ($partners_obj as $partner) {
					$row_data=array();
					$row_data['label']=$partner->name.'['.$partner->count.']';
					$row_data['value']=$partner->name;
					$row_data['category']= $dir_facet_title;
					array_push( $all_data, $row_data );
				}
				// For tags
				$dir_facet_title=get_option('dir_facet_features_title');
				if($dir_facet_title==""){$dir_facet_title= esc_html__('Features','cleanup');}
				$dir_tags=get_option('cleanup_tags');	
				if($dir_tags==""){$dir_tags='yes';}	
				if($dir_tags=="yes"){
					$partners = array();
					$partners_obj =  get_terms( array('hide_empty' => true,'taxonomy'   => $post_type.'-tag') );
					foreach ($partners_obj as $partner) {
						$row_data=array();
						$row_data['label']=$partner->name.'['.$partner->count.']';
						$row_data['value']=$partner->name;
						$row_data['category']=$dir_facet_title;
						array_push( $all_data, $row_data );
					}
					}else{
					$args =array();
					$args['hide_empty']=true;
					$tags = get_tags($args );
					foreach ( $tags as $tag ) { 
						$row_data=array();
						$row_data['label']=$tag->name.'['.$tag->count.']';
						$row_data['value']=$tag->name;
						$row_data['category']=$dir_facet_title;
						array_push( $all_data, $row_data );
					}							
				}
				// End Tags	****					
				$args3 = array(
				'post_type' => $post_type, // enter your custom post type						
				'post_status' => 'publish',						
				'posts_per_page'=> -1,  // overrides posts per page in theme settings
				'orderby' => 'title',
				'order' => 'ASC',
				);
				$all_data_json=array();
				$query_auto = new WP_Query( $args3 );
				$posts_auto = $query_auto->posts;						
				foreach($posts_auto as $post_a) {
					$row_data=array();  
					$row_data['label']=$post_a->post_title;
					$row_data['value']=$post_a->post_title;
					$row_data['category']= esc_html__('Title','cleanup');
					array_push( $all_data, $row_data );
				}						
				$all_data_json= wp_json_encode($all_data);	
				return $all_data_json;
			}
			
			public function cleanup_profile_public_func($atts = '') {	
				ob_start();						  //include the specified file
				include( cleanup_ep_template. 'profile-public/profile.php');							
				$content = ob_get_clean();	
				return $content;
			}
			public function cleanup_create_taxonomy_locations(){
				$cleanup_directory_url=get_option('cleanup_ep_url');
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				$cleanup_directory_url_name=ucfirst('Locations');
				$labels = array(			
				'all_items'           => esc_html__( 'All Location', 'cleanup' ).$cleanup_directory_url_name,
				'add_new_item'        => esc_html__( 'Add New Location', 'cleanup' ),
				'add_new'             => esc_html__( 'Add Location', 'cleanup' ),
				'new_item'            => esc_html__( 'New Location', 'cleanup' ),
				'edit_item'           => esc_html__( 'Edit Location', 'cleanup' ),
				'update_item'         => esc_html__( 'Update Location', 'cleanup' ),
				'view_item'           => esc_html__( 'View Location', 'cleanup' ),
				'search_items'        => esc_html__( 'Search Location', 'cleanup' ),
				'not_found'           => esc_html__( 'Not found', 'cleanup' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'cleanup' ),
				);
				register_taxonomy(
				$cleanup_directory_url.'-locations',
				$cleanup_directory_url,
				array(
				'label' => esc_html__( 'Locations', 'cleanup'),					
				'description'         => esc_html__('Locations' , 'cleanup' ),
				'labels'              => $labels,
				'rewrite' => array( 'slug' => $cleanup_directory_url.'-locations' ),
				'description'         => esc_html__( 'Location', 'cleanup' ),
				'hierarchical' => true,
				'show_in_rest' =>	true,
				)
				);		
			}
			public function cleanup_create_taxonomy_tags(){
				$cleanup_directory_url=get_option('cleanup_ep_url');
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				$cleanup_directory_url_name=ucfirst('Tags');
				$labels = array(			
				'all_items'           => esc_html__( 'All Tags', 'cleanup' ).$cleanup_directory_url_name,
				'add_new_item'        => esc_html__( 'Add New Tags', 'cleanup' ),
				'add_new'             => esc_html__( 'Add Tags', 'cleanup' ),
				'new_item'            => esc_html__( 'New Tags', 'cleanup' ),
				'edit_item'           => esc_html__( 'Edit Tags', 'cleanup' ),
				'update_item'         => esc_html__( 'Update Tags', 'cleanup' ),
				'view_item'           => esc_html__( 'View Tags', 'cleanup' ),
				'search_items'        => esc_html__( 'Search Tags', 'cleanup' ),
				'not_found'           => esc_html__( 'Not found', 'cleanup' ),
				'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'cleanup' ),
				);
				register_taxonomy(
				$cleanup_directory_url.'-tag',
				$cleanup_directory_url,
				array(
				'label' => esc_html__( 'Tags', 'cleanup'),					
				'description'         => esc_html__('Tags' , 'cleanup' ),
				'labels'              => $labels,
				'rewrite' => array( 'slug' => $cleanup_directory_url.'-tag' ),					
				'hierarchical' => true,
				'show_in_rest' =>	true,
				)
				);						
			}		
			public function cleanup_save_favorite(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'_favorites',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites.', '.get_current_user_id();
				update_post_meta($dir_id,'_favorites',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2.', '.$dir_id;
				update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
				echo wp_json_encode(array("msg" => 'success'));
				exit(0);	
			}
			
			public function cleanup_save_un_favorite(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'_favorites',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'_favorites',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
				echo wp_json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function cleanup_save_notification(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);	
				get_current_user_id();
				$notification_value=array();
				$notification= $form_data['notificationone']; //this is array data we sanitize later, when it save
				foreach($notification as $notification_one){
					if( $notification_one!=''){							
						$notification_value[]= sanitize_text_field($notification_one);
					}
				}	
				update_user_meta(get_current_user_id(),'listing_notifications',$notification_value);
				echo wp_json_encode(array("code" => "success","msg"=>"Updated Successfully"));
				exit(0);	
			}
			
			
			public function cleanup_profile_bookmark(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'cleanup_profilebookmark',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites.', '.get_current_user_id();
				update_post_meta($dir_id,'cleanup_profilebookmark',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'cleanup_profilebookmark', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2.', '.$dir_id;
				update_user_meta(get_current_user_id(),'cleanup_profilebookmark',$new_favorites2);
				echo wp_json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function cleanup_profile_bookmark_delete(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'cleanup_profilebookmark',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'cleanup_profilebookmark',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'cleanup_profilebookmark', true);						
				$old_favorites2 = str_replace($dir_id ,'',  $old_favorites2);
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'cleanup_profilebookmark',$new_favorites2);
				echo wp_json_encode(array("msg" => 'success'));
				exit(0);		
			}
			public function cleanup_author_bookmark(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'cleanup_authorbookmark',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites.', '.get_current_user_id();
				update_post_meta($dir_id,'cleanup_authorbookmark',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'cleanup_authorbookmark', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
				$new_favorites2=$old_favorites2.', '.$dir_id;
				update_user_meta(get_current_user_id(),'cleanup_authorbookmark',$new_favorites2);
				echo wp_json_encode(array("msg" => 'success'));
				exit(0);	
			}
			public function cleanup_booking_delete(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);
				global $current_user;
				$message_id=sanitize_text_field($form_data['id']);
				$user_to=get_post_meta($message_id,'user_to',true);	
				if($user_to==$current_user->ID){				
					wp_delete_post($message_id);					
					echo wp_json_encode(array("msg" => 'success'));
					}else{
					echo wp_json_encode(array("msg" => 'Not success'));
				}
				exit(0);
			
			}
			public function cleanup_message_delete(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);
				global $current_user;
				$message_id=sanitize_text_field($form_data['id']);
				$user_to=get_post_meta($message_id,'user_to',true);	
				if($user_to==$current_user->ID){				
					wp_delete_post($message_id);
					delete_post_meta($message_id,true);	
					echo wp_json_encode(array("msg" => 'success'));
					}else{
					echo wp_json_encode(array("msg" => 'Not success'));
				}
				exit(0);		
			}
			public function cleanup_load_categories_fields_wpadmin(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'addlisting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				$main_class = new cleanup_eplugins;
				$fields_data='';
				$categories_arr=array();
				$term_id = $_POST['term_id'];
				$post_id= sanitize_text_field($_POST['post_id']);
				$datatype= sanitize_text_field($_POST['datatype']); 
				if (!empty($term_id)) {
					if($datatype!='slug'){
						foreach ($term_id as $tid) {
							$tid=sanitize_text_field($tid);
							$category = get_term_by('name', $tid, $cleanup_directory_url.'-category');
							$categories_arr[] = $category->slug;
						}
						}else{
						foreach ($term_id as $tid) {
							$tid=sanitize_text_field($tid);
							$categories_arr[] = $tid;
						}
					}
					$fields_data=$main_class->cleanup_listing_fields($post_id, $categories_arr );
				}
				echo wp_json_encode(array("msg" => 'success',"field_data"=>$fields_data));
				exit(0);
			}
			public function cleanup_listing_fields($listid, $categories_arr){ 
				$listid=$listid;
				$default_fields = array();			
				$cleanup_fields=  		get_option( 'cleanup_li_fields' );
				$field_type=  get_option( 'cleanup_li_field_type' );
				$field_type_value=  get_option( 'cleanup_li_fieldtype_value' );													
				$cleanup_field_type_cat=  get_option( 'cleanup_field_type_cat' );
				if($cleanup_fields==""){ 
					$default_fields['cleaning_hours']='Cleaning Hours';
					$default_fields['number_of_cleaner']='Number Of Cleaner';
					}else{
					$default_fields=$cleanup_fields;				
				}
				$return_value='';
				foreach ( $default_fields as $field_key_pass => $field_value ) { 					
					$intersection='';				
					$field_cat_arr= (isset($cleanup_field_type_cat[$field_key_pass])?$cleanup_field_type_cat[$field_key_pass] : '' );					
					if(is_array($field_cat_arr) AND is_array($categories_arr) ){
						$intersection = array_intersect($categories_arr, $cleanup_field_type_cat[$field_key_pass]);
					}
					if(!empty($intersection)){ 
						$return_value=$return_value.'<div class="col-md-12">';
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='dropdown'){	 								
							$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
							$return_value=$return_value.'<div class="form-group row">
							<label class="control-label col-md-4">'. esc_html($field_value).'</label>
							<div class="col-md-8"><select name="'. esc_html($field_key_pass).'" id="'.esc_attr($field_key_pass).'" class="form-control "  >';				
							foreach($dropdown_value as $one_value){	 
								if(trim($one_value)!=''){
									$return_value=$return_value.'<option '.(trim(get_post_meta($listid,$field_key_pass,true))==trim($one_value)?' selected':'').' value="'. esc_attr($one_value).'">'. esc_html($one_value).'</option>';
								}
							}	
							$return_value=$return_value.'</select></div></div>';					
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='checkbox'){								
							$dropdown_value= explode(',',$field_type_value[$field_key_pass]);						
							$return_value=$return_value.'<div class="form-group row">
							<label class="control-label col-md-4">'. esc_html($field_value).'</label>
							<div class="col-md-8">
							<div class="" >
							';
							$saved_checkbox_value=get_post_meta($listid,$field_key_pass,true);							
							if(!is_array($saved_checkbox_value)){
								if($saved_checkbox_value!=''){								
									$saved_checkbox_value =	explode(',',get_post_meta($listid,$field_key_pass,true));
								}
							}
							if(empty($saved_checkbox_value)){$saved_checkbox_value=array();}
							foreach($dropdown_value as $one_value){
								if(trim($one_value)!=''){
									$return_value=$return_value.'
									<div class="form-check form-check-inline col-md-12 margin-top10">
									<label class="form-check-label" for="'. esc_attr($one_value).'">
									<input '.( in_array($one_value,$saved_checkbox_value)?' checked':'').' class=" form-check-input" type="checkbox" name="'. esc_attr($field_key_pass).'[]"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'">
									'. esc_attr($one_value).' </label>
									</div>';
								}
							}	
							$return_value=$return_value.'</div></div></div>';						
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='radio'){	 								
							$dropdown_value= explode(',',$field_type_value[$field_key_pass]);
							$return_value=$return_value.'<div class="form-group row ">
							<label class="control-label col-md-4">'. esc_html($field_value).'</label>
							<div class="col-md-8">
							<div class="" >
							';						
							foreach($dropdown_value as $one_value){	 
								if(trim($one_value)!=''){
									$return_value=$return_value.'
									<div class="form-check form-check-inline col-md-12 margin-top10">
									<label class="form-check-label " for="'. esc_attr($one_value).'">
									<input '.(get_post_meta($listid,$field_key_pass,true)==$one_value?' checked':'').' class="form-check-input" type="radio" name="'. esc_attr($field_key_pass).'"  id="'. esc_attr($one_value).'" value="'. esc_attr($one_value).'">
									'. esc_attr($one_value).'</label>
									</div>														
									';
								}
							}	
							$return_value=$return_value.'</div></div></div>';					
						}					 
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='textarea'){	
							$return_value=$return_value.'<div class="form-group row">';
							$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
							$return_value=$return_value.'<div class="col-md-8"><textarea  placeholder="'.esc_html__('Enter ','ivdirectories').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="col-md-12"  rows="4"/>'.esc_attr(get_post_meta($listid,$field_key_pass,true)).'</textarea></div></div>';
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='datepicker'){	 
							$return_value=$return_value.'<div class="form-group row">';
							$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
							$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Select ','ivdirectories').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control epinputdate " value="'.esc_attr(get_post_meta($listid,$field_key_pass,true)).'"/></div></div>';
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='text'){	 
							$return_value=$return_value.'<div class="form-group row">';
							$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
							$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Enter ','ivdirectories').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control " value="'.esc_attr(get_post_meta($listid,$field_key_pass,true)).'"/></div></div>';
						}
						if(isset($field_type[$field_key_pass]) && $field_type[$field_key_pass]=='url'){	 
							$return_value=$return_value.'<div class="form-group row">';
							$return_value=$return_value.'<label class="control-label col-md-4">'. esc_html($field_value).'</label>';
							$return_value=$return_value.'<div class="col-md-8"><input type="text" placeholder="'.esc_html__('Enter ','ivdirectories').esc_attr($field_value).'" name="'.esc_html($field_key_pass).'" id="'. esc_attr($field_key_pass).'"  class="form-control " value="'.esc_url(get_post_meta($listid,$field_key_pass,true)).'"/></div></div>';
						}
						$return_value=$return_value.'</div>';
					}
				} // For main  fields loop 
				return $return_value;
			}
			public function cleanup_author_bookmark_delete(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);
				$old_favorites= get_post_meta($dir_id,'cleanup_authorbookmark',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'cleanup_authorbookmark',$new_favorites);
				$old_favorites2=get_user_meta(get_current_user_id(),'cleanup_authorbookmark', true);						
				$old_favorites2 = str_replace($dir_id ,'',  $old_favorites2);
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'cleanup_authorbookmark',$new_favorites2);
				echo wp_json_encode(array("msg" => 'success'));
				exit(0);		
			}
			
			public function cleanup_delete_favorite(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'myaccount' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['data'], $form_data);					
				$dir_id=sanitize_text_field($form_data['id']);						
				$old_favorites= get_post_meta($dir_id,'_favorites',true);
				$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
				$new_favorites=$old_favorites;
				update_post_meta($dir_id,'_favorites',$new_favorites);						
				$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
				$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);						
				$new_favorites2=$old_favorites2;
				update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
				echo wp_json_encode(array("msg" => 'success'));
				exit(0);
			}
			public function cleanup_booking_message_send(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);					
				// Create new message post
				$allowed_html = wp_kses_allowed_html( 'post' );					
				if(isset($form_data['dir_id'])){
					if($form_data['dir_id']>0){
						$dir_id=sanitize_text_field($form_data['dir_id']);
						$dir_detail= get_post($dir_id); 
						$dir_title= get_permalink($dir_id);
						$dir_name=$dir_detail->post_title;
						$user_id=$dir_detail->post_author;
						$user_info = get_userdata( $user_id);
						$client_email_address =$user_info->user_email;
						$userid_to=$user_id;
					}
				}
				
				$new_nessage= esc_html__( 'Booking Message', 'cleanup' );
				$my_post=array();
				$subject= $form_data['booking_name'].' | '.	$form_data['booking_email_address'].' | Phone: '.$form_data['booking_phone'].' | Date: '.$form_data['booking_datetime'];		
				$my_post['post_title'] =$subject;
				$my_post['post_content'] = wp_kses( $form_data['booking_message_content'], $allowed_html); 
				$my_post['post_type'] = 'cleanup_booking';
				$my_post['post_status']='private';												
				$newpost_id= wp_insert_post( $my_post );
				Update_post_meta($newpost_id,'user_to', $userid_to );
				Update_post_meta($newpost_id,'dir_url', $dir_title );	
				Update_post_meta($newpost_id,'dir_name', $dir_name );
				Update_post_meta($newpost_id,'from_email',sanitize_email($form_data['booking_email_address']) );
				if(isset($form_data['name'])){
					Update_post_meta($newpost_id,'from_name', sanitize_text_field($form_data['booking_name']) );
				}
				Update_post_meta($newpost_id,'from_phone', sanitize_text_field($form_data['booking_phone']) );
				Update_post_meta($newpost_id,'service_type', sanitize_text_field($form_data['booking_service_type']) );
				Update_post_meta($newpost_id,'bedrooms', sanitize_text_field($form_data['booking_bedrooms']) );
				Update_post_meta($newpost_id,'baths', sanitize_text_field($form_data['booking_baths']) );
				Update_post_meta($newpost_id,'booking_datetime', sanitize_text_field($form_data['booking_datetime']) );
				
				include( cleanup_ep_ABSPATH. 'inc/booking-mail.php');	
				echo wp_json_encode(array("msg" => esc_html__( 'Message Sent', 'cleanup' )));
				exit(0);
			
			
			}
			
			public function cleanup_message_send(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'contact' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);					
				// Create new message post
				$allowed_html = wp_kses_allowed_html( 'post' );					
				if(isset($form_data['dir_id'])){
					if($form_data['dir_id']>0){
						$dir_id=sanitize_text_field($form_data['dir_id']);
						$dir_detail= get_post($dir_id); 
						$dir_title= '<a href="'.get_permalink($dir_id).'">'.$dir_detail->post_title.'</a>';
						$user_id=$dir_detail->post_author;
						$user_info = get_userdata( $user_id);
						$client_email_address =$user_info->user_email;
						$userid_to=$user_id;
					}
				}
				if(isset($form_data['user_id'])){
					if($form_data['user_id']!=''){
						$dir_title= '';
						$user_info = get_userdata(sanitize_text_field($form_data['user_id']));
						$client_email_address =$user_info->user_email;
						$userid_to=sanitize_text_field($form_data['user_id']);
					}
				}
				$new_nessage= esc_html__( 'New Message', 'cleanup' );
				$my_post=array();
				$subject=$new_nessage;
				if(isset($form_data['subject'])){
					$subject=sanitize_text_field($form_data['subject']);
				} 
				$my_post['post_title'] =$subject;
				$my_post['post_content'] = wp_kses( $form_data['message-content'], $allowed_html); 
				$my_post['post_type'] = 'cleanup_message';
				$my_post['post_status']='private';												
				$newpost_id= wp_insert_post( $my_post );
				Update_post_meta($newpost_id,'user_to', $userid_to );
				Update_post_meta($newpost_id,'dir_url', $dir_title );				
				Update_post_meta($newpost_id,'from_email',sanitize_email($form_data['email_address']) );
				if(isset($form_data['name'])){
					Update_post_meta($newpost_id,'from_name', sanitize_text_field($form_data['name']) );
				}
				Update_post_meta($newpost_id,'from_phone', sanitize_text_field($form_data['visitorphone']) );
				include( cleanup_ep_ABSPATH. 'inc/message-mail.php');	
				echo wp_json_encode(array("msg" => esc_html__( 'Message Sent', 'cleanup' )));
				exit(0);
			}
			public function cleanup_claim_send(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'listing' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				parse_str($_POST['form_data'], $form_data);					
				include( cleanup_ep_ABSPATH. 'inc/claim-mail.php');	
				echo wp_json_encode(array("msg" => esc_html__( 'Message Sent', 'cleanup' )));
				exit(0);
			}
			public function check_listing_expire_date($listin_id, $owner_id,$cleanup_directory_url){ 
				$listing_hide=get_option('cleanup_listing_hide_opt');	
				if($listing_hide==""){$listing_hide='package';}			
				if($listing_hide=='package'){
					$exp_date= get_user_meta($owner_id, 'cleanup_exprie_date', true);
					if($exp_date!=''){
						$package_id=get_user_meta($owner_id,'cleanup_package_id',true);
						$dir_hide= get_post_meta($package_id, 'cleanup_package_hide_exp', true);
						if($dir_hide=='yes'){
							if(strtotime($exp_date) < time()){
								$dir_post = array();
								$dir_post['ID'] = $listin_id;
								$dir_post['post_status'] = 'draft';	
								$dir_post['post_type'] = $cleanup_directory_url;	
								wp_update_post( $dir_post );
							}
						}
						$have_package_feature= get_post_meta($package_id,'cleanup_package_feature',true);										
						if($have_package_feature=='yes'){
							if(strtotime($exp_date) < time()){
								update_post_meta($listin_id, 'cleanup_featured', 'no' );
							}	
						}
					}
				}
				if($listing_hide=='deadline'){
					$deadline= get_post_meta($listin_id, 'deadline', true);		
					$current_time= strtotime(gmdate("Y-m-d"));							
					if(strtotime($deadline) < $current_time){ 
						$dir_post = array();
						$dir_post['ID'] = $listin_id;
						$dir_post['post_status'] = 'draft';	
						$dir_post['post_type'] = $cleanup_directory_url;	
						wp_update_post( $dir_post );
						$have_package_feature= get_post_meta($package_id,'cleanup_package_feature',true);
						if($have_package_feature=='yes'){
							if(strtotime($exp_date) < time()){
								update_post_meta($listin_id, 'cleanup_featured', 'no' );
							}	
						}						
					}
				}
			}
			public function paging() {
				global $wp_query;
			} 
		}
	}
	if(!class_exists('cleanup_GeoQuery'))
	{
		/**
			* Extends WP_Query to do geographic searches
		*/
		class cleanup_GeoQuery extends WP_Query
		{
			private $_search_latitude = NULL;
			private $_search_longitude = NULL;
			private $_search_distance = NULL;
			private $_search_postcats = NULL;
			/**
				* Constructor - adds necessary filters to extend Query hooks
			*/
			public function __construct($args = array())
			{
				$cleanup_directory_url=get_option('cleanup_ep_url');
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				// Extract Latitude
				if(!empty($args['lat']))
				{
					$this->_search_latitude = $args['lat'];
				}
				// Extract Longitude
				if(!empty($args['lng']))
				{
					$this->_search_longitude = $args['lng'];
				}
				if(!empty($args['distance']))
				{
					$this->_search_distance = (int)$args['distance'];
				}
				if(!empty($args[$cleanup_directory_url.'-category']))
				{
					$this->_search_postcats= $args[$cleanup_directory_url.'-category'];
				}
				if(!empty($args[$cleanup_directory_url.'-tag']))
				{
					$this->_search_posttags= $args[$cleanup_directory_url.'-tag'];
				}
				if(!empty($args[$cleanup_directory_url.'-locations']))
				{
					$this->_search_postlocations= $args[$cleanup_directory_url.'-locations'];
				}
				// unset lat/lng
				unset($args['lat'], $args['lng'],$args['distance']);
				add_filter('posts_fields', array($this, 'cleanup_posts_fields'), 10, 2);
				add_filter('posts_join', array($this, 'cleanup_posts_join'), 10, 2);
				add_filter('posts_where', array($this, 'cleanup_posts_where'), 10, 2);
				add_filter('posts_groupby', array($this, 'cleanup_posts_groupby'), 10, 2);
				add_filter('posts_orderby', array($this, 'cleanup_posts_orderby'), 10, 2);
				parent::query($args);
				remove_filter('posts_fields', array($this, 'cleanup_posts_fields'));
				remove_filter('posts_join', array($this, 'cleanup_posts_join'));
				remove_filter('posts_where', array($this, 'cleanup_posts_where'));
				remove_filter('posts_groupby', array($this, 'cleanup_posts_groupby'));
				remove_filter('posts_orderby', array($this, 'cleanup_posts_orderby'));
			} // END public function __construct($args = array())
			/**
				* Selects the distance from a haversine formula
			*/
			public function cleanup_posts_groupby($where) {
				global $wpdb;
				if($this->_search_longitude!=""){
					if($this->_search_postcats!=""){
						$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance);
						}else{
						$where = $wpdb->prepare("{$wpdb->posts}.ID  HAVING distance < %d ", $this->_search_distance);
					}
					if($this->_search_posttags!=""){
						$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance);
						}else{
						$where = $wpdb->prepare("{$wpdb->posts}.ID  HAVING distance < %d ", $this->_search_distance);
					}
					if($this->_search_postlocations!=""){
						$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance);
						}else{
						$where = $wpdb->prepare("{$wpdb->posts}.ID  HAVING distance < %d ", $this->_search_distance);
					}
				}
				if($this->_search_postcats!=""){
				}
				return $where;
			}
			public function cleanup_posts_fields($fields)
			{
				global $wpdb;
				if(!empty($this->_search_latitude) && !empty($this->_search_longitude))
				{
					$dir_search_redius=get_option('cleanup_map_radius');
					$for_option_redius='6387.7';
					if($dir_search_redius=="Mile"){$for_option_redius='3959';}else{$for_option_redius='6387.7'; }
					$fields .= sprintf(", ( ".$for_option_redius."* acos(
					cos( radians(%s) ) *
					cos( radians( latitude.meta_value ) ) *
					cos( radians( longitude.meta_value ) - radians(%s) ) +
					sin( radians(%s) ) *
					sin( radians( latitude.meta_value ) )
					) ) AS distance ", $this->_search_latitude, $this->_search_longitude, $this->_search_latitude);
					$fields .= ", latitude.meta_value AS latitude ";
					$fields .= ", longitude.meta_value AS longitude ";
				}
				return $fields;
			} // END public function posts_join($join, $query)
			/**
				* Makes joins as necessary in order to select lat/long metadata
			*/
			public function cleanup_posts_join($join, $query)
			{
				global $wpdb;
				if(!empty($this->_search_latitude) && !empty($this->_search_longitude)){
					$join .= " INNER JOIN {$wpdb->postmeta} AS latitude ON {$wpdb->posts}.ID = latitude.post_id ";
					$join .= " INNER JOIN {$wpdb->postmeta} AS longitude ON {$wpdb->posts}.ID = longitude.post_id ";
				}
				return $join;
			} // END public function posts_join($join, $query)
			/**
				* Adds where clauses to compliment joins
			*/
			public function cleanup_posts_where($where)
			{
				if(!empty($this->_search_latitude) && !empty($this->_search_longitude)){
					$where .= ' AND latitude.meta_key="latitude" ';
					$where .= ' AND longitude.meta_key="longitude" ';
				}
				return $where;
			} // END public function posts_where($where)
			/**
				* Adds where clauses to compliment joins
			*/
			public function cleanup_posts_orderby($orderby)
			{
				if(!empty($this->_search_latitude) && !empty($this->_search_distance))
				{
					$orderby = " distance ASC, " . $orderby;
				}
				return $orderby;
			} // END public function posts_orderby($orderby)
		}
	}
	/*
		* Creates a new instance of the BoilerPlate Class
	*/
	function cleanupBootstraplight() {
		return cleanup_eplugins::instance();
	}
cleanupBootstraplight(); ?>