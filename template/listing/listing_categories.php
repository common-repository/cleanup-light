<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	wp_enqueue_style('bootstrap', cleanup_ep_URLPATH . 'admin/files/css/iv-bootstrap.css');
	wp_enqueue_style('cleanup_categories', cleanup_ep_URLPATH . 'admin/files/css/categories.css');
	global $post,$wpdb,$tag;
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
<section class="bootstrap-wrapper background-transparent">
	<div class="container ">
		<div class="row justify-content-center">
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
						$cate_main_image = get_term_meta($term_parent->term_id, 'cleanup_term_image', true); 
						if($cate_main_image!=''){
							$feature_img=$cate_main_image;
							}else{									
							if(get_option('cleanup_category_defaultimage')!=''){
								$feature_img= wp_get_attachment_image_src(get_option('cleanup_category_defaultimage'));
								if(isset($feature_img[0])){									
									$feature_img=$feature_img[0] ;
								}
								}else{
								$feature_img=cleanup_ep_URLPATH."/assets/images/category.png";
							}
						}
						$cat_link= get_term_link($term_parent , $cleanup_directory_url.'-category');
					?>
					
					
				<div class="col-xl-4 col-lg-4 col-md-6  col-sm-6 col-12  mt-4 mb-4" id="<?php echo esc_html($i); ?>" >
					<div class=" card-border-round mb-2 " >										
						
							<div class="card-img-container">
								<a href="<?php echo esc_url($cat_link);?>"><img src="<?php echo esc_url($feature_img);?>" class="card-img-top-listing">					
									</a>
							</div>	
							
						<div class="card-body  ">
							<h4 class="cat_title"><?php echo esc_html($term_parent->name);?></h4>
						</div>
								
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
<?php	
	wp_reset_query();
?>