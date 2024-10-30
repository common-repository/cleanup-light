<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	wp_enqueue_style('bootstrap', cleanup_ep_URLPATH . 'admin/files/css/iv-bootstrap.css');
  wp_enqueue_style('cleanup_style-city', cleanup_ep_URLPATH . 'admin/files/css/styles.css');

wp_enqueue_script('slick', cleanup_ep_URLPATH.'admin/files/js/slick.js', array('jquery'), $ver = true, true );
wp_enqueue_style('slick', cleanup_ep_URLPATH . 'admin/files/css/slick.css');
  
  
  
	global $post,$wpdb;
	$cleanup_directory_url=get_option('cleanup_ep_url');
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	$post_limit='9999';
	if(isset($atts['post_limit']) and $atts['post_limit']!="" ){
		$post_limit=$atts['post_limit'];
	}
	$postcats_arr=array();
	if(isset($atts['slugs'])){
		$postcats = $atts['slugs'];
		$postcats_arr=explode(',',$postcats);
	}
?>
<section id="destination" class="background-transparent">
	<section class="bootstrap-wrapper background-transparent">
		<div class="container dynamic-bg">
			<div class="row mt-5 cities-sec-row">
				<?php
					$taxonomy = $cleanup_directory_url.'-category';
					$args = array(
					'orderby'           => 'name',
					'order'             => 'ASC',
					'hide_empty'        => true,
					'taxonomy'   => 	$taxonomy ,
					'exclude'           => array(),
					'exclude_tree'      => array(),
					'include'           => array(),
					'number'            => $post_limit,
					'fields'            => 'all',
					'slug'              => $postcats_arr,	
					'parent'            => '0',
					'hierarchical'      => true,					
					'get'               => '',
					);
					$terms = get_terms($args); // Get all terms of a taxonomy
					if ( $terms && !is_wp_error( $terms ) ) :
					$i=0;
					foreach ( $terms as $term_parent ) {
						if($term_parent->count>0){
							$cate_main_image = get_option('epjbcate_main_image_'.$term_parent->term_id);
							if($cate_main_image!=''){
								$feature_img=wp_get_attachment_url($cate_main_image);
								}else{
								$feature_img=cleanup_ep_URLPATH."/assets/images/default-directory.jpg";
							}
							$cat_link= get_term_link($term_parent , $cleanup_directory_url.'-category');
						?>
						<div class="col-md-4 col-lg-3 mb-5">
							<div class="img_overlay_container">
								<div class="img_overlay rounded "></div>
								<a href="<?php echo esc_url($cat_link); ?>">
									<img   src="<?php echo esc_url($feature_img);?>" class="rounded w-100 img-fluid ">
								</a>
								<h6 class="cities_title text-center text-white"><?php echo esc_html($term_parent->name); ?> <small class="text-white text-break">( <?php echo esc_html($term_parent->count); ?> )</small></h6>
							</div>
						</div>
						<?php
						}
					}
					endif;
				?>
			</div>
		</div>
	</section>
</section>
<?php
	wp_reset_query();
?>