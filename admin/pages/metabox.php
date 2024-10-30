<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="bootstrap-wrapper">
 	<div class="dashboard-eplugin container-fluid">
 		<?php	
			global $wpdb, $post,$current_user;	
			//*************************	plugin file *********
			$cleanup_approve= get_post_meta( $post->ID,'cleanup_approve', true );
			$cleanup_current_author= $post->post_author;
			$userId=$current_user->ID;
			if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
			?>
			<div class="row">
				<div class="col-md-12">
					<?php esc_html_e( 'User ID :', 'cleanup' )?>
					<select class="form-control" id="cleanup_author_id" name="cleanup_author_id">
						<?php	
						
							$user_query = new WP_User_Query(array('number' => -1) );
							if ( ! empty( $user_query->get_results() ) ) {
								foreach ( $user_query->get_results() as $user ) {	
									echo '<option value="'.$user->ID.'"'. ($cleanup_current_author == $user->ID ? "selected" : "").' >'. $user->ID.' | '.$user->user_email.' </option>';
									
								}
							}
							
							
						?>
					</select>
				</div>  
				<div class="col-md-12"> <label>
					<input type="checkbox" name="cleanup_approve" id="cleanup_approve" value="yes" <?php echo ($cleanup_approve=="yes" ? 'checked': "" )  ; ?> />  <strong><?php esc_html_e( 'Approve', 'cleanup' )?></strong>
				</label>
				</div> 
			</div>	  
			<?php
			}
		?>
 		<br/>
		<div class="row">
 			<div class="col-md-12">
				<label>
					<?php
						$cleanup_featured= get_post_meta( $post->ID,'cleanup_featured', true );
					?>
					<label><input type="radio" name="cleanup_featured" id="cleanup_featured" value="featured" <?php echo ($cleanup_featured=="featured" ? 'checked': "" )  ; ?> />  <strong><?php esc_html_e( 'Featured (display on top)', 'cleanup' )?></strong></label>
					<br/>
					<label><input type="radio" name="cleanup_featured" id="cleanup_featured" value="Not-featured" <?php echo ($cleanup_featured=="Not-featured" ? 'checked': "" )  ; ?> />  <strong><?php esc_html_e( 'Not Featured', 'cleanup' )?></strong></label>
				</label>
			</div>
		</div>	
		<?php $nonce = wp_create_nonce('cleanup'); ?>
		<input type="hidden" name="cleanup_wpnonce" value="<?php echo esc_attr($nonce); ?>">
	</div>
</div>		