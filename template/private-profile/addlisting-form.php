<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class=" form-group">
	<label for="text" class=" control-label"><?php  esc_html_e('listing Title','cleanup'); ?></label>
	<div class="  "> 
		<input type="text" class="form-control" name="title" id="title" value="" placeholder="<?php  esc_html_e('Enter Title Here','cleanup'); ?>">
	</div>																		
</div>	

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
			$cleanup_user_can_publish=get_option('cleanup_user_can_publish');	
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
		<input type="text" class="form-control" name="price" id="price" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'price',true));?>" placeholder="<?php  esc_html_e('Enter Price ','cleanup'); ?>">
	</div>
	<div class="col-md-6  form-group">
		<label for="text" class=" control-label"><?php  esc_html_e('Discount Price','cleanup'); ?></label>
		<input type="text" class="form-control" name="discount" id="discount" value="<?php echo esc_attr(get_post_meta($post_edit->ID,'discount',true));?>" placeholder="<?php  esc_html_e('Enter Discount Price','cleanup'); ?>">								
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

<div  class="row" id="new_contact_div" > 
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Company Name','cleanup'); ?></label>						
		<input type="text" class="form-control" name="company_name" id="company_name" value="" placeholder="<?php  esc_attr_e('Company name','cleanup'); ?>">
	</div>
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Phone','cleanup'); ?></label>						
		<input type="text" class="form-control" name="phone" id="phone" value="" placeholder="<?php  esc_attr_e('Enter Phone Number','cleanup'); ?>">
	</div>
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('WhatsApp','cleanup'); ?></label>
		<input type="text" class="form-control" name="whatsapp" id="whatsapp" value="" placeholder="<?php  esc_attr_e('Enter whatsApp Number','cleanup'); ?>">
	</div>	
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('Viber','cleanup'); ?></label>
		<input type="text" class="form-control" name="viber" id="viber" value="" placeholder="<?php  esc_attr_e('Enter Viber Number','cleanup'); ?>">
	</div>	
	
	<input type="hidden" class="form-control" name="address" id="address" value=""  placeholder="<?php  esc_html_e('Enter Address','cleanup'); ?>">
	<div class=" form-group col-md-12">
		<label for="text" class=" control-label"><?php  esc_html_e('Address','cleanup'); ?></label>
		<div id="map"></div>
		<div id="search-box"></div>
		<div id="result"></div>
	</div>
	<div class=" form-group col-md-6">
		<label for="text" class=" control-label"><?php  esc_html_e('City','cleanup'); ?></label>
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
	<?php  esc_html_e('listing information','cleanup'); ?>
</span>
<hr/>	
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
				<input type="radio" name="dirpro_email_button" id="dirpro_email_button" class="mr-1" value='yes' <?php echo ($dirpro_email_button=='yes' ? 'checked':'' ); ?> ><?php  esc_html_e('Show Contact Button','cleanup');  ?>
			</label>	
		</div>
		<div class="col-md-5">	
			<label>											
				<input type="radio"  name="dirpro_email_button" id="dirpro_email_button" class="mr-1"  value='no' <?php echo ($dirpro_email_button=='no' ? 'checked':'' );  ?> > <?php  esc_html_e('Hide Contact Button','cleanup');  ?>
			</label>
		</div>	
	</div>		
	<?php
	}	
	?>	