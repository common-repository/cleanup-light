<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php

				
	global $wpdb , $cleanup_signup_fields_serial;
	$cleanup_directory_url=get_option('cleanup_ep_url');
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	include('header.php');
?>
<div class="cleanup-settings  mt-3"> 
	<div class="row">
		<div class="col-md-9 col-8">
			<h2 class="mb-3"><?php esc_html_e('Settings','cleanup'); ?> <a title="Video Tutorial" href="<?php echo esc_url('https://www.youtube.com/playlist?list=PLLRcfoNnzUb7NzUw-MWlt2NJblMhpxndr');?>" target="_blank"><span class="cleanup-icon"><i class="fa-brands fa-youtube"></i></span>	</a></h2> 


		</div>
		<div class="col-md-3 col-4 text-right " id="admin-menu">
			<button class=" btn-border mb-2 " id="compose_adminmenu" ><i class="fa-solid fa-bars"></i></button>
		</div>
	</div>
	

	<div class="cleanup-settings-wrap row">	
		<div class="nav-tab-wrapper col-md-3" id="cleanup-left-menu">	
			<a href="#" class=" nav-tab tablinks "  id="defaultOpen" onclick="cleanup_tabopen(event, 'listing_publish')" >
			<span class="dashicons dashicons-admin-generic"></span> <?php esc_html_e('Listing Settings/Layout','cleanup'); ?></a>
			
			<a href="#" class=" nav-tab tablinks "   onclick="cleanup_tabopen(event, 'demo')" ><span class="dashicons dashicons-database-add"></span> <?php esc_html_e('Demo Data','cleanup'); ?></a>
			<a href="#" class=" nav-tab tablinks "  onclick="cleanup_tabopen(event, 'listing_search')" ><span class="dashicons dashicons-search"></span> <?php esc_html_e('Search Form Builder','cleanup'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="cleanup_tabopen(event, 'color_setting')" ><span class="dashicons dashicons-color-picker"></span> <?php esc_html_e('Color','cleanup'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="cleanup_tabopen(event, 'alllistinglayout')" ><span class="dashicons dashicons-list-view"></span> <?php esc_html_e('All Listing Data/Fields','cleanup'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="cleanup_tabopen(event, 'singlelistinglayout')" ><span class="dashicons dashicons-welcome-write-blog"></span> <?php esc_html_e('Single Listing Fields','cleanup'); ?></a>	
			<a href="#" class=" nav-tab tablinks "   onclick="cleanup_tabopen(event, 'map_setting')" ><span class="dashicons dashicons-location-alt"></span> <?php esc_html_e('Map','cleanup'); ?></a>	
			<a href="#" class=" nav-tab tablinks "  onclick="cleanup_tabopen(event, 'my-account')" ><span class="dashicons dashicons-welcome-widgets-menus"></span> <?php esc_html_e('My Account Menu','cleanup'); ?></a>					
		
			<a href="#" class=" nav-tab tablinks "  onclick="cleanup_tabopen(event, 'listingfields')" ><span class="dashicons dashicons-list-view"></span> <?php esc_html_e('Listing Custom Fields','cleanup'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="cleanup_tabopen(event, 'csv')" ><span class="dashicons dashicons-database-import"></span> <?php esc_html_e('CSV Importer','cleanup'); ?></a>		
			
			<a href="#" class=" nav-tab tablinks "  onclick="cleanup_tabopen(event, 'email_template')" ><span class="dashicons dashicons-email"></span> <?php esc_html_e('Email Template','cleanup'); ?></a>
			<a href="#" class=" nav-tab tablinks "   onclick="cleanup_tabopen(event, 'pagesall')" ><span class="dashicons dashicons-admin-page"></span> <?php esc_html_e('Plugin Pages','cleanup'); ?></a>				
			<a href="#" class="nav-tab tablinks" onclick="cleanup_tabopen(event, 'mailchimp')" ><span class="dashicons dashicons-cart"></span> <?php esc_html_e('Mailchimp','cleanup'); ?></a>
		
			<a href="#" class="nav-tab tablinks"  onclick="cleanup_tabopen(event, 'user_settings')" ><span class="dashicons dashicons-admin-users"></span> <?php esc_html_e('Users','cleanup'); ?></a>
			
			
			<a href="#" class="nav-tab tablinks"  onclick="cleanup_tabopen(event, 'shortcodes')"><span class="dashicons dashicons-editor-help"></span> <?php esc_html_e('Useful Shortcode','cleanup'); ?></a>
		</div> 
		<div class="metabox-holder col-md-9">
			
			<div id="demo" class="tabcontent group">				
					
					<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Demo Import ','cleanup');?>  </label></th></tr></thead></table> 						
					<div class="top-20 "><p></p>
						<?php include (cleanup_ep_DIR .'/admin/pages/dir-demo.php');?>			
					</div>
					
				
			</div>
			<div id="csv" class="tabcontent group">				
			
			
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Importing CSV Data ','cleanup');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>
							<?php
								include('csv-import.php');
							?>					
						</div>
					</div>
				</div>
			</div>
			<div id="user_settings" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Users Settings','cleanup');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/user_directory_admin.php');?>
						</div>
					</div>
				</div>
			</div>
			
			<div id="my-account" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('My Account Menu ','cleanup');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/profile-fields.php');?>
						</div>
					</div>
				</div>
			</div>
			
			<div id="mailchimp" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Mailchimp ','cleanup');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/mailchimp.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="shortcodes" class="tabcontent group">	
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Useful shortcode/ Widgets ','cleanup');?> 
						
						 <a href="<?php echo esc_url('https://www.youtube.com/playlist?list=PLLRcfoNnzUb7NzUw-MWlt2NJblMhpxndr');?>" target="_blank">
                            <span class="cleanup-icon">
                                <i class="fa-brands fa-youtube"></i>
							</span>
							<?php  esc_html_e('Videos','cleanup'); ?>
						</a>
							
							</label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/shortcodes-sample.php');?>
						</div>
					</div>
				</div>
			</div>
			
			
			
			<div id="alllistinglayout" class="tabcontent group">		
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Listing Archive (drag, drop & sort)','cleanup');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php 
							include (cleanup_ep_DIR .'/admin/pages/archive_setting.php');?>
						</div>
					</div>
				</div>	
			</div>
			<div id="singlelistinglayout" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Listing Detail page (drag & drop)','cleanup');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php 
							include (cleanup_ep_DIR .'/admin/pages/single_page_setting.php');?>
						</div>
					</div>
				</div>	
			</div>
			<div id="color_setting" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Color Settings ','cleanup');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/color_setting.php');?>
						</div>
					</div>
				</div>				
			</div>	
			<div id="email_template" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Email Template ','cleanup');?>  </label></th></tr></thead></table> 						
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/email_template_all.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="map_setting" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Map Settings ','cleanup');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/map_setting.php');?>
						</div>
					</div>
				</div>				
			</div>	
			<div id="listing_search" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Customize the search form (drag, drop & sort)','cleanup');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/listing_search.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="listing_publish" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Listing Settings','cleanup');?>  <a class="button button-primary " href="<?php echo esc_url( get_post_type_archive_link( $cleanup_directory_url)) ; ?>" target="blank"><?php esc_html_e('View Page','cleanup');  ?></a></label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/listing_publish.php');?>
						</div>
					</div>
				</div>
			</div>
			<div id="pagesall" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Plugin Pages','cleanup');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/setting-pages-all.php');?>
						</div>
					</div>
				</div>
			</div>
				
			<div id="listingfields" class="tabcontent group">
				<div class="bootstrap-wrapper">
					<div class="container-fluid">
						<table class="form-table"><thead><tr class="cleanup-settings-field-type-sub_section"><th colspan="3" class="cleanup-settings-sub-section-title"><label><?php esc_html_e('Listing Fields','cleanup');?>  </label></th></tr></thead></table>
						<div class="top-20 "><p></p>				  
							<?php include (cleanup_ep_DIR .'/admin/pages/directory_fields.php');?>
						</div>
					</div>
				</div>
			</div>
			
		
		</div>
		</div>
</div>		
<?php
	include('footer.php');
?>