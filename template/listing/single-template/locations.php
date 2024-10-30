<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class=" border-bottom pb-15 mb-3 toptitle"><i class="<?php echo esc_html($saved_icon); ?>"></i> <?php esc_html_e('Locations', 'cleanup'); ?></div>
<div class="row    mb-4">
	<?php
		$tag_array= wp_get_object_terms( $listingid,  $cleanup_directory_url.'-locations');
		$i=0;
		foreach($tag_array as $one_tag){	
		?>	
		<div class="col-md-6 mt-3">
		
		<a href="<?php echo get_tag_link($one_tag->term_id); ?>" class="  mr-1 mt-1"><i class="fa-solid fa-location-dot mr-2 "></i> <?php echo esc_attr($one_tag->name); ?></a>
		</div>
		<?php
		$i++;
		}	
	?>
</div>
	