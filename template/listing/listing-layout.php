<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	get_header(); 
$cleanup_archive_layout=get_option('cleanup_archive_layout');	
if($cleanup_archive_layout==""){$cleanup_archive_layout='archive-left-map';}	
if($cleanup_archive_layout=='archive-left-map'){
	echo do_shortcode('[cleanup_archive_grid]');
}elseif($cleanup_archive_layout=='archive-top-map'){
	echo do_shortcode('[cleanup_archive_grid_top_map]');
}elseif($cleanup_archive_layout=='archive-no-map'){
	echo do_shortcode('[cleanup_archive_grid_no_map]');
}else{
	echo do_shortcode('[cleanup_archive_grid]');
}	
get_footer();
 ?>
