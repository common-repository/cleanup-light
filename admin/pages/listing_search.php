<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	$cleanup_directory_url=get_option('cleanup_ep_url');
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	
	$active_search_fields_saved=get_option('cleanup_search_fields_saved' );	
	if($active_search_fields_saved==''){
		$active_search_fields=array();
		$active_search_fields[$cleanup_directory_url.'-category']='multi-checkbox';
		$active_search_fields[$cleanup_directory_url.'-tag']='multi-checkbox';
		$active_search_fields[$cleanup_directory_url.'-locations']='drop-down';
		$active_search_fields['near_to_me']='text-field';
		$active_search_fields['title']='text-field';		
				
		
		
	}else{
		$active_search_fields=array();
		$active_search_fields=$active_search_fields_saved;
	}
	$available_fields=array();
	$available_fields[$cleanup_directory_url.'-category']='multi-checkbox';
	$available_fields[$cleanup_directory_url.'-tag']='multi-checkbox';
	$available_fields[$cleanup_directory_url.'-locations']='drop-down';
	$available_fields['near_to_me']='text-field';
	$available_fields['title']='text-field';
	$available_fields['city']='City';
	$available_fields['postcode']='Postcode';
	$available_fields['state']='State';
	$available_fields['country']='Country';	
	$available_fields['post_date']='datefield';
	$available_fields['sort_listing']='drop-down';
	$available_fields['review']='Review';
	
	$no_dropdown=array('near_to_me','address');
	$only_dropdown=array('sort_listing');
	$only_multi_checkbox=array('review');
	
	$new_field_set=	get_option('cleanup_li_fields' );
	
	if(is_array($new_field_set)){
		foreach($new_field_set  as $field_key => $field_value){
			$available_fields[$field_key]=$field_value;
		}
	}
	$args = array(
		'child_of'     => 0,
		'sort_order'   => 'ASC',
		'sort_column'  => 'post_title',
		'hierarchical' => 1,															
		'post_type' => 'page'
		);
	
?> 
<div class="row">
	<div class="col-md-12">	
	</div>
</div>
<div class="row">		
	<div class="col-md-6">	
		<p ><strong><?php esc_html_e('Active Fields','cleanup');?></strong> </p>
		<form id="search_active_fields" name="search_active_fields"  >
				<div class="form-group ">	
					<?php
					$cleanup_search_action_target=get_option('cleanup_search_action_target' );	
					?>								
						<label  class="  control-label"><?php esc_html_e( 'Form Submit Action Terget:', 'cleanup' );?> </label>
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='cleanup_search_action_target' name='cleanup_search_action_target' class='form-control  '>";
							echo "<option value='same_page' ".($cleanup_search_action_target=='same_page' ? 'selected':'').">".esc_html__( 'Same Page', 'cleanup' )."</option>";
							
							echo "<option value='default_archive' ".($cleanup_search_action_target=='default_archive' ? 'selected':'').">".esc_html__( 'Default Archive Page', 'cleanup' )."</option>";
							
							foreach ( $pages as $page ) {
								if($page->post_title!=''){
								echo "<option value='".esc_attr($page->ID)."'". ($cleanup_search_action_target==$page->ID ? 'selected':'').">".esc_html($page->post_title)."</option>";
								
								}
							}
							echo "</select>";
						}
						?>
				</div>				
			<ul id="searchfieldsActive" class="connectedSortable">	
				<?php
					if(is_array($active_search_fields)){
						foreach($active_search_fields  as $field_key => $field_value){
							if($field_key!=''){
							?>
							<li class="ui-state-default">
								<div class="row">
									<div class="col-md-12 col-lg-6">
											<?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
									</div>
									<div class="col-md-12 col-lg-6">
											<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_attr($field_key);?>">
											<?php
											if(in_array($field_key ,$no_dropdown)){?>
											<select class="form-control" id="search-field-type" name="search-field-type[]">							
													<option value="text-field"><?php esc_html_e('text-field','cleanup');?> </option>
												</select>
											<?php
											}elseif(in_array($field_key ,$only_multi_checkbox)){?>
												<select class="form-control" id="search-field-type" name="search-field-type[]">	
													<option value="multi-checkbox" <?php echo ($field_value=='multi-checkbox'? 'selected' :''); ?>> <?php esc_html_e('Multi Checkbox','cleanup');?> </option>  										
												</select>
											<?php
											}elseif(in_array($field_key ,$only_dropdown)){?>
												<select class="form-control" id="search-field-type" name="search-field-type[]">	
													<option value="drop-down"> <?php esc_html_e('Drop Down','cleanup');?> </option> 										
												</select>
											<?php
											}else{
											?>
											<select class="form-control" id="search-field-type" name="search-field-type[]">								
												<option value="text-field" <?php echo ($field_value=='text-field'? 'selected' :''); ?>> <?php esc_html_e('Text Field','cleanup');?> </option> 
												<option value="drop-down" <?php echo ($field_value=='drop-down'? 'selected' :''); ?> > <?php esc_html_e('Drop Down','cleanup');?> </option> 										
												<option value="multi-checkbox" <?php echo ($field_value=='multi-checkbox'? 'selected' :''); ?>> <?php esc_html_e('Multi Checkbox','cleanup');?> </option> 
												<?php	
												if($field_key==$cleanup_directory_url.'-category' OR $field_key==$cleanup_directory_url.'-tag' OR $field_key==$cleanup_directory_url.'-locations'){?>
													<option value="multi-checkbox-group" <?php echo ($field_value=='multi-checkbox-group'? 'selected' :''); ?>> <?php esc_html_e('Multi Checkbox-Sub-Group','cleanup');?> </option> 
												
												<?php
												}
												?>
												
												<option value="datefield" <?php echo ($field_value=='datefield'? 'selected' :''); ?>> <?php esc_html_e('Date','cleanup');?> </option> 
											</select>
											<?php
											}
											?>
									</div>									
								</div>	
							</li>				
							<?php
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
						if(!array_key_exists($field_key,$active_search_fields)){
						?>
						<li class="ui-state-default">
						<div class="row">
							<div class="col-md-12 col-lg-6">
								<?php echo esc_html(ucfirst(str_replace('_',' ',$field_key))); ?>
							</div>
							<div class="col-md-12 col-lg-6">
								<input type="hidden" name="search-field-name[]" id="search-field-name" value="<?php echo esc_html($field_key);?>">
								<?php
								if(in_array($field_key ,$no_dropdown)){
									?>
									<select class="form-control" id="search-field-type" name="search-field-type[]">							
											<option value="text-field"><?php esc_html_e('text-field','cleanup');?> </option>
									</select>
								
								<?php
								}elseif(in_array($field_key ,$only_multi_checkbox)){?>
										<select class="form-control" id="search-field-type" name="search-field-type[]">	
											<option value="multi-checkbox" <?php echo ($field_value=='multi-checkbox'? 'selected' :''); ?>> <?php esc_html_e('Multi Checkbox','cleanup');?> </option>  										
										</select>
								<?php
								}elseif(in_array($field_key ,$only_dropdown)){?>
										<select class="form-control" id="search-field-type" name="search-field-type[]">	
											<option value="drop-down"> <?php esc_html_e('Drop Down','cleanup');?> </option> 										
										</select>
									<?php
								}else{
								?>
								<select class="form-control" id="search-field-type" name="search-field-type[]">								
									<option value="text-field"> <?php esc_html_e('Text Field','cleanup');?> </option> 
									<option value="drop-down"> <?php esc_html_e('Drop Down','cleanup');?> </option>
									<option value="multi-checkbox"> <?php esc_html_e('Multi Checkbox','cleanup');?> </option> 
									<?php	
										if($field_key==$cleanup_directory_url.'-category' OR $field_key==$cleanup_directory_url.'-tag' OR $field_key==$cleanup_directory_url.'-locations'){?>
											<option value="multi-checkbox-group" <?php echo ($field_value=='multi-checkbox-group'? 'selected' :''); ?>> <?php esc_html_e('Multi Checkbox-Sub-Group','cleanup');?> </option> 
										
										<?php
										}
										?>
									<option value="datefield"> <?php esc_html_e('Date','cleanup');?> </option> 
								</select>
								<?php
								}
								?>
							</div>							
						</div>						
						</li>				
						<?php
						}
					}
				}
			?>
		</ul>
	</div>
</div>
<div class="row bottom20 " >					
	<div class="col-md-12">	
		<div id="success_message-search-fields"></div>														
		<button class="button button-primary" onclick="return cleanup_update_search_fields();"><?php esc_html_e( 'Save', 'cleanup' );?> </button>
		<button class="button button-primary" onclick="return cleanup_create_search_shortcode();"><?php esc_html_e( 'Get Shortcode', 'cleanup' );?> </button>
		<form name="savedsearch_shortcodes" id="savedsearch_shortcodes">
			<h4><?php esc_html_e( 'Previously generated shortcodes:', 'cleanup' );?> </h4>
			<div id="create_search_shortcode_update_message"></div>
			<div id="create_search_shortcode">
			
			<?php
				
				$cleanup_search_shortcodes_saved=get_option('cleanup_search_shortcodes_saved' );	
				
				$i=0;
				if(is_array($cleanup_search_shortcodes_saved )){
					foreach($cleanup_search_shortcodes_saved  as $field_key => $field_value ){
						if($field_value!=''){?>
						<div class="row " id="searchshortcode<?php echo esc_attr($i); ?>" >
							
								<input name="shortcodearr[]" type="hidden" value='<?php echo esc_attr($field_value); ?>'>
								<?php
								echo'<div class="col-md-11" id="searchshortcodedata'.esc_attr($i).'">'.esc_html($field_value).'</div><div class="col-md-1"><span onclick="return cleanup_remove_saved_shortcode('.esc_attr($i).')" class="dashicons dashicons-trash"></span></div>';
						?>
							
						</div><hr/>
						<?php
						$i++;
						}
					}
				}
			?>
			
			
			</div>	
		</form>
	</div>
</div>