<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class=" border-bottom pb-15 mb-3 toptitle"><i class="<?php echo esc_html($saved_icon); ?>"></i> <?php esc_html_e('Attachments', 'cleanup'); ?></div>
<div class=" row  mb-4 "> 
	<div class="cleanup-attachments col-md-12">
	<?php
	$attached_ids=get_post_meta($listingid ,'attached_ids',true);
	$attached_ids_array = array_filter(explode(",", $attached_ids));	
		if(is_array($attached_ids_array)){
				foreach($attached_ids_array as $slide){
					$filename_only = basename( get_attached_file( $slide ) );					
				?>				
				<a class="cleanup-attachment" href="<?php echo esc_url(wp_get_attachment_url( $slide )); ?>" target="_blank">
					<div class="cleanup-attachment__icon">
						<img src="<?php echo esc_url(cleanup_ep_URLPATH.'assets/images/pdf.svg');?>">
					</div>
					<?php echo esc_html($filename_only); ?>               
				</a>
								
				<?php
				}
			}
		?>			
	</div>
</div>
