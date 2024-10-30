<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	wp_enqueue_style('fontawesome-browser', cleanup_ep_URLPATH . 'admin/files/css/fontawesome-browser.css');	
wp_enqueue_style('all-font-awesome', 			cleanup_ep_URLPATH . 'admin/files/css/fontawesome.css');
wp_enqueue_script( 'cleanup_meta-image', cleanup_ep_URLPATH . 'admin/files/js/meta-media-uploader.js', array( 'jquery' ) );		
		
		
	$cleanup_directory_url=get_option('cleanup_ep_url');
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	
	$active_single_fields_saved=get_option('cleanup_single_fields_saved' );	
	$active_single_icon_saved=get_option('cleanup_single_icon_saved' );	
	
	if($active_single_fields_saved==''){
		$active_single_fields=array();
		$active_single_fields=cleanup_get_listing_fields_all_single();
		
	}else{
		$active_single_fields=array();
		$active_single_fields=$active_single_fields_saved;
	}
	$available_fields=array();
	$available_fields=cleanup_get_listing_fields_all_single();
	
?> 

<div class="row">
	<div class="col-12">	
	</div>
</div>	
<div class="row">		
	<div class="col-md-6 col-sm-12 col-lg-6">	
		<form id="active_single_template_fields" name="active_single_template_fields"  >
	
		<p ><strong><?php esc_html_e('Active Fields','cleanup');?></strong> </p>
			
			<ul id="searchfieldsActive" class="connectedSortable">	
				<?php
				$i=0;
					if(is_array($active_single_fields)){
						foreach($active_single_fields  as $field_key => $field_value){
							if($field_key!=''){
							
							$saved_icon='';
							if(isset($active_single_icon_saved[$field_key])){
								$saved_icon=$active_single_icon_saved [$field_key];
							}
							?>
							<li class="ui-state-default">
								<div class="row">
									<div class="col-md-12 col-lg-6">
										<?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
										<button type="button" class="btn-icon mb-1"  onclick="cleanup_icon_uploader('field_icon_single<?php echo esc_attr($i); ?>');" ><?php esc_html_e('Icon','cleanup'); ?></button>
									</div>
									<div class="col-md-12 col-lg-6">
										<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_html($field_key);?>">										
									<input type="text" name="field_icon[]" id="field_icon_single<?php echo esc_attr($i); ?>"  class="form-control" placeholder=""  value="<?php echo esc_attr($saved_icon); ?>" />
									</div>									
								</div>	
							</li>				
							<?php
								$i++;
							}
						}
					}
				?>			
			</ul>
	</form>
	</div>
	
	

	<div class="col-md-6 col-sm-12 col-lg-6">	
		<p class="text-left"> <strong><?php esc_html_e('Available Fields','cleanup');?> </strong> </p >
		<ul id="searchfieldsAvailable" class="connectedSortable">  	
			<?php
				if(is_array($available_fields)){
					foreach($available_fields  as $field_key => $field_value){ 
						if(!array_key_exists($field_key,$active_single_fields)){
						?>
						<li class="ui-state-default">
							<div class="row">
								<div class="col-md-12 col-lg-6">
									<?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
									<button type="button" class="btn-icon mb-1"  onclick="cleanup_icon_uploader('field_icon_single<?php echo esc_attr($i); ?>');" ><?php esc_html_e('Icon','cleanup'); ?></button>	
								</div>
								<div class="col-md-12 col-lg-6">
									<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_html($field_key);?>">
									<input type="text" name="field_icon[]"  id="field_icon_single<?php echo esc_attr($i); ?>"  class="form-control" placeholder="" />
								</div>
							</div>	
						</li>				
						<?php
							$i++;
						}
					}
				}
			?>
		</ul>
	</div>
</div>
<div class="row bottom20 " >					
	<div class="col-md-12">	
		<div id="success_message-single-fields"></div>														
		<button class="button button-primary" onclick="return cleanup_update_single_fields();"><?php esc_html_e( 'Save', 'cleanup' );?> </button>
		
		
	</div>
</div>