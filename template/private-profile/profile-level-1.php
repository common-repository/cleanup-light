<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	global $wpdb;
	global $current_user;
	$currencyCode= get_option('cleanup_api_currency');
	$iv_gateway = get_option('cleanup_payment_gateway');
	if($iv_gateway=='woocommerce'){
		if ( class_exists( 'WooCommerce' ) ) {
			$api_currency= get_option( 'woocommerce_currency' );
			$api_currency= get_woocommerce_currency_symbol( $api_currency );
			$currencyCode=$api_currency;
		}
	}
?>
<div class="mt-3 row ">	
	<div class="col-md-6">
		<span class="toptitle-sub"><?php esc_html_e('Membership', 'cleanup'); ?></span>
	</div>
	<div class="col-md-6">
		<ul class="nav nav-pills  float-right" id="pills-tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#tab_current" role="tab" aria-controls="pills-home" aria-selected="true"><?php    esc_html_e('Current','cleanup');?></a>
			</li>
			
			
		</ul>
	</div>
	<div class="col-md-12"> <p class="border-bottom"> </p></div>
</div>		
<div class="tab-content">
	<div class="tab-pane active" id="tab_current">
		<?php
			global $wpdb, $post;
			$iv_gateway = get_option('cleanup_payment_gateway');
			$cleanup_pack='cleanup_pack'; $draft='draft';
			$membership_pack = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = %s  and post_status=%s ",$cleanup_pack,$draft ));
			$total_package=count($membership_pack);
			$package_id=get_user_meta($current_user->ID,'cleanup_package_id',true);
			$iv_pac=$package_id;
		?>
		<table class="table">
			<tr>
				<td  width="60%">
					<?php    esc_html_e('Current Package','cleanup')	;?>
				</td>
				<td width="40%">
					<?php
						if($package_id!=""){
							$post_p = get_post($package_id);
							if(!empty($post_p)){
								$recurring_text='  ';
								if(get_post_meta($package_id, 'cleanup_package_cost', true)=='0' or get_post_meta($package_id, 'cleanup_package_cost', true)==""){
									$amount= 'Free';
									}else{
									$amount= $api_currency.' '. get_post_meta($package_id, 'cleanup_package_cost', true);
									$amount_only= get_post_meta($package_id, 'cleanup_package_cost', true);
								}
								$recurring_text=$amount;						
								$recurring= get_post_meta($package_id, 'cleanup_package_recurring', true);
								if($recurring == 'on'){
									$amount= $api_currency.' '. get_post_meta($package_id, 'cleanup_package_recurring_cost_initial', true);
									$amount_only= get_post_meta($package_id, 'cleanup_package_recurring_cost_initial', true);
									$count_arb=get_post_meta($package_id, 'cleanup_package_recurring_cycle_count', true);
									if($count_arb=="" or $count_arb=="1"){
										$recurring_text=$recurring_text.' per '.$count_arb.' '.get_post_meta($package_id, 'cleanup_package_recurring_cycle_type', true).esc_html__(', Auto recurring ','cleanup') ;
										$recurring_text=$recurring_text;
										}else{
										$recurring_text=$recurring_text.' per '.$count_arb.' '.get_post_meta($package_id, 'cleanup_package_recurring_cycle_type', true).'s'.esc_html__(', Auto recurring ','cleanup') ;
										$recurring_text=$recurring_text;
									}
									}else{ 
									$recurring_text=$recurring_text.', '.esc_html__('Package Expire After ','cleanup' ).get_post_meta($package_id, 'cleanup_package_initial_expire_interval', true).' '.get_post_meta($package_id, 'cleanup_package_initial_expire_type', true);
								}
								echo esc_html($post_p->post_title).' | '.esc_html($recurring_text);
								}else{
								echo'None';
							}
							}else{
							echo'None';
						}
					?>
				</td>
			</tr>
			<tr>
				<td width="60%" >
					<?php    esc_html_e('Package Amount','cleanup')	;?>
				</td>
				<td width="40%" >
					<?php
						$recurring_text='  '; $amount= '';
						if(get_post_meta($package_id, 'cleanup_package_cost', true)=='0' or get_post_meta($package_id, 'cleanup_package_cost', true)==""){
							$amount= 'Free';
							}else{
							$amount= $currencyCode.' '. get_post_meta($package_id, 'cleanup_package_cost', true);
						}
						$recurring= get_post_meta($package_id, 'cleanup_package_recurring', true);
						if($recurring == 'on'){
							$amount= $currencyCode.' '. get_post_meta($package_id, 'cleanup_package_recurring_cost_initial', true);
							$count_arb=get_post_meta($package_id, 'cleanup_package_recurring_cycle_count', true);
							if($count_arb=="" or $count_arb=="1"){
								$recurring_text=" per ".' '.get_post_meta($package_id, 'cleanup_package_recurring_cycle_type', true);
								}else{
								$recurring_text=' per '.$count_arb.' '.get_post_meta($package_id, 'cleanup_package_recurring_cycle_type', true).'s';
							}
							}else{
							$recurring_text=' &nbsp; ';
						}
						echo esc_html($amount);
					?>
				</td>
			</tr>
			<tr>
				<td width="60%" >
					<?php    esc_html_e('Package Type','cleanup')	;?>
				</td>
				<td width="40%" >
					<?php
						echo esc_html($amount).' '.esc_html($recurring_text);
					?>
				</td>
			</tr>
			<tr>
				<td width="60%" >
					<?php    esc_html_e('Payment Status','cleanup')	;?>
				</td>
				<td width="40%" >
					<?php
						echo get_user_meta($current_user->ID, 'cleanup_payment_status', true);
					?>
				</td>
			</tr>
			<tr>
				<td width="60%" >
					<?php    esc_html_e('User Role','cleanup')	;?>
				</td>
				<td width="40%">
					<?php
						$user = new WP_User( $current_user->ID );
						if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
							foreach ( $user->roles as $role )
							echo ucfirst($role);
						}
					?>
				</td>
			</tr>
			<?php
				if(get_user_meta($current_user->ID, 'cleanup_payment_status', true)=='cancel'){
				?>
				<tr>
					<td width="60%" >
						<?php    esc_html_e('Exprie Date','cleanup');?>
					</td>
					<td width="40%" >
						<?php
							if($recurring == 'on'){
								$exp_date= get_user_meta($current_user->ID, 'cleanup_exprie_date', true);
								echo gmdate('d-M-Y',strtotime($exp_date));
								}else{
								$exp_date= get_user_meta($current_user->ID, 'cleanup_exprie_date', true);
								echo gmdate('d-M-Y',strtotime($exp_date));
							}
						?>
					</td>
				</tr>
				<?php
					}else{
				?>
				<tr>
					<td width="60%" >
						<?php    esc_html_e('Next Payment Date','cleanup')	;?>
					</td>
					<td width="40%" >
						<?php
							if($recurring == 'on'){
								$exp_date= get_user_meta($current_user->ID, 'cleanup_exprie_date', true);
								echo ($exp_date!=""? gmdate('d-M-Y',strtotime($exp_date)):'');
								}else{
								$exp_date= get_user_meta($current_user->ID, 'cleanup_exprie_date', true);
								echo ($exp_date!=""? gmdate('d-M-Y',strtotime($exp_date)):'');
							}
						?>
					</td>
				</tr>
				<?php
				}
			?>
		</table>
	</div>

</div>