<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
wp_enqueue_style('fontawesome-browser', cleanup_ep_URLPATH . 'admin/files/css/fontawesome-browser.css');	
wp_enqueue_style('all-font-awesome', 			cleanup_ep_URLPATH . 'admin/files/css/fontawesome.css');
wp_enqueue_script( 'cleanup_meta-image', cleanup_ep_URLPATH . 'admin/files/js/meta-media-uploader.js', array( 'jquery' ) );		
		
	$cleanup_directory_url=get_option('cleanup_ep_url');
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	
	$active_archive_fields=cleanup_get_archive_fields_all();	
	$active_archive_icon_saved=get_option('cleanup_archive_icon_saved' );		
	$available_fields=cleanup_get_listing_fields_all();	

?> 
<div class="row">
	<div class="col-12">	
	</div>
</div>	
<div class="row">		
	<div class="col-md-6">	
		<p ><strong><?php esc_html_e('Active Fields','cleanup');?></strong> </p>
		<form id="search_active_archive_fields" name="search_active_archive_fields"  >	
			<ul id="searchfieldsActive" class="connectedSortable">	
				
				<?php
				$i=0;
				if(is_array($active_archive_fields)){
					foreach($active_archive_fields  as $field_key => $field_value){
						if($field_key!=''){
							$saved_icon='';
							if(isset($active_archive_icon_saved[$field_key])){
								$saved_icon=$active_archive_icon_saved[$field_key];
							}
						?>
						<li class="ui-state-default">
							<div class="row">
								<div class="col-md-12 col-lg-6">
									<?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
									<?php
									if( $field_key!='category' AND $field_key!='top_search_form'){
										?>	
										<button type="button" class=" btn-icon mb-1" onclick="cleanup_icon_uploader('field_icon<?php echo esc_attr($i); ?>');"><?php esc_html_e('Icon','cleanup'); ?></button>
									<?php
									}
									?>
								</div>
								<div class="col-md-12 col-lg-6">															
										<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_html($field_key);?>">
										<?php
										if( $field_key=='category'){
											?>									
											<input type="text" name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>"  readonly class="form-control"   value="<?php esc_html_e('Collect from category','cleanup'); ?>" />								
										<?php
										}elseif( $field_key=='top_search_form'){
										?>									
											<select name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>" class="form-control">
												<option value="popup" <?php echo ($saved_icon=='popup'?' selected':''); ?>><?php esc_html_e('Popup/Modal Search','cleanup'); ?></option>
												<option value="on-page" <?php echo ($saved_icon=='on-page'?' selected':''); ?>><?php esc_html_e('Search Form on the page','cleanup'); ?></option>
												<option value="no-search" <?php echo ($saved_icon=='no-search'?' selected':''); ?>><?php esc_html_e('No Search Form Option','cleanup'); ?></option>
											</select>
											
										
										<?php
										}else{
										?>	
										<input type="text" name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>"  class="form-control" placeholder=""  value="<?php echo esc_attr($saved_icon); ?>" />
										<?php
										}
										?>
								
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
	<div class="col-md-6">	
		<p class="text-left"> <strong><?php esc_html_e('Available Fields','cleanup');?> </strong> </p >
		<ul id="searchfieldsAvailable" class="connectedSortable">  	
			<?php
				if(is_array($available_fields)){
					foreach($available_fields  as $field_key => $field_value){ 
						if(!array_key_exists($field_key,$active_archive_fields)){
						?>
						<li class="ui-state-default">
							
							<div class="row">
								<div class="col-md-12 col-lg-6">	
									<?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
									<?php
										if( $field_key!='category' AND $field_key!='top_search_form'){
											?>							
											<button type="button" class="btn-icon mb-1" onclick="cleanup_icon_uploader('field_icon<?php echo esc_attr($i); ?>');"><?php esc_html_e('Icon','cleanup'); ?></button>
									<?php
										}
									?>									
								</div>
								<div class="col-md-12 col-lg-6">
									<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_html($field_key);?>">
									<?php
									if( $field_key=='category'){
										?>									
										<input type="text" name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>" readonly class="form-control"   value="<?php esc_html_e('Collect from category','cleanup'); ?>" />
									
									<?php
									}elseif( $field_key=='top_search_form'){
									?>									
										<select name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>" class="form-control">
											<option value="popup" selected ><?php esc_html_e('Popup/Modal Search','cleanup'); ?></option>
											<option value="on-page" ><?php esc_html_e('Search Form on The Page','cleanup'); ?></option>
											<option value="no-search" ><?php esc_html_e('No Search Form Option','cleanup'); ?></option>
										</select>
									<?php
									}else{
									?>	
									<input type="text" name="field_icon[]" id="field_icon<?php echo esc_attr($i); ?>"  class="form-control" placeholder=""  value="" />
									<?php
									}
									?>
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
		<div id="success_message-archive-fields"></div>														
		<button class="button button-primary" onclick="return cleanup_update_archive_fields();"><?php esc_html_e( 'Save', 'cleanup' );?> </button>
	</div>
</div>