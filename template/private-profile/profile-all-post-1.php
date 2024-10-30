<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	$profile_url=get_permalink();
	global $current_user;
	$user = $current_user->ID;
	$message='';
	if(isset($_GET['delete_id']))  {
		$post_id=sanitize_text_field($_GET['delete_id']);
		$post_edit = get_post($post_id);
		if($post_edit){
			if($post_edit->post_author==$current_user->ID){
				wp_delete_post($post_id);
				delete_post_meta($post_id,true);
				$message=esc_html__("Deleted Successfully",'cleanup');
			}
			if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
				wp_delete_post($post_id);
				delete_post_meta($post_id,true);
				$message=esc_html__("Deleted Successfully",'cleanup');
			}
		}
	}
	$cleanup_directory_url=get_option('cleanup_ep_url');
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	$main_class = new cleanup_eplugins;
?>

<div class="mt-3 row ">	
	<div class="col-md-6">
		<span class="toptitle-sub"><?php esc_html_e('My Listings', 'cleanup'); ?></span>
	</div>
	<div class="col-md-6">
		<ul class="nav nav-pills  float-right" id="pills-tab" role="tablist">
			<li class="nav-item">
				 <a class="nav-link active" id="pills-all-tab" data-toggle="pill" href="#tab_all" role="tab" aria-controls="pills-home" aria-selected="true"><?php    esc_html_e('All listings','cleanup')	;?></a>
			</li>
			<li class="nav-item">
				 <a class="nav-link " id="pills-add-tab" data-toggle="pill" href="#tab_add_new" role="tab" aria-controls="pills-home" ><?php    esc_html_e('Add New','cleanup')	;?></a>
				 
				
			</li>
			
		</ul>
	</div>
	<div class="col-md-12"> <p class="border-bottom"> </p></div>
</div>		

	
<div class="clearfix mb-3"></div>
<div class="tab-content">
	<div class="tab-pane active" id="tab_all">
			<div class="list">
			<?php
				global $wpdb;
				$per_page=10;$row_strat=0;$row_end=$per_page;
				$current_page=0 ;
				if(isset($_REQUEST['cpage']) and $_REQUEST['cpage']!=1 ){
					$current_page=sanitize_text_field($_REQUEST['cpage']); $row_strat =($current_page-1)*$per_page;
					$row_end=$per_page;
				}
				$publish='publish';$pending='pending';$draft='draft';
				if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
					$sql=$wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_type IN (%s)  and post_status IN (%s,%s,%s )  ORDER BY `ID` DESC", $cleanup_directory_url,$publish,$pending,$draft);	
					
					}else{
					$sql= $wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type IN (%s)  and post_author=%s and post_status IN (%s,%s,%s )  ORDER BY `ID` DESC", $cleanup_directory_url, $current_user->ID,$publish,$pending,$draft );
					
					
				}
				$authpr_post = $wpdb->get_results($sql);
				$total_post=count($authpr_post);
				if($total_post>0){
				?>
				<table id="listing-manage" class="table tbl-listing" >
					<thead>
						<tr class="">
							<th><?php  esc_html_e('Title','cleanup');?></th>
						</tr>
					</thead>
					<?php
						$i=0;
						foreach ( $authpr_post as $row )
						{
						?>
						<tr class="my-listing-item">
							<td>
								<div class="align-item-center row">
									<div class="text-left col-md-9 col-9">
										<span class="toptitle-sub"><a href="<?php echo get_permalink($row->ID); ?>"><?php echo esc_html($row->post_title); ?></a></span>
										<div class="meta-listing"><span class="location"> 
										
										<i class="fas fa-calendar-alt"></i>
											<?php  esc_html_e('Posted','cleanup');?>
										<?php echo gmdate('M d, Y',strtotime($row->post_date)); ?>
										<?php
											$exp_date= get_user_meta($current_user->ID, 'listing_exprie_date', true);
											if($exp_date!=''){
												$package_id=get_user_meta($current_user->ID,'cleanup_package_id',true);
												$dir_hide= get_post_meta($package_id, 'cleanup_package_hide_exp', true);
												if($dir_hide=='yes'){?>
												<span> <i class="fas fa-calendar-alt"></i>		
													<?php
														esc_html_e('Expiring','cleanup'); echo" : ";
														echo gmdate('M d, Y',strtotime($exp_date));
													}?>
											</span>
											<?php
											}
										?>
										</span>
										</div>
										
										<div class="location">
											<?php
											$currentCategory = $main_class->cleanup_get_categories_caching($row->ID,$cleanup_directory_url);
											$saved_icon='';
											$cat_name2='';
											$i=0;
											if(isset($currentCategory[0]->slug)){										
												foreach($currentCategory as $c){							
													if(trim($saved_icon)==''){
														$saved_icon= cleanup_get_cat_icon($c->term_id);
													}
													if($i==0){
														$cat_name2 = $c->name;
														}else{
														$cat_name2 = $cat_name2 .' / '.$c->name;
													}
													$i++;
												}
											}
											?>
											
										<span> <?php echo esc_html($cat_name2); ?> </span>
												
											
										</div>
										<div class="location">
											<i class="fas fa-eye"></i>
											<?php  esc_html_e('View Count','cleanup');?> :
											<?php echo esc_attr(get_post_meta($row->ID,'listing_views_count',true)); ?> 												
										</div>
										<?php $post_ststus=get_post_status($row->ID);  ?>
										<span class="poststatus <?php echo ($post_ststus=='publish'?'greencolor-text':''); ?> "> 
												<?php 
												echo ucfirst($post_ststus);  ?>
										</span>
									</div>
									<div class="listing-func_manage_listing col-md-3 col-3 text-right">
										<?php
											$edit_post= $profile_url.'?&profile=post-edit&post-id='.$row->ID;
										?>
										<a href="<?php echo esc_url($edit_post); ?>"  class="btn btn-small-ar mb-2" ><i class="fas fa-pencil-alt"></i></a>
										<a href="<?php echo esc_url($profile_url).'?&profile=all-post&delete_id='.$row->ID ;?>"  onclick="return confirm('Are you sure to delete this post?');"  class="btn btn-small-ar mb-2"><i class="far fa-trash-alt"></i>
										</a>
									</div>
								</div>
							</td>
						</tr>
						<?php
						}
					?>
				</table>
				<?php
				}
			?>
		</div>
	
	</div>
	<div class="tab-pane" id="tab_add_new">
		<?php
		include( cleanup_ep_template. 'private-profile/profile-new-post-1.php');
		?>
	</div>
</div>	
