<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php	
	global $wpdb, $post;
	global $current_user;	
	$main_class = new cleanup_eplugins;
	wp_enqueue_script("jquery");
	wp_enqueue_style('jquery-ui', cleanup_ep_URLPATH . 'admin/files/css/jquery-ui.css');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('bootstrap', cleanup_ep_URLPATH . 'admin/files/css/iv-bootstrap.css');
	wp_enqueue_style('cleanup-my-account-css', cleanup_ep_URLPATH . 'admin/files/css/my-account.css');
	wp_enqueue_style('cleanup-my-account-new-css', cleanup_ep_URLPATH . 'admin/files/css/my-account-new.css');
	wp_enqueue_script('bootstrap.min', cleanup_ep_URLPATH . 'admin/files/js/bootstrap.min-4.js');
	wp_enqueue_script('popper', 		cleanup_ep_URLPATH . 'admin/files/js/popper.min.js');
	
	
	// Map openstreet
	wp_enqueue_script('leaflet', cleanup_ep_URLPATH . 'admin/files/js/leaflet.js');
	wp_enqueue_style('leaflet', cleanup_ep_URLPATH . 'admin/files/css/leaflet.css');
	wp_enqueue_script('leaflet-geocoder-locationiq', cleanup_ep_URLPATH . 'admin/files/js/leaflet-geocoder-locationiq.min.js');		
	wp_enqueue_style('leaflet-geocoder-locationiq', cleanup_ep_URLPATH . 'admin/files/css/leaflet-geocoder-locationiq.min.css');
	wp_enqueue_style( 'cleanup-metabox-style', cleanup_ep_URLPATH . 'admin/files/css/metabox-style.css' );
	
	$cleanup_directory_url=get_option('cleanup_ep_url');					
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	$curr_post_id=$post->ID;
	
	$current_post = $curr_post_id;
	$post_edit = get_post($curr_post_id); 
?>		
<div class="bootstrap-wrapper">
	<div id="profile-account2"  class="container">				
		<div class="row">
			 <div class="col-md-12">
				 <div class="cleanup-metabox-section-wrapper logo-banner-metabox-section">
                        <span class="caption-subject">
                            <?php esc_html_e( 'Logo / Image', 'cleanup' ); ?>
                        </span>
                        <hr>
		
					<div class=" col-md-12">																
						<div class=" col-md-6" id="post_image_div10">	
							<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' );
								if(isset($feature_image[0])){ ?>
								<img title="profile image" class=" img-responsive rounded "  src="<?php  echo esc_url($feature_image[0]); ?>">
								<?php
								}
								$feature_image_id=get_post_thumbnail_id( $curr_post_id );
							?>
						</div> 
						<div class=" form-group col-md-6">											
							<div class="" id="post_image_edit">	
								<button type="button" onclick="cleanup_edit_post_image('post_image_div10');"  class="btn btn-small-ar"><?php  esc_html_e('Feature Image / Company Logo','cleanup'); ?> </button>
							</div>									
						</div>								
					</div>	
		
			
			<div class="clearfix"></div>								
			<div class=" col-md-12">																
				<div class=" col-md-6" id="post_image_topbaner">	
					<?php 
						$topbanner=get_post_meta($post_edit->ID,'topbanner', true);
						if(trim($topbanner)!=''){ 
							$cleanup_topbanner_image = wp_get_attachment_url($topbanner );
						?>
						<img title="image" class=" img-responsive rounded " src="<?php  echo esc_url($cleanup_topbanner_image); ?>">
						<?php
						}
						
					?>
				</div> 
				<div class=" form-group col-md-6">											
					<div class="" id="topbanner_image_edit">
						<button type="button" onclick="cleanup_topbanner_image('post_image_topbaner');"  class="btn btn-small-ar"><?php  esc_html_e('Top Banner[best fit 1200X400]','cleanup'); ?> </button>
					</div>									
				</div>								
			</div>	
			<input type="hidden" name="topbanner_image_id" id="topbanner_image_id" value="<?php echo esc_attr($topbanner); ?>">	
			</div>	
			<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">
							<span class="caption-subject">
								<?php esc_html_e( 'Image Gallery', 'cleanup' ); ?>
							</span>

								<hr/>
						<div class="form-group ">	
							<div class="col-md-12" id="gallery_image_div">
							</div>									
					</div>
				
				
				<div class="row">										
					<div class="  form-group col-md-12">	
						<?php
							$gallery_ids=get_post_meta($curr_post_id ,'image_gallery_ids',true);
							$gallery_ids_array = array_filter(explode(",", $gallery_ids));
						?>
						<input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="<?php echo esc_attr($gallery_ids); ?>">
						<div class="row" id="gallery_image_div">
							<?php
								if(sizeof($gallery_ids_array)>0){
									foreach($gallery_ids_array as $slide){
									?>
									<div id="gallery_image_div<?php echo esc_html($slide);?>" class="col-md-2"><img  class="img-responsive"  src="<?php echo esc_url(wp_get_attachment_url( $slide )); ?>"><button type="button" onclick="cleanup_remove_gallery_image('gallery_image_div<?php echo esc_html($slide);?>', <?php echo esc_html($slide);?>);"  class="btn btn-sm btn-danger"><?php esc_html_e('X','cleanup'); ?> </button> </div>
									<?php
									}
								}
							?>
						</div>
						<button type="button" onclick="cleanup_edit_gallery_image('gallery_image_div');"  class="btn btn-small-ar"><?php  esc_html_e('Add Images','cleanup'); ?></button>
					</label>						
				</div>
			</div>
			</div>
			<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">					
					<div class="row">
						<div class=" col-md-6 form-group">
							<label for="text" class=" control-label"><?php  esc_html_e('Price','cleanup'); ?></label>
							<input type="text" class="form-control" name="price" id="price" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'price',true));?>" placeholder="<?php  esc_html_e('Enter Price ','cleanup'); ?>">
						</div>
						<div class="col-md-6  form-group">
							<label for="text" class=" control-label"><?php  esc_html_e('Discount Price','cleanup'); ?></label>
							<input type="text" class="form-control" name="discount" id="discount" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'discount',true));?>" placeholder="<?php  esc_html_e('Enter Discount Price','cleanup'); ?>">								
						</div>
					</div>	
				
			</div>
				<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">
					<span class="caption-subject">
						<?php esc_html_e( 'Contact Info', 'cleanup' ); ?>
					</span>

						<hr/>
								
						<div class="col-md-12">	
					
				
				
				<?php
					$listing_contact_source=get_post_meta($post_edit->ID,'listing_contact_source',true);
					if($listing_contact_source==''){$listing_contact_source='user_info';}
				?>
				<div class=" form-group">	
					<div class="radio">											
						<label><input type="radio" name="contact_source" value="user_info"  <?php echo ($listing_contact_source=='user_info'?'checked':''); ?> > <?php  esc_html_e(' Use The company Info ->','cleanup'); ?> <?php echo ucfirst($current_user->display_name); ?><?php  esc_html_e(' : Logo, Email, Phone, Website','cleanup'); ?> <a href="<?php echo get_permalink().'?profile=setting';?>" target="_blank"> <?php  esc_html_e('Edit','cleanup'); ?> </a></label>
					</div>
					<div class="radio">
						<label><input type="radio" name="contact_source" value="new_value" <?php echo ($listing_contact_source=='new_value'?'checked':''); ?>><?php  esc_html_e(' New Contact Info','cleanup'); ?>  </label>
					</div>
				</div>
				
				
				<div  class="row" id="new_contact_div" <?php echo ($listing_contact_source=='user_info'?'class="displaynone"':''); ?> >
					<div class=" form-group col-md-6">																
						<div class="col-md-3" id="post_image_div">	
							<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' );
								if(isset($feature_image[0])){ ?>
								<img title="profile image" class=" img-responsive" src="<?php  echo esc_url($feature_image[0]); ?>">
								<?php
								}else{ ?>
								<a href="javascript:void(0);" onclick="cleanup_edit_post_image('post_image_div');"  >
									<?php  echo '<img src="'. cleanup_ep_URLPATH.'assets/images/image-add-icon.png">'; ?>
								</a>
								<?php
								}
								$feature_image_id=get_post_thumbnail_id( $curr_post_id );
							?>
						</div> 
						
						<div class="col-md-3" id="post_image_edit">	
							<button type="button" onclick="cleanup_edit_post_image('post_image_div');"  class="btn btn-small-ar"><?php  esc_html_e('Add/Edit Company Logo','cleanup'); ?> </button>
						</div>									
					</div>										
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Company Name','cleanup'); ?></label>						
						<input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo esc_html(get_post_meta($post_edit->ID,'company_name',true)); ?>" placeholder="<?php  esc_attr_e('Company name','cleanup'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Phone','cleanup'); ?></label>						
						<input type="text" class="form-control" name="phone" id="phone" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'phone',true)); ?>" placeholder="<?php  esc_attr_e('Enter Phone Number','cleanup'); ?>">
					</div>
					
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('WhatsApp','cleanup'); ?></label>
						<input type="text" class="form-control" name="whatsapp" id="whatsapp" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'whatsapp',true)); ?>" placeholder="<?php  esc_attr_e('Enter WhatsApp Number','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Viber','cleanup'); ?></label>
						<input type="text" class="form-control" name="viber" id="viber" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'viber',true)); ?>" placeholder="<?php  esc_attr_e('Enter Viber Number','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Email Address','cleanup'); ?></label>
						<input type="text" class="form-control" name="contact-email" id="contact-email" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'contact-email',true)); ?>" placeholder="<?php  esc_html_e('Enter Email Address','cleanup'); ?>">
					</div>
					<div class=" form-group col-md-12">
						<label for="text" class=" control-label"><?php  esc_html_e('Address autocomplete helper','cleanup'); ?></label>
						<div id="map"></div>
						<div id="search-box" ></div>						
						
					</div>
					
					<div class=" form-group col-md-12">
						<label for="text" class=" control-label"><?php  esc_html_e('Address (Save in the listing field)','cleanup'); ?></label>						
						<input type="text" class="form-control" name="address" id="address" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'address',true)); ?>"  placeholder="<?php  esc_html_e('Enter Address','cleanup'); ?>">
					</div>
					
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('City','cleanup'); ?></label>
						<input type="text" class="form-control" name="city" id="city" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'city',true)); ?>" placeholder="<?php  esc_attr_e('Enter city','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('State','cleanup'); ?></label>
						<input type="text" class="form-control" name="state" id="state" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'state',true)); ?>" placeholder="<?php  esc_attr_e('Enter State','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Zipcode/Postcode','cleanup'); ?></label>
						<input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'postcode',true)); ?>" placeholder="<?php  esc_attr_e('Enter Zipcode/Postcode','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Country','cleanup'); ?></label>
						<input type="text" class="form-control" name="country" id="country" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'country',true)); ?>" placeholder="<?php  esc_attr_e('Enter Country','cleanup'); ?>">
					</div>
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Latitude ','cleanup'); ?></label>
						<input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'latitude',true)); ?>" placeholder="<?php  esc_attr_e('Enter Latitude','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Longitude','cleanup'); ?></label>
						<input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'longitude',true)); ?>" placeholder="<?php  esc_attr_e('Enter Longitude','cleanup'); ?>">
					</div>	
					<div class=" form-group col-md-6">
						<label for="text" class=" control-label"><?php  esc_html_e('Web Site','cleanup'); ?></label>
						<input type="text" class="form-control" name="contact_web" id="contact_web" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'contact_web',true)); ?>"  placeholder="<?php  esc_attr_e('Enter Web Site','cleanup'); ?>">
					</div>
				</div>
				<input type="hidden" name="feature_image_id" id="feature_image_id" value="<?php echo esc_attr($feature_image_id); ?>">
				
					</div>	
			</div>			
			<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">
					<span class="caption-subject">
						<?php esc_html_e( 'Videos', 'cleanup' ); ?>
					</span>
						<hr/>
				
					<div class="row">
						<div class=" col-md-6 form-group">
							<label for="text" class=" control-label"><?php  esc_html_e('Youtube','cleanup'); ?></label>
							<input type="text" class="form-control" name="youtube" id="youtube" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'youtube',true));?>" placeholder="<?php  esc_html_e('Enter Youtube video ID, e.g : bU1QPtOZQZU ','cleanup'); ?>">
						</div>
						<div class="col-md-6  form-group">
							<label for="text" class=" control-label"><?php  esc_html_e('vimeo','cleanup'); ?></label>
							<input type="text" class="form-control" name="vimeo" id="vimeo" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'vimeo',true));?>" placeholder="<?php  esc_html_e('Enter vimeo ID, e.g : 134173961','cleanup'); ?>">								
						</div>
					</div>	
					
				</div>	
				<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">
					<span class="caption-subject">
						<?php esc_html_e( 'Attached Doc', 'cleanup' ); ?>
					</span>
						<hr/>				
								
					<?php
						$attached_ids=get_post_meta($post_edit->ID ,'attached_ids',true);
						$attached_ids_array = array_filter(explode(",", $attached_ids));
					?>
					<input type="hidden" name="attached_ids" id="attached_ids"  value="<?php echo esc_attr($attached_ids); ?>">
					<div id="attached_div">
							<?php
									if(is_array($attached_ids_array)){
										foreach($attached_ids_array as $slide){
											$filename_only = basename( get_attached_file( $slide ) );
										?>
										<div id="attached_div<?php echo esc_attr($slide);?>"  class="row mb-2">
											<label class="col-md-11 control-label"><?php echo esc_html($filename_only); ?></label>
											<div class="col-md-1">
											<button type="button" onclick="cleanup_remove_attached_doc('attached_div<?php echo esc_attr($slide);?>', <?php echo esc_attr($slide);?>);"  class="btn btn-small-ar"><?php esc_html_e('X','cleanup'); ?> </button> </div></div>
										<?php
										}
									}
								?>
					</div>									
				
				<div class="row">										
					<div class="  form-group col-md-12">									
						<button type="button" onclick="cleanup_attached_doc('attached_div');"  class="btn btn-small-ar mt-2"><?php  esc_html_e('Add Attachments','cleanup'); ?></button>
					</label>						
					</div>
					
				</div>
			</div>
			
		<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">
					<span class="caption-subject">
						<?php esc_html_e( 'More Details', 'cleanup' ); ?>
					</span>
						<hr/>	
			
				<div class="row" id="cleanup_fields">
				<?php	
					$currentCategory=wp_get_object_terms( $post_edit->ID, $cleanup_directory_url.'-category');
					$post_cats=array();
					foreach($currentCategory as $c){
						array_push($post_cats,$c->slug);
					}														
					echo ''.$main_class->cleanup_listing_fields($post_edit->ID,$post_cats  );
				?>	
			</div>
			
			</div>
			
			<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">
					<span class="caption-subject">
						<?php esc_html_e( 'Business Hours', 'cleanup' ); ?>
					</span>
						<hr/>	
			
				<div class="">
					<?php							
						include( cleanup_ep_template. 'private-profile/listing-open-close-time.php');						
						?>		
				</div>
			</div>
			<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">
					<span class="caption-subject">
						<?php esc_html_e( 'FAQs', 'cleanup' ); ?>
					</span>
						<hr/>	
					<div class="row">
						<?php							
							include( cleanup_ep_template. 'private-profile/profile-add-edit-faq.php');						
						?>		
					</div>
			</div>
			<div class="cleanup-metabox-section-wrapper image-gallery-metabox-section">
					<span class="caption-subject">
						<?php esc_html_e( 'Button Setting', 'cleanup' ); ?>
					</span>
						<hr/>	
															
			
			<?php											
				
				$dir_style5_email=get_option('dir_style5_email');	
				if($dir_style5_email==""){$dir_style5_email='yes';}
				if($dir_style5_email=="yes"){
					$dirpro_email_button=get_post_meta($post_edit->ID,'dirpro_email_button',true);
					if($dirpro_email_button==""){$dirpro_email_button='yes';}
				?>	
				<div class="form-group row ">
					<label  class="col-md-4 control-label"> <?php  esc_html_e('Contact Button','cleanup');  ?></label>
					<div class="col-md-3">
						<label>												
							<input type="radio" name="dirpro_email_button" id="dirpro_email_button" value='yes' <?php echo ($dirpro_email_button=='yes' ? 'checked':'' ); ?> > <?php  esc_html_e('Show Contact Button','cleanup');  ?>
						</label>	
					</div>
					<div class="col-md-5">	
						<label>											
							<input type="radio"  name="dirpro_email_button" id="dirpro_email_button" value='no' <?php echo ($dirpro_email_button=='no' ? 'checked':'' );  ?> > <?php  esc_html_e('Hide Contact Button','cleanup');  ?>
						</label>
					</div>	
				</div>		
				<?php
				}	
			?>								
		</div>
	</div>
	<input type="hidden" name="listing_data_submit" id="listing_data_submit" value="yes">
</div>
</div>
</div>
<!-- END PROFILE CONTENT -->
<?php
	$save_address=get_post_meta($curr_post_id ,'address',true);
	$my_theme = wp_get_theme();
	$theme_name= strtolower($my_theme->get( 'Name' ));
	wp_enqueue_script('cleanup_add-edit-listing', cleanup_ep_URLPATH . 'admin/files/js/add-edit-listing.js');
	wp_localize_script('cleanup_add-edit-listing', 'realpro_data', array(
	'ajaxurl' 					=> admin_url( 'admin-ajax.php' ),
	'loading_image'			=> '<img src="'.cleanup_ep_URLPATH.'admin/files/images/loader.gif">',
	'current_user_id'		=>get_current_user_id(),
	'Set_Feature_Image'	=> esc_html__('Set Feature Image','cleanup'),
	'Set_plan_Image'		=> esc_html__('Set Image ','cleanup'),
	'Set_Event_Image'		=> esc_html__(' Set Image ','cleanup'),
	'Gallery Images'		=> esc_html__('Gallery Images','cleanup'),
	'save_address'			=>$save_address,
	'permalink'					=> get_permalink(),
	'dirwpnonce'				=> wp_create_nonce("addlisting"),
	'theme_name'				=> $theme_name,
	) );
	
	 					