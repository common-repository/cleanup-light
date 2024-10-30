<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="row">
	<?php
		$gallery_ids=get_post_meta($listingid ,'image_gallery_ids',true);
		$gallery_ids_array = array_filter(explode(",", $gallery_ids));
		$i=1;
		foreach($gallery_ids_array as $slide){
			if($slide!=''){ ?>
			<div class=" p-2  col-md-3 ">
				<a data-fancybox="gallery" href="<?php echo esc_url(wp_get_attachment_url( $slide )); ?>">
					<img class="img-fluid rounded float" src="<?php echo esc_url(wp_get_attachment_url( $slide )); ?>" >
				</a>
			</div>
			<?php
				$i++;
			}
		}
		//image_gallery_urls
		$gallery_urls=get_post_meta($listingid ,'image_gallery_urls',true);
		$gallery_urls_array = array_filter(explode(",", $gallery_urls));
		foreach($gallery_urls_array as $slide){
			if($slide!=''){ ?>
			<div class="p-2  col-md-3">
				<a data-fancybox="gallery" href="<?php echo esc_attr($slide); ?>">
					<img class="img-fluid rounded float" src="<?php echo esc_url($slide); ?>">
				</a>
			</div>
			<?php
				$i++;
			}
		}
	?>
</div>
