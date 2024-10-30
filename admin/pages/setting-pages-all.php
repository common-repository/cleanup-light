<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
	<form class="form-horizontal" role="form"  name='cleanup_page_settings' id='cleanup_page_settings'>
		<?php
			$price_table=get_option('cleanup_price_table'); 
			$registration=get_option('cleanup_registration'); 
			$profile_page=get_option('cleanup_profile_page'); 
			$login_page=get_option('cleanup_login_page');  										
			$thank_you=get_option('cleanup_thank_you_page'); 	
			$args = array(
			'child_of'     => 0,
			'sort_order'   => 'ASC',
			'sort_column'  => 'post_title',
			'hierarchical' => 1,															
			'post_type' => 'page'
			);
		?>
		
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'User Sign Up:', 'cleanup' );?> </label>
			<div class="col-md-10 ">
				
					<?php
					
						if ( $pages = get_pages( $args ) ){
							echo "<select id='signup_page' name='signup_page' class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='".esc_attr($page->ID)."'".($registration==$page->ID ? 'selected':'').">".esc_html($page->post_title)."</option>";
							}
							echo "</select>";
						}
					?>
					<?php
						$reg_page= get_permalink( $registration); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"> <?php esc_html_e( 'View', 'cleanup' );?></a>
				</div>
		</div>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Signup Thanks', 'cleanup' );?> : </label>
			<div class="col-md-10 ">
				
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='thank_you_page'  name='thank_you_page'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='".esc_attr($page->ID)."'".($thank_you==$page->ID ? 'selected':'').">".esc_html($page->post_title)."</option>";
							}
							echo "</select>";
						}
					?>
				
				
					<?php
						$reg_page= get_permalink( $thank_you); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"> <?php esc_html_e( 'View', 'cleanup' );?></a>
				
			</div>	
		</div>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Login Page:', 'cleanup' );?> </label>
			<div class="col-md-10 ">
				
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='login_page'  name='login_page'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='".esc_attr($page->ID)."'". ($login_page==$page->ID ? 'selected':'').">".esc_html($page->post_title)."</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php
						$reg_page= get_permalink( $login_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'cleanup' );?> </a>
			
			</div>	
		</div>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'User My Account', 'cleanup' );?> : </label>
			<div class="col-md-10 ">
				
					<?php
						if ( $pages = get_pages( $args ) ){
							echo "<select id='profile_page'  name='profile_page'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='".esc_attr($page->ID)."'".($profile_page==$page->ID ? 'selected':'').">".esc_html($page->post_title)."</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php
						$reg_page= get_permalink( $profile_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"> <?php esc_html_e( 'View', 'cleanup' );?></a>
				
			</div>	
		</div>
		
		<?php
		$profile_page=get_option('cleanup_author_dir_page');
		?>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Author Directory:', 'cleanup' );?> </label>
			<div class="col-md-10 ">
				
					<?php																				
						if ( $pages = get_pages( $args ) ){
							echo "<select id='employer_dir'  name='employer_dir'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='".esc_attr($page->ID)."'".($profile_page==$page->ID ? 'selected':'').">".esc_html($page->post_title)."</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php																				
						$reg_page= get_permalink( $profile_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'cleanup' );?> </a>
				
			</div>	
		</div>
		
		
		
		
		
		
		<?php
		$profile_page=get_option('cleanup__public_profile_page');
		?>
		<div class="form-group row">
			<label  class="col-md-2   control-label"><?php esc_html_e( 'Author Public Profile:', 'cleanup' );?> </label>
			<div class="col-md-10 ">
				
					<?php																				
						if ( $pages = get_pages( $args ) ){
							echo "<select id='employer_public'  name='employer_public'  class='form-control'>";
							foreach ( $pages as $page ) {
								echo "<option value='".esc_attr($page->ID)."'".($profile_page==$page->ID ? 'selected':'').">".esc_html($page->post_title)."</option>";
							}
							echo "</select>";
						}
					?>
				
					<?php																				
						$reg_page= get_permalink( $profile_page); 
					?>
					<a class="btn btn-info mt-2 " href="<?php  echo esc_url($reg_page); ?>"><?php esc_html_e( 'View', 'cleanup' );?> </a>
				
			</div>	
		</div>
		
		
		
		<div class="form-group row">
			<label  class="col-md-2   control-label"> </label>
			<div class="col-md-10 ">
					<hr/>
					<div id="page_all_setting_save"></div>
					<button type="button" onclick="return  cleanup_update_page_settings();" class="button button-primary"><?php esc_html_e( 'Update', 'cleanup' );?></button>
				
				<div class="checkbox col-md-1 ">
				</div>
			</div>	
		</div>	
	</form>
