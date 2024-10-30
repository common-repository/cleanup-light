<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php $blog_title = get_bloginfo(); 
	global $wpdb;
	// Create Basic Role
	global $wp_roles;												
	$role_name_new= 'basic';
	$wp_roles->remove_role( $role_name_new );						 
	$role_display_name = 'Basic';						
	$wp_roles->add_role($role_name_new, $role_display_name, array(
    'read' => true, // True allows that capability, False specifically removes it.
    'upload_files' => true //last in array needs no comma!
	));
	require_once ('install-signup-email.php');	
	update_option('cleanup_payment_gateway', 'paypal-express' ); 
	update_option('cleanup_payment_terms', 'yes' ); 
	update_option('cleanup_price-table', 'style-1' ); 
	update_option('cleanup_api_currency', 'USD' );
	update_option('cleanup_payment_terms_text', ' I have read & accept the  Terms & Conditions' ); 
	update_option('cleanup_hide_admin_bar', 'yes' ); 

	
	// **** Create Account Form For Registration Page******
	$page_title='Registration';
	$page_name='registration';
	$page_content='[cleanup_form_wizard]';
	$post_iv = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $post_iv );
	update_option('cleanup_registration', $newpost_id); 	
	/// **** Create Page for User Profile******
	$page_title='My Account';
	$page_name='my-account';
	$page_content='[cleanup_profile_template]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_option('cleanup_profile_page', $newpost_id); 	
	/// **** Create Page for User public Profile****** 
	$page_title='Author Profile';
	$page_name='author-public';
	$page_content='[cleanup_profile_public]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_option('cleanup__public_profile_page', $newpost_id);
	
	// Login Page *******************
	$page_title='Login';
	$page_name='login';
	$page_content='[cleanup_login]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	$reg_login_page= get_permalink( $newpost_id);
	update_option('cleanup_login_page', $newpost_id);

	/// **** Create Page for  Employer Directory ******	
	$page_title='Author Directory';
	$page_name='author-directory';
	$page_content='[cleanup_author_directory]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_option('cleanup_author_dir_page', $newpost_id);
	
	
	/// **** Create Page for All Listing with map ******	
	$page_title='All Listings';
	$page_name='all-listings';
	$page_content='[cleanup_archive_grid]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	/// **** Create Page for All Listing No map ******	
	$page_title='All Listings Without Map';
	$page_name='all-listings-no-map';
	$page_content='[cleanup_archive_grid_no_map]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	
	/// **** Create Page for All Locations ******	
	$page_title='All Locations';
	$page_name='all-locations';
	$page_content='[cleanup_locations]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	/// **** Create Page for All Categories ******	
	$page_title='All Categories';
	$page_name='all-categories';
	$page_content='[cleanup_categories]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	
	/// **** Create Page for Search Form ******	
	$page_title='Search Form';
	$page_name='search-form';
	$page_content='[cleanup_search]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	/// **** Create Page for Add Listing ******	
	$page_title='Add Listing';
	$page_name='add-listing';
	$page_content='[cleanup_add_listing]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	
	