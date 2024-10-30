<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div id="update_message"> </div>		 
<form class="form-horizontal" role="form"  name='directory_settings' id='directory_settings'>
	<?php
		$cleanup_archive_layout=get_option('cleanup_archive_layout');	
		if($cleanup_archive_layout==""){$cleanup_archive_layout='archive-left-map';}	
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default All Listing Page Layout','cleanup');  ?></label>
		<div class="col-md-2">
			<label>												
				<input type="radio" name="cleanup_archive_layout" id="cleanup_archive_layout" value='archive-left-map' <?php echo ($cleanup_archive_layout=='archive-left-map' ? 'checked':'' ); ?> > <?php esc_html_e( 'Listing + Left Map', 'cleanup' );?>  
			</label>	
		</div>
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="cleanup_archive_layout" id="cleanup_archive_layout" value='archive-top-map' <?php echo ($cleanup_archive_layout=='archive-top-map' ? 'checked':'' );  ?> > <?php esc_html_e( 'Listing + Top Map', 'cleanup' );?>
			</label>
		</div>	
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="cleanup_archive_layout" id="cleanup_archive_layout" value='archive-no-map' <?php echo ($cleanup_archive_layout=='archive-no-map' ? 'checked':'' );  ?> > <?php esc_html_e( 'Listing Without Map', 'cleanup' );?>
			</label>
		</div>		
	</div>	
	<?php
		$cleanup_user_can_publish=get_option('cleanup_user_can_publish');	
		if($cleanup_user_can_publish==""){$cleanup_user_can_publish='yes';}	
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Publish Listing','cleanup');  ?></label>
		<div class="col-md-2">
			<label>												
				<input type="radio" name="cleanup_user_can_publish" id="cleanup_user_can_publish" value='No' <?php echo ($cleanup_user_can_publish=='yes' ? 'checked':'' ); ?> > <?php esc_html_e( 'Admin will Publish', 'cleanup' );?>  
			</label>	
		</div>
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="cleanup_user_can_publish" id="cleanup_user_can_publish" value='yes' <?php echo ($cleanup_user_can_publish=='no' ? 'checked':'' );  ?> > <?php esc_html_e( 'All user can publish', 'cleanup' );?>
			</label>
		</div>	
	</div>
	<?php
		$listing_hide=get_option('cleanup_listing_hide_opt');	
		if($listing_hide==""){$listing_hide='package';}	
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Listing hide','cleanup');  ?></label>
		<div class="col-md-2">
			<label>												
				<input type="radio" name="listing_hide" id="listing_hide" value='package' <?php echo ($listing_hide=='package' ? 'checked':'' ); ?> > <?php esc_html_e( 'When User Package Expire ', 'cleanup' );?>  
			</label>	
		</div>
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="listing_hide" id="listing_hide" value='deadline' <?php echo ($listing_hide=='deadline' ? 'checked':'' );  ?> > <?php esc_html_e( 'After Deadline of listing', 'cleanup' );?>
			</label>
		</div>	
		<div class="col-md-2">	
			<label>											
				<input type="radio"  name="listing_hide" id="listing_hide" value='admin' <?php echo ($listing_hide=='admin' ? 'checked':'' );  ?> > <?php esc_html_e( 'Admin will hide/delete', 'cleanup' );?>
			</label>
		</div>	
		
	</div>
	
	<?php											
		$opt_style=	get_option('cleanup_archive_template');
		
	?>	
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default listing Image','cleanup');  ?> 
		</label>
		<div class="col-md-2" id="listing_defaultimage">
				<?php
					if(get_option('cleanup_listing_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('cleanup_listing_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=cleanup_ep_URLPATH."/assets/images/default-directory.jpg";
						}
					?>
				<img class="w80"   src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
			
				<input type="hidden" name="cleanup_listing_defaultimage" id="cleanup_listing_defaultimage" >
				<button type="button" onclick="return  cleanup_listing_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','cleanup');  ?></button>			
				<p><?php esc_html_e('Best Fit 450px X 350px','cleanup');  ?> </p>
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default Location Image','cleanup');  ?> 
		</label>
		<div class="col-md-2" id="location_defaultimage">
			<?php
					if(get_option('cleanup_location_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('cleanup_location_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=cleanup_ep_URLPATH."/assets/images/location.jpg";
						}
					?>
				<img class="w80"   src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
				<input type="hidden" name="cleanup_location_defaultimage" id="cleanup_location_defaultimage" >
				<button type="button" onclick="return  cleanup_location_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','cleanup');  ?></button>	
				<p><?php esc_html_e('Best Fit 300px X 400px','cleanup');  ?> </p>
		</div>
	</div>
	
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default Category Image','cleanup');  ?> 
		</label>
		<div class="col-md-2" id="category_defaultimage">
					<?php
					if(get_option('cleanup_category_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('cleanup_category_defaultimage'));
						if(isset($default_image[0])){									
							$default_image=$default_image[0] ;
						}
						}else{
							$default_image=cleanup_ep_URLPATH."/assets/images/category.png";
						}
					?>
				<img class="w80"  src="<?php echo esc_url($default_image);?>">
				
		</div>
		<div class="col-md-5">	
				<input type="hidden" name="cleanup_category_defaultimage" id="cleanup_category_defaultimage" >										
				<button type="button" onclick="return  cleanup_category_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','cleanup');  ?></button>			
				<p><?php esc_html_e('Best Fit 400px X 400px','cleanup');  ?> </p>
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Default Listing Banner Image','cleanup');  ?> 
		</label>
		<div class="col-md-2" id="banner_defaultimage">
			<?php
					if(get_option('cleanup_banner_defaultimage')!=''){
						$default_image= wp_get_attachment_image_src(get_option('cleanup_banner_defaultimage'));
					if(isset($default_image[0])){									
						$default_image=$default_image[0] ;
					}
					}else{
						$default_image=cleanup_ep_URLPATH."/assets/images/banner.png";
					}
					?>
				<img class="w80"   src="<?php echo esc_url($default_image);?>">
				
		</div>
		
		<div class="col-md-5">	
			
				<input type="hidden" name="cleanup_banner_defaultimage" id="cleanup_banner_defaultimage" >
				<button type="button" onclick="return  cleanup_banner_defaultimage_fun();" class="btn btn-primary btn-xs mt-1"><?php esc_html_e('Set Image','cleanup');  ?></button>	
				<p><?php esc_html_e('Best Fit 1200px X 400px','cleanup');  ?> </p>
			
		</div>
	</div>
	
	<div class="form-group row">
		<?php
			$dir_style5_perpage='20';						
			$dir_style5_perpage=get_option('cleanup_dir_perpage');	
			if($dir_style5_perpage==""){$dir_style5_perpage=20;}
		?>	
		<label  class="col-md-3 control-label">	<?php esc_html_e('Load Per Page','cleanup');  ?> </label>					
		<div class="col-md-2">																	
			<input  class="form-control" type="input" name="cleanup_dir_perpage" id="cleanup_dir_perpage" value='<?php echo esc_attr($dir_style5_perpage); ?>'>
		</div>						
	</div>

	<?php
		$cleanup_url=get_option('cleanup_ep_url');					
		if($cleanup_url==""){$cleanup_url='cleaning-service';}
	?>
	<div class="form-group row">
		<label  class="col-md-3 control-label"> <?php esc_html_e('Custom Post Type','cleanup');  ?></label>					
		<div class="col-md-2">													
				<input  class="form-control"  type="input" name="cleanup_url" id="cleanup_url" value='<?php echo esc_attr($cleanup_url); ?>' >
			
		</div>
		<div class="col-md-5">
			<?php esc_html_e('No special characters, no upper case, no space','cleanup');  ?>
		</div>
	</div>
	<hr>
	

	
	<div class="form-group row">
		<label  class="col-md-3 control-label"> </label>
		<div class="col-md-8">
			<div id="update_message49"> </div>	
			<button type="button" onclick="return  cleanup_update_dir_setting();" class="button button-primary"><?php esc_html_e('Save & Update','cleanup');  ?></button>
		</div>
	</div>
</form>