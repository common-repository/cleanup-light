<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	wp_enqueue_style('flexslider', cleanup_ep_URLPATH . 'admin/files/css/flexslider.css');
?>	<div id="cleanup-slider" class="flexslider">
	  <ul class="slides">
	   <?php
			$gallery_ids=get_post_meta($listingid ,'image_gallery_ids',true);
			$gallery_ids_array = array_filter(explode(",", $gallery_ids));
			$i=1;
			foreach($gallery_ids_array as $slide){
				if($slide!=''){ ?>
					<li>
						<img class="slider-top-img" src="<?php echo esc_url(wp_get_attachment_url( $slide )); ?>" />
					</li>					
				<?php
					$i++;
				}
			}			
		?>				
	  </ul>
	</div>
	<div id="cleanup-carousel" class="flexslider">
	  <ul class="slides">
	   <?php			
			foreach($gallery_ids_array as $slide){
				if($slide!=''){ ?>
					<li>
					<img class="carousel-img" src="<?php echo esc_url(wp_get_attachment_url( $slide )); ?>" />
					</li>					
				<?php
					$i++;
				}
			}			
		?>				
	  </ul>
	</div>

<?php
wp_enqueue_script('jquery.flexslider', cleanup_ep_URLPATH . 'admin/files/js/jquery.flexslider.js"');
wp_enqueue_script('jquery.easing', cleanup_ep_URLPATH . 'admin/files/js/jquery.easing.js"');
wp_enqueue_script('jquery.mousewheel', cleanup_ep_URLPATH . 'admin/files/js/jquery.mousewheel.js"');
wp_enqueue_script('cleanup-single-listing-flexslider', cleanup_ep_URLPATH . 'admin/files/js/flexslider-single-listing.js"');
?>