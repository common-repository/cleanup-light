<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	$main_class = new cleanup_eplugins;
	wp_enqueue_style('admin-cleanup', cleanup_ep_URLPATH . 'admin/files/css/admin.css');
	wp_enqueue_style('dataTables', cleanup_ep_URLPATH . 'admin/files/css/vue-admin.css');
?>	
<div class="bootstrap-wrapper">
	<div class=" container-fluid">	
		<div class="cleanup-admin-header row">
			<div class="cleanup-admin-header-logo">
				<img src="<?php echo esc_url(cleanup_ep_URLPATH.'assets/images/admin-logo.png'); ?>" alt="cleanup Logo">
				<span class="cleanup-admin-header-version"><?php echo esc_html($main_class->version); ?></span>
				
				<a class="button button-primary ml-3" href="<?php echo esc_url('https://e-plugins.com/cleanup-main/');?>" target="_blank"> <?php  esc_html_e('Pro Version','cleanup'); ?></a>
				
			</div>
			<div class="cleanup-admin-header-menu">
				<div class="menu-item">
					<div class="menu-icon">
						<i class="fa-solid fa-question"></i>
						<div class="dropdown">
							<h3><?php  esc_html_e('Get Help','cleanup'); ?></h3>
							<div class="list-item">  
							
							 <a href="<?php echo esc_url('https://www.youtube.com/playlist?list=PLLRcfoNnzUb7NzUw-MWlt2NJblMhpxndr');?>" target="_blank">
									<span class="cleanup-icon">
										<i class="fa-brands fa-youtube"></i>
									</span>
									<?php  esc_html_e('Video Tutorial','cleanup'); ?>
								</a>
								
								<a href="<?php echo esc_url('https://e-plugins.com/support/');?>" target="_blank">
									<span class="cleanup-icon">
										<i class="fa-regular fa-comments"></i>
									</span>
									<?php  esc_html_e('Get Support','cleanup'); ?>
								</a>
								<a href="<?php echo esc_url('https://help.eplug-ins.com/cleanup');?>" target="_blank">
									<div class="cleanup-icon">
										<i class="fa-solid fa-file-lines"></i>
									</div>
									<?php  esc_html_e('Documentation','cleanup'); ?>
								</a>
								
								<a href="#" target="_blank">
									<div class="cleanup-icon">
										<i class="fa-regular fa-comments"></i>
									</div>
								<?php  esc_html_e('FAQ','cleanup'); ?>
								</a>
								<a href="<?php echo esc_url('https://cleanup.e-plugins.com/request-a-feature/');?>" target="_blank">
									<div class="cleanup-icon">
										<i class="fa-regular fa-lightbulb"></i>
									</div>
								<?php  esc_html_e('Request a Feature  ','cleanup'); ?>                      </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>