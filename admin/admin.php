<?php
	if (!defined('ABSPATH')) {
		exit;
	}
	/**
		* The Admin Panel and related tasks are handled in this file.
	*/
	if (!class_exists('cleanup_eplugins_Admin')) {
		class cleanup_eplugins_Admin {
			static $pages = array();
			public function __construct() {
				add_action('admin_menu', array($this, 'cleanup_admin_menu'));
				add_action('admin_print_scripts', array($this, 'cleanup_load_scripts'));
				add_action('admin_print_styles', array($this, 'cleanup_load_styles'));				
				add_action('wp_ajax_cleanup_update_page_setting', array($this, 'cleanup_update_page_setting'));
				add_action('wp_ajax_cleanup_update_email_setting', array($this, 'cleanup_update_email_setting'));
				add_action('wp_ajax_cleanup_update_mailchamp_setting', array($this, 'cleanup_update_mailchamp_setting'));
				add_action('wp_ajax_cleanup_add_home_page', array($this, 'cleanup_add_home_page'));
				
				
				add_action('wp_ajax_cleanup_update_account_setting', array($this, 'cleanup_update_account_setting'));			
				add_action('wp_ajax_cleanup_update_protected_setting', array($this, 'cleanup_update_protected_setting'));
				add_action('wp_ajax_cleanup_import_data', array($this, 'cleanup_import_data'));
				add_action('wp_ajax_cleanup_update_user_settings', array($this, 'cleanup_update_user_settings'));			
				add_action('wp_ajax_cleanup_update_profile_fields', array($this, 'cleanup_update_profile_fields'));
				add_action('wp_ajax_cleanup_update_dir_fields', array($this, 'cleanup_update_dir_fields'));
				add_action('wp_ajax_cleanup_update_profile_signup_fields', array($this, 'cleanup_update_profile_signup_fields'));
				add_action('wp_ajax_cleanup_update_dir_setting', array($this, 'cleanup_update_dir_setting'));	
				add_action('wp_ajax_cleanup_update_search_fields', array($this, 'cleanup_update_search_fields'));				
				add_action('wp_ajax_cleanup_update_archive_fields', array($this, 'cleanup_update_archive_fields'));
				add_action('wp_ajax_cleanup_update_single_fields', array($this, 'cleanup_update_single_fields'));				
				add_action('wp_ajax_cleanup_create_search_shortcode', array($this, 'cleanup_create_search_shortcode'));
				add_action('wp_ajax_cleanup_search_shortcodes_saved_delete', array($this, 'cleanup_search_shortcodes_saved_delete'));			
				add_action('wp_ajax_cleanup_update_map_settings', array($this, 'cleanup_update_map_settings'));
				add_action('wp_ajax_cleanup_update_color_settings', array($this, 'cleanup_update_color_settings'));
				add_action('wp_ajax_cleanup_update_myaccount_menu', array($this, 'cleanup_update_myaccount_menu'));	
				add_action( 'admin_init', array($this, 'deactivate_plugin_conditional_pro') );
				add_action( 'init', array($this, 'cleanup_gutenberg_widgets') );
						
				
			}
			
			public function deactivate_plugin_conditional_pro() {				
				if ( is_plugin_active('cleanup/plugin.php') ) { 
					  $plugins = array(
						'cleanup-light/cleanup-light.php'
					);
					require_once(ABSPATH . 'wp-admin/includes/plugin.php');
					deactivate_plugins($plugins);
					
					/// **** Create Page for Pricing Table******
					
					$page_title='Pricing Table';
					$page_name='price-table';
					$page_content='[cleanup_price_table]';
					$my_post_form = array(		
					'post_title'    => wp_strip_all_tags( $page_title),
					'post_name'    => wp_strip_all_tags( $page_name),
					'post_content'  => $page_content,
					'post_status'   => 'publish',
					'post_author'   =>  get_current_user_id(),	
					'post_type'			=> 'page',
					);
					$newpost_id= wp_insert_post( $my_post_form,'true' );	
					update_option('cleanup_price_table', $newpost_id); 
					
				}
			}
			// Hook into the 'init' action
			
			public function cleanup_gutenberg_widgets(){
				require_once ('pages/tinymce_shortcode_button.php');
			}			
			
			/**
				* Menus in the wp-admin sidebar
			*/
			public function cleanup_admin_menu() {
				$cleanup_directory_url=get_option('cleanup_ep_url');					
				if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
				add_menu_page('cleanup', 'CleanUp Settings', 'manage_options', 'cleanup', array($this, 'cleanup_menu_hook'),'dashicons-universal-access-alt',9);
				self::$pages['cleanup-settings'] = add_submenu_page('cleanup', 'cleanup Settings', 'Settings', 'manage_options', 'cleanup-settings', array($this, 'cleanup_menu_hook'));				
				add_submenu_page('cleanup', 'cleanup', 'Categories', 'manage_options',  'edit-tags.php?taxonomy='.$cleanup_directory_url.'-category&post_type='.$cleanup_directory_url,'',1);
				add_submenu_page('cleanup', 'cleanup', 'Tags', 'manage_options', 'edit-tags.php?taxonomy='.$cleanup_directory_url.'-tag&post_type='.$cleanup_directory_url,'',2);
				add_submenu_page('cleanup', 'cleanup', 'Locations', 'manage_options', 'edit-tags.php?taxonomy='.$cleanup_directory_url.'-locations&post_type='.$cleanup_directory_url,'',3);				
				self::$pages['cleanup-user_update'] = add_submenu_page('', 'cleanup user_update', '', 'manage_options', 'cleanup-user_update', array($this, 'cleanup_user_update_page'));
			}
			/**
				* Menu Page Router
			*/
			public function cleanup_menu_hook() {
				$screen = get_current_screen();
				switch ($screen->id) {
					default:
					require_once ('pages/settings.php');
					break;
					case self::$pages['cleanup-settings']:
					require_once ('pages/settings.php');
					break;
				}
			}
			public function cleanup_profile_fields_setting (){
				require_once ('pages/registration-fields.php');
			}
			public function cleanup_coupon_create_page(){
				require_once ('pages/coupon_create.php');
			}
			public function cleanup_coupon_update_page(){
				require_once ('pages/coupon_update.php');
			}
			public function cleanup_package_create_page(){
				require_once ('pages/package_create.php');
			}
			public function cleanup_package_update_page(){
				require_once ('pages/package_update.php');
			}
			public function cleanup_paypal_update_page(){
				require_once ('pages/paypal_update.php');
			}
			public function cleanup_stripe_update_page(){
				require_once ('pages/stripe_update.php');
			}
			public function cleanup_user_update_page(){
				require_once ('pages/user_update.php');
			}
			/**
				* Page based Script Loader
			*/
			public function cleanup_load_scripts() { 
				$screen = get_current_screen();
				if (in_array($screen->id, array_values(self::$pages))) {
				$currencyCode= 'USD';
				
				wp_enqueue_script("jquery");				
				wp_enqueue_script('jquery-ui-core');
				wp_enqueue_script('jquery-ui-sortable');
				wp_enqueue_script('jquery-ui-datepicker');				
				wp_enqueue_media();
				wp_enqueue_script('bootstrap.min', cleanup_ep_URLPATH . 'admin/files/js/bootstrap.min-4.js');					
				wp_enqueue_script('cleanup-script-dashboardadmin', cleanup_ep_URLPATH . 'admin/files/js/dashboard-admin.js');
				wp_localize_script('cleanup-script-dashboardadmin', 'admindata', array(
				'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
				'loading_image'		=> '<img src="'.cleanup_ep_URLPATH.'admin/files/images/loader.gif">',
				'wp_iv_directories_URLPATH'		=> cleanup_ep_URLPATH,
				'cleanup_ep_ADMINPATH' => cleanup_ep_ADMINPATH,
				'current_user_id'	=>get_current_user_id(),	
				'SetImage'		=>esc_html__('Set Image','cleanup'),
				'GalleryImages'=>esc_html__('Gallery Images','cleanup'),	
				'cancel-message' => esc_html__('Are you sure to cancel this Membership','cleanup'),
				'currencyCode'=>  $currencyCode,
				'dirwpnonce'=> wp_create_nonce("myaccount"),
				'settings'=> wp_create_nonce("settings"), 
				'cityimage'=> wp_create_nonce("city-image"),
				'packagenonce'=> wp_create_nonce("package"),
				'catimage'=> wp_create_nonce("cat-image"),							
				'signup'=> wp_create_nonce("signup"),
				'contact'=> wp_create_nonce("contact"),
				'coupon'=> wp_create_nonce("coupon"),
				'fields'=> wp_create_nonce("fields"),
				'dirsetting'=> wp_create_nonce("dir-setting"),
				'mymenu'=> wp_create_nonce("my-menu"),
				'paymentgateway'=> wp_create_nonce("payment-gateway"), 
				'permalink'=> get_permalink(),			
				) );
				$big_button_color=get_option('cleanup_big_button_color');	
				if($big_button_color==""){$big_button_color='#2e7ff5';}	
				$small_button_color=get_option('cleanup_small_button_color');	
				if($small_button_color==""){$small_button_color='#5f9df7';}
				$icon_color=get_option('cleanup_icon_color');	
				if($icon_color==""){$icon_color='#5b5b5b';}	
				$title_color=get_option('cleanup_title_color');	
				if($title_color==""){$title_color='#5b5b5b';}
				$button_font_color=get_option('cleanup_button_font_color');	
				if($button_font_color==""){$button_font_color='#fffff';}
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
				wp_enqueue_script('dataTables', cleanup_ep_URLPATH . 'admin/files/js/jquery.dataTables.js');
				wp_enqueue_script('dataTablesrowReordermin', cleanup_ep_URLPATH . 'admin/files/js/dataTables.rowReorder.min.js');
				wp_enqueue_script('dataTablesresponsivemin', cleanup_ep_URLPATH . 'admin/files/js/dataTables.responsive.min.js');
				}
			}
			/**
				* Page based Style Loader
			*/
			public function cleanup_load_styles() {
				$screen = get_current_screen();		
				if (in_array($screen->id, array_values(self::$pages))) {
				wp_enqueue_style('jquery-ui', cleanup_ep_URLPATH . 'admin/files/css/jquery-ui.css');					
				wp_enqueue_style('bootstrap', cleanup_ep_URLPATH . 'admin/files/css/iv-bootstrap.css');
				wp_enqueue_style('cleanup_dashboard-style', cleanup_ep_URLPATH . 'admin/files/css/dashboard-admin.css');
				
				
				wp_enqueue_style('dataTables-min', cleanup_ep_URLPATH . 'admin/files/css/jquery.dataTables.min.css');	
				wp_enqueue_style('rowReorder-dataTables', cleanup_ep_URLPATH . 'admin/files/css/rowReorder.dataTables.min.css');
				wp_enqueue_style('responsive-dataTables', cleanup_ep_URLPATH . 'admin/files/css/responsive.dataTables.min.css');
				}
	
			}
			
			
			/**
				* Use this function to execute actions
			*/
			public function cleanup_import_data(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				include ('pages/import-demo.php');
				echo wp_json_encode(array('code' => 'success'));
				exit(0);
			}
			
			
			public function cleanup_update_myaccount_menu(){
				if ( ! wp_verify_nonce( sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				// remove menu******
				if(isset($form_data['listinghome'])){
					update_option('cleanup_menu_listinghome' ,sanitize_text_field($form_data['listinghome'])); 
					}else{
					update_option('cleanup_menu_listinghome' ,'no') ; 
				}
				if(isset($form_data['mylevel'])){
					update_option('cleanup_mylevel' ,sanitize_text_field($form_data['mylevel'])); 
					}else{
					update_option('cleanup_mylevel' ,'no') ; 
				}
				if(isset($form_data['menusetting'])){
					update_option('cleanup_menusetting' ,sanitize_text_field($form_data['menusetting'])); 
					}else{
					update_option('cleanup_menusetting' ,'no') ; 
				}
				if(isset($form_data['menuallpost'])){
					update_option('cleanup_menuallpost' ,sanitize_text_field($form_data['menuallpost'])); 
					}else{
					update_option('cleanup_menuallpost' ,'no') ; 
				}
				if(isset($form_data['menunecandidates'])){
					update_option('cleanup_menunecandidates' ,sanitize_text_field($form_data['menunecandidates'])); 
					}else{
					update_option('cleanup_menunecandidates' ,'no') ; 
				}
				if(isset($form_data['messageboard'])){
					update_option('cleanup_messageboard' ,sanitize_text_field($form_data['messageboard'])); 
					}else{
					update_option('cleanup_messageboard' ,'no') ; 
				}
				if(isset($form_data['notification'])){
					update_option('cleanup_notification' ,sanitize_text_field($form_data['notification'])); 
					}else{
					update_option('cleanup_notification' ,'no') ; 
				}
				
				if(isset($form_data['author_bookmarks'])){
					update_option('cleanup_author_bookmarks' ,sanitize_text_field($form_data['author_bookmarks'])); 
					}else{
					update_option('cleanup_author_bookmarks' ,'no') ; 
				}
				if(isset($form_data['listing_bookmark'])){
					update_option('cleanup_listing_bookmarks' ,sanitize_text_field($form_data['listing_bookmark'])); 
					}else{
					update_option('cleanup_listing_bookmarks' ,'no') ; 
				}
				echo wp_json_encode(array("code" => "success","msg"=> esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_profile_signup_fields(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'admin' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$opt_array= array();
				$opt_type_array= array();
				$opt_type_value_array= array();
				$opt_type_roles_array= array();				
				$signup_array= array();
				$require_array= array();
				$myaccount_array= array();
				$max = sizeof($form_data['meta_name']);
				for($i = 0; $i < $max;$i++)
				{
					if($form_data['meta_name'][$i]!="" AND $form_data['meta_label'][$i]!=""){
						$opt_array[$form_data['meta_name'][$i]]=sanitize_text_field($form_data['meta_label'][$i]);	
						if(isset($form_data['field_type'][$i])){
							$opt_type_array[$form_data['meta_name'][$i]]=sanitize_text_field($form_data['field_type'][$i]);
							}else{
							$opt_type_array[$form_data['meta_name'][$i]]='';
						}
						if(isset($form_data['field_type_value'][$i])){
							$opt_type_value_array[$form_data['meta_name'][$i]]=sanitize_text_field($form_data['field_type_value'][$i]);
							}else{
							$opt_type_value_array[$form_data['meta_name'][$i]]='';
						}
						if(isset($form_data['field_user_role'.$i])){	
							$input_field_role_arr= array();
							foreach($form_data['field_user_role'.$i] as $field_role){
								$input_field_role_arr[]= sanitize_text_field($field_role);
							}							
							$opt_type_roles_array[$form_data['meta_name'][$i]]=$input_field_role_arr;
							}else{
							$opt_type_roles_array[$form_data['meta_name'][$i]]='';
						}
						if(isset($form_data['signup'.$i])){							
							$signup_array[$form_data['meta_name'][$i]]='yes';							
							}else{							
							$signup_array[$form_data['meta_name'][$i]]='no';
						}
						if(isset($form_data['srequire'.$i])){							
							$require_array[$form_data['meta_name'][$i]]='yes';
							}else{
							$require_array[$form_data['meta_name'][$i]]='no';
						}
						if(isset($form_data['myaccountprofile'.$i])){							
							$myaccount_array[$form_data['meta_name'][$i]]='yes';
							}else{
							$myaccount_array[$form_data['meta_name'][$i]]='no';
						}
					}
				}
				update_option('cleanup_profile_fields', $opt_array );
				update_option('cleanup_field_type', $opt_type_array );
				update_option('cleanup_field_type_value', $opt_type_value_array );
				update_option('cleanup_field_type_roles', $opt_type_roles_array );
				update_option('cleanup_signup_fields', $signup_array );
				update_option('cleanup_myaccount_fields', $myaccount_array );				
				update_option('cleanup_signup_require', $require_array );
				if(isset($form_data['signup_profile_pic'])){
					update_option( 'cleanup_signup_profile_pic' ,sanitize_text_field($form_data['signup_profile_pic']));
					}else{
					update_option( 'cleanup_signup_profile_pic' ,'no') ;
				}
				if(isset($form_data['cleanup_payment_coupon'])){
					update_option( 'cleanup_payment_coupon' ,sanitize_text_field($form_data['cleanup_payment_coupon']));
					}else{
					update_option( 'cleanup_payment_coupon' ,'no') ;
				}
				if(isset($form_data['cleanup_payment_terms'])){
					update_option( 'cleanup_payment_terms' ,sanitize_text_field($form_data['cleanup_payment_terms']));
					}else{
					update_option( 'cleanup_payment_terms' ,'no') ;
				}
				echo wp_json_encode(array('code' => 'Update Successfully'));
				exit(0);
			}
			public function cleanup_update_dir_setting(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'dir-setting' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);	
				update_option('cleanup_user_can_publish',sanitize_text_field($form_data['cleanup_user_can_publish']));
				update_option('cleanup_archive_layout',sanitize_text_field($form_data['cleanup_archive_layout']));
				update_option('cleanup_listing_hide_opt',sanitize_text_field($form_data['listing_hide']));
				$custom_post_type=sanitize_text_field($form_data['cleanup_url']);
				$custom_post_type=strtolower($custom_post_type);
				$custom_post_type=str_replace(' ','',$custom_post_type);				
				$custom_post_type=str_replace('*','',$custom_post_type);
				$custom_post_type=str_replace('$','',$custom_post_type);
				$custom_post_type=str_replace('#','',$custom_post_type);
				update_option('cleanup_ep_url',$custom_post_type);
				update_option('cleanup_dir_perpage',sanitize_text_field($form_data['cleanup_dir_perpage']));
				update_option('cleanup_listing_defaultimage',sanitize_text_field($form_data['cleanup_listing_defaultimage']));
				update_option('cleanup_location_defaultimage',sanitize_text_field($form_data['cleanup_location_defaultimage']));
				update_option('cleanup_category_defaultimage',sanitize_text_field($form_data['cleanup_category_defaultimage']));
				update_option('cleanup_banner_defaultimage',sanitize_text_field($form_data['cleanup_banner_defaultimage']));
				if(isset($form_data['cleanup_facet_listinglevel_show'])){
					update_option( 'cleanup_facet_listinglevel_show' ,sanitize_text_field($form_data['cleanup_facet_listinglevel_show']));
					}else{
					update_option( 'cleanup_facet_listinglevel_show' ,'no') ; 						
				}
				echo wp_json_encode(array("code" => "success","msg"=> esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_profile_fields(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'my-menu' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$opt_array2= array();
				if(isset($form_data['menu_title'])){
					$max = sizeof($form_data['menu_title']);
					for($i = 0; $i < $max;$i++)
					{	
						if($form_data['menu_title'][$i]!="" AND $form_data['menu_link'][$i]!=""){
							$opt_array2[$form_data['menu_title'][$i]]=$form_data['menu_link'][$i];
						}
					}			
					update_option('cleanup_profile_menu', $opt_array2 );
				}
				// remove menu******
				if(isset($form_data['listinghome'])){
					update_option('cleanup_menu_listinghome' ,sanitize_text_field($form_data['listinghome'])); 
					}else{
					update_option('cleanup_menu_listinghome' ,'no') ; 
				}
				if(isset($form_data['mylevel'])){
					update_option('cleanup_mylevel' ,sanitize_text_field($form_data['mylevel'])); 
					}else{
					update_option('cleanup_mylevel' ,'no') ; 
				}
				if(isset($form_data['menusetting'])){
					update_option('cleanup_menusetting' ,sanitize_text_field($form_data['menusetting'])); 
					}else{
					update_option('cleanup_menusetting' ,'no') ; 
				}
				if(isset($form_data['menuallpost'])){
					update_option('cleanup_menuallpost' ,sanitize_text_field($form_data['menuallpost'])); 
					}else{
					update_option('cleanup_menuallpost' ,'no') ; 
				}
				if(isset($form_data['menunecandidates'])){
					update_option('cleanup_menunecandidates' ,sanitize_text_field($form_data['menunecandidates'])); 
					}else{
					update_option('cleanup_menunecandidates' ,'no') ; 
				}
				if(isset($form_data['messageboard'])){
					update_option('cleanup_messageboard' ,sanitize_text_field($form_data['messageboard'])); 
					}else{
					update_option('cleanup_messageboard' ,'no') ; 
				}
				if(isset($form_data['notification'])){
					update_option('cleanup_notification' ,sanitize_text_field($form_data['notification'])); 
					}else{
					update_option('cleanup_notification' ,'no') ; 
				}
				
				if(isset($form_data['author_bookmarks'])){
					update_option('cleanup_author_bookmarks' ,sanitize_text_field($form_data['author_bookmarks'])); 
					}else{
					update_option('cleanup_author_bookmarks' ,'no') ; 
				}
				if(isset($form_data['listing_bookmark'])){
					update_option('cleanup_listing_bookmarks' ,sanitize_text_field($form_data['listing_bookmark'])); 
					}else{
					update_option('cleanup_listing_bookmarks' ,'no') ; 
				}
				echo wp_json_encode(array('code' => esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_dir_fields(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'fields' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$opt_array= array();				
				$opt_type_array= array();
				$opt_type_value_array= array();
				$opt_type_cat_array= array();			
				$max = sizeof($form_data['meta_name']);
				for($i = 0; $i < $max;$i++)
				{
					if($form_data['meta_name'][$i]!="" AND $form_data['meta_label'][$i]!=""){
						if(isset($form_data['meta_name'][$i])){
							$opt_array[sanitize_text_field($form_data['meta_name'][$i])]=sanitize_text_field($form_data['meta_label'][$i]);	
							}else{
							$opt_array[$form_data['meta_name'][$i]]='';
						}
						if(isset($form_data['field_type'][$i])){
							$opt_type_array[$form_data['meta_name'][$i]]=sanitize_text_field($form_data['field_type'][$i]);
							}else{
							$opt_type_array[$form_data['meta_name'][$i]]='';
						}
						if(isset($form_data['field_type_value'][$i])){
							$opt_type_value_array[$form_data['meta_name'][$i]]=sanitize_text_field($form_data['field_type_value'][$i]);
							}else{
							$opt_type_value_array[$form_data['meta_name'][$i]]='';
						}
						if(isset($form_data['field_categories'.$i])){							
							$opt_type_cat_array[$form_data['meta_name'][$i]]=$form_data['field_categories'.$i];
							}else{
							$opt_type_cat_array[$form_data['meta_name'][$i]]='';
						}	
					}
				}
				update_option('cleanup_li_fields', $opt_array );
				update_option('cleanup_li_field_type', $opt_type_array );
				update_option('cleanup_li_fieldtype_value', $opt_type_value_array );
				update_option('cleanup_field_type_cat', $opt_type_cat_array );				
				update_option('cleanup_listing_level',sanitize_text_field($form_data['cleanup_listing_level_all']));						
				update_option('cleanup_listing_status',sanitize_text_field($form_data['cleanup_listing_status_all']));
				update_option('cleanup_experience_range',sanitize_text_field($form_data['listing_cleanup_experience_range']));
				echo wp_json_encode(array('code' => 'Update Successfully'));
				exit(0);
			}
			
		
			
		
			
		
			public function cleanup_update_account_setting(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$post_approved='no';
				if(isset($form_data['post_approved'])){
					$post_approved=sanitize_text_field($form_data['post_approved']);
				}
				$signup_redirect=sanitize_text_field($form_data['signup_redirect']);
				$private_profile_page  = sanitize_text_field($form_data['pri_profile_redirect']); 
				$pub_profile_redirect=sanitize_text_field($form_data['profile_redirect']);
				if(isset($form_data['hide_admin_bar'])){
					$admin_bar=$form_data['hide_admin_bar'];
					}else{
					$admin_bar='no';
				}
				update_option('cleanup_post_approved', $post_approved );
				update_option('cleanup_signup_redirect', $signup_redirect );
				update_option('cleanup_profile_page', $private_profile_page );
				update_option('cleanup_profile_public_page', $pub_profile_redirect );
				update_option('cleanup_hide_admin_bar', $admin_bar );
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_protected_setting(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				if(isset($form_data['active_visibility'])){
					$active_visibility=$form_data['active_visibility'];
					}else{
					$active_visibility='no';
				}		
				update_option('cleanup_active_visibility', $active_visibility );
				if(isset($form_data['login_message'])){
					update_option('cleanup_visibility_login_message', sanitize_text_field($form_data['login_message'] ));
				}
				if(isset($form_data['visitor_message'])){
					update_option('cleanup_visibility_visitor_message', sanitize_text_field($form_data['visitor_message'] ));
				}
				update_option('cleanup_visibility_serialize_role', $form_data);
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_page_setting(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				$iv_terms='no';
				if(isset($form_data['iv_terms'])){
					$iv_terms=$form_data['iv_terms'];
				}
				$pricing_page=sanitize_text_field($form_data['pricing_page']);
				$signup_page=sanitize_text_field($form_data['signup_page']);
				$profile_page=sanitize_text_field($form_data['profile_page']);
				$profile_public=sanitize_text_field($form_data['profile_public']);
				$thank_you=sanitize_text_field($form_data['thank_you_page']);
				$login=sanitize_text_field($form_data['login_page']);
				update_option('cleanup_price_table', $pricing_page); 
				update_option('cleanup_registration', $signup_page); 
				update_option('cleanup_profile_page', $profile_page);
				update_option('cleanup_profile_public',$profile_public);
				update_option('cleanup_thank_you_page',$thank_you); 
				update_option('cleanup_login_page',$login); 				
				update_option('cleanup_author_dir_page',sanitize_text_field($form_data['employer_dir'])); 
				update_option('cleanup_candidate_dir_page',sanitize_text_field($form_data['candidate_dir']));
				update_option('cleanup__public_profile_page',sanitize_text_field($form_data['employer_public']));
				update_option('cleanup_candidate_public_page',sanitize_text_field($form_data['candidate_public']));
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_email_setting(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				$allowed_html = wp_kses_allowed_html( 'post' );
				parse_str($_POST['form_data'], $form_data);
				update_option( 'cleanup_signup_email_subject',sanitize_text_field($form_data['cleanup_signup_email_subject']));			
				update_option( 'cleanup_signup_email',wp_kses( $form_data['signup_email_template'], $allowed_html));
				update_option( 'cleanup_forget_email_subject',sanitize_text_field($form_data['forget_email_subject']));				
				update_option( 'cleanup_forget_email',wp_kses( $form_data['forget_email_template'], $allowed_html));
				update_option('cleanup_admin_email', sanitize_text_field($form_data['cleanup_admin_email'])); 
				update_option('cleanup_order_client_email_sub', sanitize_text_field($form_data['cleanup_order_email_subject']));
				update_option( 'cleanup_order_client_email',wp_kses( $form_data['order_client_email_template'], $allowed_html));
				update_option('cleanup_order_admin_email_sub', sanitize_text_field($form_data['cleanup_order_admin_email_subject']));
				update_option( 'cleanup_order_admin_email',wp_kses( $form_data['order_admin_email_template'], $allowed_html));
				update_option( 'cleanup_reminder_email_subject',sanitize_text_field($form_data['cleanup_reminder_email_subject']));
				update_option( 'cleanup_reminder_email',wp_kses( $form_data['reminder_email_template'], $allowed_html));
				update_option('cleanup_reminder_day', sanitize_text_field($form_data['cleanup_reminder_day'])); 
				update_option( 'cleanup_contact_email_subject',sanitize_text_field($form_data['contact_email_subject']));				
				update_option( 'cleanup_contact_email',wp_kses( $form_data['message_email_template'], $allowed_html));
				update_option( 'cleanup_apply_email_subject',sanitize_text_field($form_data['cleanup_apply_email_subject']));				
				update_option( 'cleanup_apply_email',wp_kses( $form_data['apply_email_template'], $allowed_html));
				update_option( 'cleanup_notification_email_subject',sanitize_text_field($form_data['cleanup_notification_email_subject']));
				update_option( 'cleanup_notification_email',wp_kses( $form_data['notification_email_template'], $allowed_html));
				$bcc_message=(isset($form_data['bcc_message'])? sanitize_text_field($form_data['bcc_message']):'' );		
				update_option('cleanup_bcc_message',$bcc_message);
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_add_home_page(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				$page_title='Home';
				$page_name='home';
				$page_content='';
				$post_iv = array(
				'post_title'    => wp_strip_all_tags( $page_title),
				'post_name'    => wp_strip_all_tags( $page_name),
				'post_content'  => $page_content,
				'post_status'   => 'publish',
				'post_author'   =>  get_current_user_id(),	
				'post_type'		=> 'page',
				);
				$newpost_id= wp_insert_post( $post_iv );
				update_option( 'cleanup_cleanup_page_on_front', $newpost_id );
				update_option( 'cleanup_cleanup_show_on_front', 'page' );
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Home page added', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_mailchamp_setting (){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				update_option('cleanup_mailchimp_api_key', sanitize_text_field($form_data['cleanup_mailchimp_api_key'])); 
				update_option('cleanup_mailchimp_confirmation', sanitize_text_field($form_data['cleanup_mailchimp_confirmation'])); 
				if(isset($form_data['cleanup_mailchimp_list'])){
					update_option('cleanup_mailchimp_list', sanitize_text_field($form_data['cleanup_mailchimp_list'])); 
				}
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			
			
			public function cleanup_update_color_settings(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				if(isset($form_data['big_button_color'])){
					update_option('cleanup_big_button_color',sanitize_text_field($form_data['big_button_color']));
				}
				if(isset($form_data['small_button_color'])){
					update_option('cleanup_small_button_color',sanitize_text_field($form_data['small_button_color']));
				}
				if(isset($form_data['icon_color'])){
					update_option('cleanup_icon_color',sanitize_text_field($form_data['icon_color']));
				}
				if(isset($form_data['title_color'])){
					update_option('cleanup_title_color',sanitize_text_field($form_data['title_color']));
				}
				if(isset($form_data['button_font_color'])){
					update_option('cleanup_button_font_color',sanitize_text_field($form_data['button_font_color']));
				}
				if(isset($form_data['button_small_font_color'])){
					update_option('cleanup_button_small_font_color',sanitize_text_field($form_data['button_small_font_color']));
				}
				if(isset($form_data['content_font_color'])){
					update_option('cleanup_content_font_color',sanitize_text_field($form_data['content_font_color']));
				}
				if(isset($form_data['border_color'])){
					update_option('cleanup_border_color',sanitize_text_field($form_data['border_color']));
				}
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_map_settings(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}
				parse_str($_POST['form_data'], $form_data);
				update_option('cleanup_map_api',sanitize_text_field($form_data['dir_map_api']));
				update_option('cleanup_map_zoom',sanitize_text_field($form_data['dir_map_zoom']));				
				update_option('cleanup_map_type',sanitize_text_field($form_data['map_type']));
				update_option('cleanup_map_radius',sanitize_text_field($form_data['cleanup_map_radius']));
				update_option('cleanup_near_to_me',sanitize_text_field($form_data['cleanup_near_to_me']));				
				update_option('cleanup_defaultlatitude',sanitize_text_field($form_data['cleanup_defaultlatitude']));
				update_option('cleanup_defaultlongitude',sanitize_text_field($form_data['cleanup_defaultlongitude']));
				if(isset($form_data['cleanup_forcelocation'])){
					update_option('cleanup_forcelocation',sanitize_text_field($form_data['cleanup_forcelocation']));
					}else{
					update_option('cleanup_forcelocation','no');
				}
				if(isset($form_data['cleanup_infobox_image'])){
					update_option('cleanup_infobox_image',sanitize_text_field($form_data['cleanup_infobox_image']));
					}else{
					update_option('cleanup_infobox_image','no');
				}
				if(isset($form_data['cleanup_infobox_title'])){
					update_option('cleanup_infobox_title',sanitize_text_field($form_data['cleanup_infobox_title']));
					}else{
					update_option('cleanup_infobox_title','no');
				}
				if(isset($form_data['cleanup_infobox_location'])){
					update_option('cleanup_infobox_location',sanitize_text_field($form_data['cleanup_infobox_location']));
					}else{
					update_option('cleanup_infobox_location','no');
				}
				if(isset($form_data['cleanup_infobox_direction'])){
					update_option('cleanup_infobox_direction',sanitize_text_field($form_data['cleanup_infobox_direction']));
					}else{
					update_option('cleanup_infobox_direction','no');
				}
				if(isset($form_data['cleanup_infobox_linkdetail'])){
					update_option('cleanup_infobox_linkdetail',sanitize_text_field($form_data['cleanup_infobox_linkdetail']));
					}else{
					update_option('cleanup_infobox_linkdetail','no');
				}
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_search_shortcodes_saved_delete(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}	
				parse_str($_POST['form_data'], $form_data);
				$new_field_arr= array();
				if(isset($form_data['shortcodearr'])){
					foreach ( $form_data['shortcodearr'] as $field_key => $field_value ) { 
						$new_field_arr[]= sanitize_text_field($field_value);
					}
				}				
				print_r($new_field_arr);
				update_option('cleanup_search_shortcodes_saved',$new_field_arr);
				echo wp_json_encode(array("code" => "success","msg"=>''));
				exit(0);
			}
			public function cleanup_create_search_shortcode(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}	
				parse_str($_POST['form_data'], $form_data);
				$post_fields_type=array();		
				$i=0;$field_name='';	$field_type='';
				if(isset($form_data['cleanup_single_restrict'])){
					update_option('cleanup_single_restrict',sanitize_text_field($form_data['cleanup_single_restrict']));
					}else{
					update_option('cleanup_single_restrict','no');
				}
				$short_text='[cleanup_search ';
				$short_text=$short_text.'action="'.$form_data['cleanup_search_action_target'].'" ';
				foreach ( $form_data['search-field-name'] as $field_key => $field_value ) { 
					$post_fields_type[sanitize_text_field($field_value)]=sanitize_text_field($form_data['search-field-type'][$field_key]);	
					$field_name=$field_name.$field_value.',';
					$field_type=$field_type.sanitize_text_field($form_data['search-field-type'][$field_key]).',';
					$i++;
				}
				$short_text=$short_text. 'field-name="'.$field_name.'" field-type="'.$field_type.'"  ]';
				$short_text_all='';
				$short_text_saved=get_option('cleanup_search_shortcodes_saved' );
				if(is_array($short_text_saved)){
					$short_text_saved[]=$short_text;	
				}
				if($short_text_saved==''){
					$short_text_saved =array();
					$short_text_saved[]=$short_text;
				}
				update_option('cleanup_search_shortcodes_saved',$short_text_saved );
				echo wp_json_encode(array("code" => "success","msg"=>$short_text));
				exit(0);
			}
			public function cleanup_update_single_fields(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}	
				parse_str($_POST['form_data'], $form_data);				
				$post_fields_type=array();	
				$post_fields_icon=array();
				$i=0;
				foreach ( $form_data['search-field-name'] as $field_key => $field_value ) { 
					$post_fields_type[sanitize_text_field($field_value)]=sanitize_text_field($form_data['search-field-type'][$field_key]);$post_fields_icon[sanitize_text_field($field_value)]=sanitize_text_field($form_data['field_icon'][$field_key]);					
					$i++;
				}
				update_option('cleanup_single_fields_saved',$post_fields_type );
				update_option('cleanup_single_icon_saved',$post_fields_icon );				
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_archive_fields(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}	
				parse_str($_POST['form_data'], $form_data);				
				$post_fields_type=array();
				$post_fields_icon=array();
				$i=0;
				foreach ( $form_data['search-field-name'] as $field_key => $field_value ) { 
					$post_fields_type[sanitize_text_field($field_value)]=sanitize_text_field($form_data['search-field-type'][$field_key]);
					$post_fields_icon[sanitize_text_field($field_value)]=sanitize_text_field($form_data['field_icon'][$field_key]);
					$i++;
				}
				update_option('cleanup_archive_fields_saved',$post_fields_type );
				update_option('cleanup_archive_icon_saved',$post_fields_icon );
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_search_fields(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}	
				parse_str($_POST['form_data'], $form_data);				
				$post_fields_type=array();		
				$i=0;
				foreach ( $form_data['search-field-name'] as $field_key => $field_value ) { 
					$post_fields_type[sanitize_text_field($field_value)]=sanitize_text_field($form_data['search-field-type'][$field_key]);					
					$i++;
				}
				update_option('cleanup_search_action_target',sanitize_text_field($form_data['cleanup_search_action_target']) );				
				update_option('cleanup_search_fields_saved',$post_fields_type );
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
			public function cleanup_update_user_settings(){
				if ( ! wp_verify_nonce(  sanitize_text_field($_POST['_wpnonce']), 'settings' ) ) {
					wp_die( 'Are you cheating:wpnonce?' );
				}
				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( 'Are you cheating:user Permission?' );
				}		
				parse_str($_POST['form_data'], $form_data);
				if(array_key_exists('wp_capabilities',$form_data)){
					wp_die( 'Are you cheating:wp_capabilities?' );
				}	
				$user_id=sanitize_text_field($form_data['user_id']);
				if($form_data['exp_date']!=''){
					$exp_d=gmdate('Y-m-d', strtotime($form_data['exp_date']));	 
					update_user_meta($user_id, 'cleanup_exprie_date',$exp_d); 
				}		
				update_user_meta($user_id, 'cleanup_payment_status', sanitize_text_field($form_data['payment_status']));	
				update_user_meta($user_id, 'cleanup_package_id',sanitize_text_field($form_data['package_sel'])); 
			
				if(isset($form_data['topbanner_url']) AND $form_data['topbanner_url']!=''){				 
					update_user_meta($user_id,'topbanner', sanitize_url($form_data['topbanner_url']));
				}
				if(isset($form_data['profile_image_url']) AND $form_data['profile_image_url']!=''){				 
					update_user_meta($user_id,'cleanup_profile_pic_thum', sanitize_url($form_data['profile_image_url']));
				}
				$user = new WP_User( $user_id );
				$user->set_role(sanitize_text_field($form_data['user_role']));
				$field_type=array();
				$field_type_opt=  get_option( 'cleanup_field_type' );
				if($field_type_opt!=''){
					$field_type=get_option('cleanup_field_type' );
					}else{
					$field_type['first_name']='text';
					$field_type['last_name']='text';
					$field_type['phone']='text';								
					$field_type['address']='text';
					$field_type['city']='text';
					$field_type['zipcode']='text';
					$field_type['country']='text';
					$field_type['listing_title']='text';					
					$field_type['occupation']='text';
					$field_type['description']='textarea';
					$field_type['web_site']='url';					
				}		
				foreach ( $form_data as $field_key => $field_value ) { 
					if(strtolower(trim($field_key))!='wp_capabilities'){						
						if(is_array($field_value)){
							$field_value =implode(",",$field_value);
						}
						if($field_type[$field_key]=='url'){							
							update_user_meta($user_id, sanitize_text_field($field_key), sanitize_url($field_value)); 
							}elseif($field_type[$field_key]=='textarea'){
							update_user_meta($user_id, sanitize_text_field($field_key), sanitize_textarea_field($field_value));  
							}else{
							update_user_meta($user_id, sanitize_text_field($field_key), sanitize_text_field($field_value)); 
						}
					}
				}
				echo wp_json_encode(array("code" => "success","msg"=>esc_html__( 'Updated Successfully', 'cleanup')));
				exit(0);
			}
		}
	}
$cleanup_eplugins_Admin = new cleanup_eplugins_Admin();