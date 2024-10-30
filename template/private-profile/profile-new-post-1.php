<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	$dir_map_api=get_option('cleanup_map_api');	
	if($dir_map_api==""){$dir_map_api='';}	
	$cleanup_directory_url=get_option('cleanup_ep_url');					
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	$map_api_have='no';				
	global $wpdb;
	// Check Max\
	$max=999999;							 
	 
	?>					
	<div class="row">
		<div class="col-md-12">	 
			<form action="" id="new_post" name="new_post"  method="POST" role="form">
				<div class=" form-group">
					<label for="text" class=" control-label"><?php  esc_html_e('Title','cleanup'); ?></label>
					<div class="  "> 
						<input type="text" class="form-control" name="title" id="title" value="" placeholder="<?php  esc_html_e('Enter Title Here','cleanup'); ?>">
					</div>																		
				</div>
				
				<input type="hidden" name="feature_image_id" id="feature_image_id" value="">
				
				<div class=" form-group row">	
						<div class="col-md-6" id="post_image_div">				
						</div> 
						
						<div class="col-md-6" id="post_image_edit">	
							<button type="button" onclick="cleanup_edit_post_image('post_image_div');"  class="btn btn-small-ar"><?php  esc_html_e('Company Logo[best fit 450X350]','cleanup'); ?> </button>
						</div>									
				</div>
				
				<div class=" form-group row">																
					<div class=" col-md-6" id="post_image_topbaner">
					</div> 
					<div class=" form-group col-md-6">											
							<div class="" id="topbanner_image_edit">
							
								<button type="button" onclick="cleanup_topbanner_image('post_image_topbaner');"  class="btn btn-small-ar"><?php  esc_html_e('Top Banner[best fit 1200X400]','cleanup'); ?> </button>
							</div>									
					</div>								
				</div>	
			
			
			<input type="hidden" name="topbanner_image_id" id="topbanner_image_id" value="">	
				<div class="form-group">
					<label for="text" class="control-label"><?php  esc_html_e('listing Description','cleanup'); ?>  </label>
					<?php
						$settings_a = array(															
						'textarea_rows' =>8,
						'editor_class' => 'form-control'															 
						);
						$editor_id = 'new_post_content';
						wp_editor( '', $editor_id,$settings_a );										
					?>
				</div>
				
									
				
				
				<div class="  form-group ">
					<label for="text" class="  control-label"><?php  esc_html_e('Status','cleanup'); ?>  </label>
					<select name="post_status" id="post_status"  class="form-control">
						<?php
								echo '**************'.$cleanup_user_can_publish=get_option('cleanup_user_can_publish');	
								if($cleanup_user_can_publish==""){$cleanup_user_can_publish='yes';}	
								if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){?>
								<option value="publish"><?php esc_html_e('Publish','cleanup'); ?></option>
								<?php
								}
								if(isset($current_user->roles[0]) and $current_user->roles[0]!='administrator'){
									if($cleanup_user_can_publish=="yes"){
									?>
									<option value="publish"><?php esc_html_e('Publish','cleanup'); ?></option>
									<?php
									}
								}
							?>											
						<option value="pending"><?php esc_html_e('Pending Review','cleanup'); ?></option>
						<option value="draft" ><?php esc_html_e('Draft','cleanup'); ?></option>	
					</select>	
				</div>										
				
				<div class="row">
					<div class=" col-md-6 form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Price','cleanup'); ?></label>
						<input type="text" class="form-control" name="price" id="price" value="" placeholder="<?php  esc_html_e('Enter Price ','cleanup'); ?>">
					</div>
					<div class="col-md-6  form-group">
						<label for="text" class=" control-label"><?php  esc_html_e('Discount Price','cleanup'); ?></label>
						<input type="text" class="form-control" name="discount" id="discount" value="" placeholder="<?php  esc_html_e('Enter Discount Price','cleanup'); ?>">								
					</div>
				</div>	
				
				<span class="caption-subject">														
					<?php  esc_html_e('Contact Info','cleanup'); ?>
				</span>
				<hr/>
				<?php
				
					$listing_contact_source='';
					if($listing_contact_source==''){$listing_contact_source='user_info';}
				?>
				<div class=" form-group">	
					<div class="radio">											
						<label><input type="radio" name="contact_source" value="user_info"  class="mr-1" <?php echo ($listing_contact_source=='user_info'?'checked':''); ?> > <?php  esc_html_e(' Use The company Info ->','cleanup'); ?> <?php echo ucfirst($current_user->display_name); ?><?php  esc_html_e(' : Logo, Email, Phone, Website','cleanup'); ?> <a href="<?php echo get_permalink().'?profile=setting';?>" target="_blank"> <?php  esc_html_e('Edit','cleanup'); ?> </a></label>
					</div>
					<div class="radio">
						<label><input type="radio" name="contact_source" value="new_value" class="mr-1" <?php echo ($listing_contact_source=='new_value'?'checked':''); ?>><?php  esc_html_e(' New Contact Info','cleanup'); ?>  </label>
					</div>
				</div>
				<div  class="row" id="new_contact_div" <?php echo ($listing_contact_source=='user_info'?'style="display:none"':''); ?> >
					
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Company Name','cleanup'); ?></label>						
						<input type="text" class="form-control" name="company_name" id="company_name" value="" placeholder="<?php  esc_attr_e('Company name','cleanup'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Phone','cleanup'); ?></label>						
						<input type="text" class="form-control" name="phone" id="phone" value="" placeholder="<?php  esc_attr_e('Enter Phone Number','cleanup'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Whats Up','cleanup'); ?></label>						
						<input type="text" class="form-control" name="whatsapp" id="whatsapp" value="" placeholder="<?php  esc_attr_e('Enter whats up Number','cleanup'); ?>">
					</div>
					
					
					
					<div class=" form-group col-md-12">
						<label for="text" class=" control-label"><?php  esc_html_e('Address autocomplete helper','cleanup'); ?></label>
						<div id="map"></div>
						<div id="search-box"></div>

						<div id="result"></div>
					</div>
					<div class=" form-group col-md-12">
						<label for="text" class=" control-label"><?php  esc_html_e('Address (Save in the listing field)','cleanup'); ?></label>						
						<input type="text" class="form-control" name="address" id="address" value=""  placeholder="<?php  esc_html_e('Enter Address','cleanup'); ?>">
					</div>
				
				
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('city','cleanup'); ?></label>
						<input type="text" class="form-control" name="city" id="city" value="" placeholder="<?php  esc_attr_e('Enter city','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('State','cleanup'); ?></label>
						<input type="text" class="form-control" name="state" id="state" value="" placeholder="<?php  esc_attr_e('Enter State','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Zipcode/Postcode','cleanup'); ?></label>
						<input type="text" class="form-control" name="postcode" id="postcode" value="" placeholder="<?php  esc_attr_e('Enter Zipcode/Postcode','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Country','cleanup'); ?></label>
						<input type="text" class="form-control" name="country" id="country" value="" placeholder="<?php  esc_attr_e('Enter Country','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
					<label for="text" class=" control-label"><?php  esc_html_e('Latitude ','cleanup'); ?></label>
					<input type="text" class="form-control" name="latitude" id="latitude" value="" placeholder="<?php  esc_attr_e('Enter Latitude','cleanup'); ?>">
				</div>	
					<div class=" form-group col-md-6">
					<label for="text" class=" control-label"><?php  esc_html_e('Longitude','cleanup'); ?></label>
					<input type="text" class="form-control" name="longitude" id="longitude" value="" placeholder="<?php  esc_attr_e('Enter Longitude','cleanup'); ?>">
				</div>	
					
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Email Address','cleanup'); ?></label>
						<input type="text" class="form-control" name="contact-email" id="contact-email" value="" placeholder="<?php  esc_attr_e('Enter Email Address','cleanup'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Web Site','cleanup'); ?></label>
						<input type="text" class="form-control" name="contact_web" id="contact_web" value="" placeholder="<?php  esc_attr_e('Enter Web Site','cleanup'); ?>">
					</div>
				</div>	
				
				
				<hr/>
				<div class="clearfix"></div>
				<span class="caption-subject">												
					<?php  esc_html_e('Categories','cleanup'); ?>
				</span>
				<hr/>
				
					<div class=" form-group row"  id="cleanupcats-container">																	
						<?php $selected='';
						
							
							//listing
							$taxonomy = $cleanup_directory_url.'-category';
							$args = array(
							'orderby'           => 'name', 
							'order'             => 'ASC',
							'taxonomy'   => 	$taxonomy ,
							'hide_empty'        => false, 
							'exclude'           => array(), 
							'exclude_tree'      => array(), 
							'include'           => array(),
							'number'            => '', 
							'fields'            => 'all', 
							'slug'              => '',
						
							'hierarchical'      => true, 
							'child_of'          => 0,
							'childless'         => false,
							'get'               => '', 
							);
							$terms = get_terms($args); // Get all terms of a taxonomy
							if ( $terms && !is_wp_error( $terms ) ) :
							$i=0;
							foreach ( $terms as $term_parent ) {  ?>												
							<?php  
							if($term_parent->name!=''){	
							?>	
								<div class="col-md-6">
									<label class="form-group "> <input type="checkbox" name="postcats[]" id="postcats"  value="<?php echo esc_attr($term_parent->slug); ?>" class="cleanupcats-fields" > <?php echo esc_html($term_parent->name); ?> </label>
								</div>
							<?php
							}
								$i++;
							} 								
							endif;	
							
						?>	
							
						<div class="col-md-12">
							<input type="text" class="form-control" name="new_category" id="new_category" value="" placeholder="<?php  esc_html_e('Enter New Categories: Separate with commas','cleanup'); ?>">
						</div>		
						
					</div>
					
				<div class="clearfix"></div>
				<span class="caption-subject">												
					<?php  esc_html_e('Tags','cleanup'); ?>
				</span>
				<hr/>
				
				<div class=" row">		
				<?php
					$args2 = array(
					'type'                     => $cleanup_directory_url,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $cleanup_directory_url.'-tag',
					'pad_counts'               => false
					);
					$main_tag = get_categories( $args2 );	
					$tags_all= '';													
					if ( $main_tag && !is_wp_error( $main_tag ) ) :
					foreach ( $main_tag as $term_m ) {
					?>
					<div class="col-md-6">
						<label class="form-group"> 
							<input type="checkbox" name="tag_arr[]" id="tag_arr[]"  value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>  
					</div>
					<?php	
					}
					endif;	
				?>
				</div>
				<div class=" form-group">	
						<input type="text" class="form-control" name="new_tag" id="new_tag" value="" placeholder="<?php  esc_html_e('Enter New Tags: Separate with commas','cleanup'); ?>">
				</div>															
				<div class="clearfix"></div>
				<span class="caption-subject">												
					<?php  esc_html_e('Locations','cleanup'); ?>
				</span>
				<hr/>
				
				<div class=" row mb-3">		
				<?php
					$args2 = array(
					'type'                     => $cleanup_directory_url,
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 0,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => $cleanup_directory_url.'-locations',
					'pad_counts'               => false
					);
					$main_tag = get_categories( $args2 );	
					$tags_all= '';													
					if ( $main_tag && !is_wp_error( $main_tag ) ) :
					foreach ( $main_tag as $term_m ) {
					?>
					<div class="col-md-6">
						<label class="form-group"> 
							<input type="checkbox" name="location_arr[]" id="location_arr"  value="<?php echo esc_attr($term_m->slug); ?>"> <?php echo esc_html($term_m->name); ?> </label>  
					</div>
					<?php	
					}
					endif;	
				?>
						<div class="col-md-12">
							<input type="text" class="form-control" name="new_location" id="new_location" value="" placeholder="<?php  esc_html_e('Enter New Locations: Separate with commas','cleanup'); ?>">
						</div>															
						
				</div>
				<div class="clearfix"></div>	
				
			
				<span class="caption-subject">	
					<?php  esc_html_e('Videos ','cleanup'); ?>
				</span>
				
				<hr/>
			
					<div class="row">
						<div class=" col-md-6 form-group">
							<label for="text" class=" control-label"><?php  esc_html_e('Youtube','cleanup'); ?></label>
							<input type="text" class="form-control" name="youtube" id="youtube" value="" placeholder="<?php  esc_html_e('Enter Youtube video ID, e.g : bU1QPtOZQZU ','cleanup'); ?>">
						</div>
						<div class="col-md-6  form-group">
							<label for="text" class=" control-label"><?php  esc_html_e('vimeo','cleanup'); ?></label>
							<input type="text" class="form-control" name="vimeo" id="vimeo" value="" placeholder="<?php  esc_html_e('Enter vimeo ID, e.g : 134173961','cleanup'); ?>">								
						</div>
					</div>	
					
				<span class="caption-subject">											
					<?php  esc_html_e('Image Gallery','cleanup'); ?>
				</span>
				<hr/>
			
					<input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="">
					<div class="row" id="gallery_image_div">
					
					</div>									
				
				<div class="row">										
					<div class="  form-group col-md-12">									
						<button type="button" onclick="cleanup_edit_gallery_image('gallery_image_div');"  class="btn btn-small-ar mt-2"><?php  esc_html_e('Add Images','cleanup'); ?></button>
					</label>						
					</div>
				</div>
				
				<hr/>
				<span class="caption-subject">											
					<?php  esc_html_e('Attached Doc','cleanup'); ?>
					</span>
				<hr/>			
					<input type="hidden" name="attached_ids" id="attached_ids" value="">
					<div id="attached_div">
					
					</div>									
				
				<div class="row">										
					<div class="  form-group col-md-12">									
						<button type="button" onclick="cleanup_attached_doc('attached_div');"  class="btn btn-small-ar mt-2"><?php  esc_html_e('Add Attachments','cleanup'); ?></button>
					</label>						
					</div>
				</div>
								
				
				<hr/>
				<span class="caption-subject">	
					<?php  esc_html_e('More Details ','cleanup'); ?>
				</span>								
				<hr/>
				<div class="row" id="cleanup_fields">
					<?php							
							$post_cats=array();			
							echo ''.$main_class->cleanup_listing_fields(0, $post_cats );
						?>	
				</div>
				<span class="caption-subject">	
					<?php  esc_html_e('Business Hours ','cleanup'); ?>
				</span>									
				<hr/>
				<div class="">
					<?php							
						include( cleanup_ep_template. 'private-profile/listing-open-close-time.php');						
						?>		
				</div>
				<hr/>
			
				<span class="caption-subject">	
					<?php  esc_html_e('FAQs ','cleanup'); ?>
				</span>								
				<hr/>
				<div class="row">
					<?php							
						include( cleanup_ep_template. 'private-profile/profile-add-edit-faq.php');						
						?>		
				</div>
				<span class="caption-subject">												
					<?php  esc_html_e('Button Setting','cleanup'); ?>
				</span>
				<hr/>
				<?php											
					
					$dir_style5_email=get_option('dir_style5_email');	
					if($dir_style5_email==""){$dir_style5_email='yes';}
					if($dir_style5_email=="yes"){
						$dirpro_email_button='';
						if($dirpro_email_button==""){$dirpro_email_button='yes';}
					?>	
					<div class="form-group row ">
						<label  class="col-md-4 control-label"> <?php  esc_html_e('Contact Button','cleanup');  ?></label>
						<div class="col-md-3">
							<label>												
								<input type="radio" name="dirpro_email_button" id="dirpro_email_button" value='yes' class=" mr-1" <?php echo ($dirpro_email_button=='yes' ? 'checked':'' ); ?> ><?php  esc_html_e('Show','cleanup');  ?>
							</label>	
						</div>
						<div class="col-md-5">	
							<label>											
								<input type="radio"  name="dirpro_email_button" id="dirpro_email_button" class=" mr-1" value='no' <?php echo ($dirpro_email_button=='no' ? 'checked':'' );  ?> > <?php  esc_html_e('Hide','cleanup');  ?>
							</label>
						</div>	
					</div>		
					<?php
					}	
					?>
					
				
				
				<div class="clearfix"></div>	
				<div class="row">
					<div class="col-md-12  "> <hr/>
						<div class="" id="update_message"></div>
						<input type="hidden" name="user_post_id" id="user_post_id" value="0">
						<button type="button" onclick="cleanup_save_post();"  class="btn green-haze"><?php  esc_html_e('Save Post',	'cleanup'); ?></button>
						
					</div>	
					
				</div>	
			</form>
		</div>
	
	
				
		
<!-- END PROFILE CONTENT -->
<?php
	$save_address='';
	$my_theme = wp_get_theme();
	$theme_name= strtolower($my_theme->get( 'Name' ));
	wp_enqueue_script('cleanup_add-edit-listing', cleanup_ep_URLPATH . 'admin/files/js/add-edit-listing.js');
	wp_localize_script('cleanup_add-edit-listing', 'realpro_data', array(
	'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
	'loading_image'			=> '<img src="'.cleanup_ep_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'		=>get_current_user_id(),
	'Set_Feature_Image'	=> esc_html__('Set Feature Image','cleanup'),
	'Set_plan_Image'		=> esc_html__('Set plan Image','cleanup'),
	'Set_Event_Image'		=> esc_html__('Set Event Image','cleanup'),
	'Gallery_Images'		=> esc_html__('Gallery Images','cleanup'),
	'attached_doc'		=> esc_html__('Set Doc','cleanup'),
	'permalink'				=> get_permalink(),
	'save_address'			=> $save_address,
	'dirwpnonce'			=> wp_create_nonce("addlisting"),
	'theme_name'			=> $theme_name,
	) );
?> 