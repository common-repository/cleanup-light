<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php 
	wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?libraries=places&key='.esc_html($dir_map_api).'&callback=cleanup_initialize', array(),null, true );
	
$top_image =( isset($active_archive_fields['image'])?'yes':'no' );
$cleanup_infobox_image=get_option('cleanup_infobox_image');	
if($cleanup_infobox_image==""){$cleanup_infobox_image=$top_image;}	
if($cleanup_infobox_image=='yes'){
	$top_image='yes';	
}
$cleanup_infobox_title=get_option('cleanup_infobox_title');	
if($cleanup_infobox_title==""){$cleanup_infobox_title='yes';}	
$cleanup_infobox_location=get_option('cleanup_infobox_location');	
if($cleanup_infobox_location==""){$cleanup_infobox_location='yes';}	
$cleanup_infobox_direction=get_option('cleanup_infobox_direction');	
if($cleanup_infobox_direction==""){$cleanup_infobox_direction='yes';}	
$cleanup_infobox_linkdetail=get_option('cleanup_infobox_linkdetail');	
if($cleanup_infobox_linkdetail==""){$cleanup_infobox_linkdetail='yes';}
$cleanup_forcelocation=get_option('cleanup_forcelocation');
	
if($cleanup_forcelocation=='forcelocation'){
	$ins_lat=get_option('cleanup_defaultlatitude');
	$ins_lng=get_option('cleanup_defaultlongitude');
}	

wp_enqueue_style('cleanup-single-google-map', cleanup_ep_URLPATH . 'admin/files/css/single-google-map.css');	
wp_enqueue_script('markerclusterer',cleanup_ep_URLPATH . 'admin/files/js/markerclusterer.js');	
wp_enqueue_script('cleanup-google-map', cleanup_ep_URLPATH . 'admin/files/js/google-map.js');
	wp_localize_script('cleanup-google-map', 'cleanup_map_data', array(
	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
	'loading_image'		=> '<img src="'.cleanup_ep_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'	=>get_current_user_id(),
	'Please_login'=>esc_html__('Please login', 'cleanup' ),
	'Add_to_Favorites'=>esc_html__('Add to Favorites', 'cleanup' ),
	'direction_text'=>esc_html__('Direction', 'cleanup' ),
	'marker_icon'=> '',
	'ins_lat'=> $ins_lat,
	'top_image'=> $top_image,
	'infotitle'=>$cleanup_infobox_title,
	'infolocation'=>$cleanup_infobox_location,
	'indirection'=>$cleanup_infobox_direction,
	'infolinkdetail'=> $cleanup_infobox_linkdetail,
	'ins_lng'=> $ins_lng,
	'dir_map_zoom'=>$dir_map_zoom,
	'dirs_json'=>$dirs_json_map,
	
	'cleanup_ep_URLPATH'=>cleanup_ep_URLPATH,
	) );
	
?>

 