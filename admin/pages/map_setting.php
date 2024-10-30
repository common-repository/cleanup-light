<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	$dir_map_api=get_option('cleanup_map_api');	
	if($dir_map_api==""){$dir_map_api='';}	
?>
<form class="form-horizontal" role="form"  name='map_settings' id='map_settings'>	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Google Map & Places API Key','cleanup');  ?>
			<br/><small><?php esc_html_e('Please set your own google map API key for your site( default key is for only demo)
			','cleanup');  ?> </small>
		</label>
		<div class="col-md-8">																		
			<input class="col-md-12 form-control" type="text" name="dir_map_api" id="dir_map_api" value='<?php echo esc_attr($dir_map_api); ?>' >
			<a  class="col-md-12" href="<?php echo esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key');?>"> <?php esc_html_e( 'Get your Google Maps API Key here.', 'cleanup' );?>     </a>
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Zoom','cleanup');  ?></label>
		<?php
			$dir_map_zoom=get_option('cleanup_map_zoom');	
			if($dir_map_zoom==""){$dir_map_zoom='7';}	
		?>
		<div class="col-md-3">													
			<input  class="form-control" type="text" name="dir_map_zoom" id="dir_map_zoom" value='<?php echo esc_attr($dir_map_zoom); ?>' >
				<?php esc_html_e('20 is more Zoom, 1 is less zoom','cleanup');  ?> 
				
		</div>
		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Type','cleanup');  ?></label>
		<div class="col-md-6">
			<?php
				$dir_map_type=get_option('cleanup_map_type');	
				if($dir_map_type==""){$dir_map_type='OpenSteet';}	
			?>
			<select id='map_type' name='map_type' class='form-control'>
				<option value="google-map" <?php echo ($dir_map_type=='google-map'?' selected':''); ?>><?php esc_html_e('Google Map','cleanup');  ?></option>
				<option value="opensteet-map" <?php echo ($dir_map_type=='opensteet-map'?' selected':''); ?> ><?php esc_html_e('OpenSteet Map','cleanup');  ?></option>
			</select>
		</div>
		<div class="col-md-2">
			<label>	
			</label>	
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Radius','cleanup');  ?></label>
		<div class="col-md-6">
			<?php
				$cleanup_map_radius=get_option('cleanup_map_radius');	
				if($cleanup_map_radius==""){$cleanup_map_radius='Km';}	
			?>
			<select id='cleanup_map_radius' name='cleanup_map_radius' class='form-control'>
				<option value="Km" <?php echo ($cleanup_map_radius=='Km'?' selected':''); ?>><?php esc_html_e('Km','cleanup');  ?></option>
				<option value="Mile" <?php echo ($cleanup_map_radius=='Mile'?' selected':''); ?> ><?php esc_html_e('Mile','cleanup');  ?></option>
			</select>
		</div>
		<div class="col-md-2">
			<label>	
			</label>	
		</div>
	</div>
	
	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Search Box Near to Me','cleanup');  ?></label>
		<div class="col-md-3">
			<?php
				$cleanup_near_to_me=get_option('cleanup_near_to_me');	
				if($cleanup_near_to_me==""){$cleanup_near_to_me='50';}	
			?>
			<input  class="form-control" type="text" name="cleanup_near_to_me" id="cleanup_near_to_me" value='<?php echo esc_attr($cleanup_near_to_me); ?>' >
		</div>
		<div class="col-md-2">
			<label>	
			</label>	
		</div>
	</div>
	
	
	
	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Force Default Location','cleanup');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$cleanup_forcelocation=get_option('cleanup_forcelocation');					
			?>
			<label class="switch">
			  <input name="cleanup_forcelocation" type="checkbox" value="forcelocation"  <?php echo ($cleanup_forcelocation=='forcelocation' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Default Latitude','cleanup');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$cleanup_defaultlatitude=get_option('cleanup_defaultlatitude');					
			?>
			<input  class="form-control" type="text" name="cleanup_defaultlatitude" id="cleanup_defaultlatitude" value='<?php echo esc_attr($cleanup_defaultlatitude); ?>' >
		</div>
		<div class="col-md-4">
			<label>	<a href="<?php echo esc_url('https://www.maps.ie/coordinates.html');?>" target="_blank" >
				<?php esc_html_e('You can find latitude here','cleanup');  ?></a> 
			</label>	
		</div>
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Default Longitude','cleanup');  ?></label>
		<div class="col-md-3">			<?php
				$cleanup_defaultlongitude=get_option('cleanup_defaultlongitude');					
			?>
			<input  class="form-control" type="text" name="cleanup_defaultlongitude" id="cleanup_defaultlongitude" value='<?php echo esc_attr($cleanup_defaultlongitude); ?>' >
		</div>
		<div class="col-md-4">
			<label>	<a href="<?php echo esc_url('https://www.maps.ie/coordinates.html');?>" target="_blank" >
				<?php esc_html_e('You can find longitude here','cleanup');  ?></a> 
			</label>	
		</div>
	</div>
	<hr/>
	 <label class="cleanup-settings-sub-section-title "> <?php esc_html_e('Map Popup/ Infobox settings','cleanup');  ?></label>
	
	
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Popup/Infobox Image ','cleanup');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$cleanup_infobox_image=get_option('cleanup_infobox_image');	
				if($cleanup_infobox_image==""){$cleanup_infobox_image='yes';}	
			?>
			<label class="switch">
			  <input name="cleanup_infobox_image" type="checkbox" value="yes"  <?php echo ($cleanup_infobox_image=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Popup/Infobox Title ','cleanup');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$cleanup_infobox_title=get_option('cleanup_infobox_title');	
				if($cleanup_infobox_title==""){$cleanup_infobox_title='yes';}	
			?>
			<label class="switch">
			  <input name="cleanup_infobox_title" type="checkbox" value="yes"  <?php echo ($cleanup_infobox_title=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Popup/Infobox Location ','cleanup');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$cleanup_infobox_location=get_option('cleanup_infobox_location');		
				if($cleanup_infobox_location==""){$cleanup_infobox_location='yes';}	
			?>
			<label class="switch">
			  <input name="cleanup_infobox_location" type="checkbox" value="yes"  <?php echo ($cleanup_infobox_location=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Map Popup/Infobox Direction ','cleanup');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$cleanup_infobox_direction=get_option('cleanup_infobox_direction');
				if($cleanup_infobox_direction==""){$cleanup_infobox_direction='yes';}
			?>
			<label class="switch">
			  <input name="cleanup_infobox_direction" type="checkbox" value="yes"  <?php echo ($cleanup_infobox_direction=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	<div class="form-group row">
		<label  class="col-md-4 control-label"> <?php esc_html_e('Link to Detail page ','cleanup');  ?>			
			</label>
		<div class="col-md-3">			<?php
				$cleanup_infobox_linkdetail=get_option('cleanup_infobox_linkdetail');
				if($cleanup_infobox_linkdetail==""){$cleanup_infobox_linkdetail='yes';}
			?>
			<label class="switch">
			  <input name="cleanup_infobox_linkdetail" type="checkbox" value="yes"  <?php echo ($cleanup_infobox_linkdetail=='yes' ? ' checked':'');  ?> >
			  <span class="slider round"></span>
			</label>
		</div>		
	</div>
	
	<div class="row">
		
		<div class="col-md-12 col-12">
			<hr/>
			<div id="success_message_map_setting"></div>	
			<button type="button" onclick="return  cleanup_update_map_settings();" class="button button-primary"><?php esc_html_e( 'Update', 'cleanup' );?></button>
		</div>	
	</div>	
</form>