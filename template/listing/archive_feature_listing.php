<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
if ( $cleanup_query->have_posts() ) :
	while ( $cleanup_query->have_posts() ) : $cleanup_query->the_post();
	$id = get_the_ID();
	if(get_post_meta($id, 'cleanup_featured', true)=='featured'){
		$feature_img='';
		if(has_post_thumbnail()){ 
			$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
			if($feature_image[0]!=""){
				$feature_img =$feature_image[0];
			}
			}else{ 
			$feature_img= $defaul_feature_img;
		}
		$dir_data['title']=esc_html($post->post_title);
		$dir_data['dlink']=get_permalink($id);
		$dir_data['address']= get_post_meta($id,'address',true);										
		$dir_data['image']=  $feature_img;	
		$dir_data['locations']= '';								
		$dir_data['lat']=get_post_meta($id,'latitude',true);
		$dir_data['lng']=get_post_meta($id,'longitude',true);
		$dir_data['marker_icon']= $main_class->cleanup_get_categories_mapmarker($id,$cleanup_directory_url);
		$ins_lat=get_post_meta($id,'latitude',true);
		$ins_lng=get_post_meta($id,'longitude',true);
		$cat_link='';$cat_name='';$cat_slug='';
		// VIP
		$post_author_id= $cleanup_query->post->post_author;	
		$current_date=time();
	?>						
	
		<?php
				include( cleanup_ep_template. 'listing/single-template/archive-grid-block.php');
			?>	
		<?php
		array_push( $dirs_data, $dir_data );
		$i++;
	}
	endwhile;
						
 endif;

wp_reset_query();
