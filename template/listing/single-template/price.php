<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	if(get_post_meta($listingid, 'price', true)!=''){ 
?>
<div class=" border-bottom pb-15 mb-3 toptitle"><i class="<?php echo esc_html($saved_icon); ?>"></i> <?php esc_html_e('Price', 'cleanup'); ?></div>
<div class=" row  mb-4 "> 
	<div class=" col-md-12">
	<?php if(get_post_meta($listingid, 'discount', true)!=''){ ?>
			<strike><?php echo esc_html( get_post_meta($listingid, 'price', true) ); ?></strike>
			<span class="ml-1"><?php echo esc_html( get_post_meta($listingid, 'discount', true) ); ?></span>
		<?php
			}else{ ?>
			<?php echo esc_html( get_post_meta($listingid, 'price', true) ); ?>											
		<?php	
			}
		?>	
	</div>
</div>
<?php
}
?>
