<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="col-xl-4 col-lg-4 col-md-6  col-sm-12 col-12  mt-4 mb-4 listingdata-col " id="<?php echo esc_html($i); ?>" >
	<div class=" card-border-round mb-2 bg-white" >											
			<?php	
			$listing_contact_source=get_post_meta($id,'listing_contact_source',true);
			if($listing_contact_source==''){$listing_contact_source='user_info';}	
			if($listing_contact_source=='new_value'){
				$company_name= get_post_meta($id, 'company_name',true);
				$company_address= get_post_meta($id, 'address',true);
				$company_web=get_post_meta($id, 'contact_web',true);
				$company_phone=get_post_meta($id, 'phone',true);
				$company_email= get_post_meta($id, 'contact-email',true);		
				
			}else{ 
				$company_name= get_user_meta($post_author_id,'full_name', true);
				$company_address= get_user_meta($post_author_id,'address', true);
				$company_web=get_user_meta($post_author_id,'website', true);
				$company_phone=get_user_meta($post_author_id,'phone', true);
				$company_logo=get_user_meta($post_author_id, 'cleanup_profile_pic_thum',true);
				$user_info = get_userdata( $post_author_id);
				$company_email =$user_info->user_email;	
			}	
	
	if(isset($active_archive_fields['image'])){				
				?>
				<div class="card-img-container">
					<a href="<?php echo get_the_permalink($id);?>"><img src="<?php echo esc_url($feature_img);?>" class="card-img-top-listing">					
						</a>
						<?php
						if(get_post_meta($id, 'cleanup_featured', true)=='featured'){
						?>
						<label class="btn-urgent-right"><?php  esc_html_e('Featured','cleanup'); ?></label> 
						<?php
						}
						?>
					<?php
						if(isset($active_archive_fields['favorite'])){	
							$saved_icon= cleanup_get_icon($active_archive_icon_saved, 'favorite','archive');
							if($saved_icon==''){
								$saved_icon='fa-regular fa-heart';
							}
						
								$user_ID = get_current_user_id();
								$favourites='no';
								if($user_ID>0){
									$my_favorite = get_post_meta($id,'_favorites',true);
									$all_users = explode(",", $my_favorite);
									if (in_array($user_ID, $all_users)) {
										$favourites='yes';
									}
								}
								if($favourites!='yes'){?>										
								<label class="btn-urgent-left btn-add-favourites listingbookmark" id="listingbookmark<?php echo esc_html($id); ?>"><i class="fa-regular fa-heart"></i></label>
								<?php
									}else{
								?>
								<label class="btn-urgent-left btn-added-favourites listingbookmark" id="listingbookmark<?php echo esc_html($id); ?>"><i class="fa-solid fa-heart"></i></label>
								<?php
								}													
						}
					?>
				</div>	
				<?php
				}
			?>
			<div class="card-body  card-body-min-height mt-1">
				
				<?php
					if(is_array($active_archive_fields)){
						foreach($active_archive_fields  as $field_key => $field_value){
							$saved_icon= cleanup_get_icon($active_archive_icon_saved, $field_key,'archive');
							if($field_key!='image'){
								switch ($field_key) {
									case "title":
								?>
								<p class=" p-0 ">
									<a href="<?php echo get_permalink($id); ?>" class="title m-0 p-0">
										<?php echo esc_html($post->post_title);?>
									</a>
								</p>													
								<?php
									break;
									case "tag":
									$tag_name='';
									$currenttag = $main_class->cleanup_get_tags_caching($id,$cleanup_directory_url);
									if(isset($currenttag[0]->slug)){														
										$cc=0;$tag_name='';
										foreach($currenttag as $c){		
											if($cc==0){
												$tag_name = $c->name;
											}else{
											  $tag_name = $tag_name .', '.$c->name;
											}
											$cc++;
										}
									}
									if($tag_name!=''){
									?>
									<p class="address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i> <?php echo esc_html(ucfirst(trim( $tag_name))); ?>
									</p> 
									<?php
									}
									break;
									case "category":
									$currentCategory = $main_class->cleanup_get_categories_caching($id,$cleanup_directory_url);
									$cat_name2='';
									$cc=0;
									if(isset($currentCategory[0]->slug)){										
									foreach($currentCategory as $c){								
										$saved_icon_cat= cleanup_get_cat_icon($c->term_id);
										if($cc==0){
											$cat_name2 = '<i class="'.esc_html($saved_icon_cat).'"></i>'.$c->name;
										}else{
											$cat_name2 = $cat_name2 .', <i class="'.esc_html($saved_icon_cat).'"></i>'.$c->name;
										}
										
										$cc++;
									}
									}
									if($cat_name2 !=''){
									?>
									<p class=" address">
										<?php echo wp_kses($cat_name2,'post') ; ?>
									</p>	
									<?php
									}
									break;
									case "location":
									$currentlocation = $main_class->cleanup_get_location_caching($id,$cleanup_directory_url);
									$locations='';
									if(isset($currentlocation[0]->slug)){										
									foreach($currentlocation as $c){
										$locations = $locations .' '.$c->name;
									}
									}
									if($locations !=''){
										$dir_data['locations']= $locations;
									?>
									<p class=" address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo esc_html(ucfirst($locations)); ?>
									</p>	
									<?php
									}
									break;	
									case "post_date": 
									?>
									<p class=" address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo get_the_date( 'd M-Y ', $id ); ?>
									</p>
									<?php																
									break;
									case "price":
										if( get_post_meta($id, 'price', true)!='' OR  get_post_meta($id, 'discount', true)!=''){
									?>
									<p class=" card-text-price ">
										<i class="<?php echo esc_html($saved_icon); ?>"></i>	
										<?php if(get_post_meta($id, 'discount', true)!=''){ ?>
											<strike><?php echo esc_html( get_post_meta($id, 'price', true) ); ?></strike>
											<span class="ml-1"><?php echo esc_html( get_post_meta($id, 'discount', true) ); ?></span>
										<?php
											}else{ ?>
											<?php echo esc_html( get_post_meta($id, 'price', true) ); ?>											
										<?php	
											}
										?>
									</p>
									<?php
										}
									break;
									
									case "contact_email": 
									?>
									<p class=" address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo esc_html( $company_email ); ?>
									</p>
									<?php																
									break;
									
									case "phone": 
									?>
									<p class=" address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo esc_html( $company_phone ); ?>
									</p>
									<?php																
									break;
									case "address": 
									?>
									<p class=" address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo esc_html( $company_address ); ?>
									</p>
									<?php																
									break;
									case "open_status": 
									 $openStatus='';
									 $openStatus = cleanup_check_time($id);
									?>
									<p class=" address">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><strong class="small-heading  <?php echo($openStatus=='Open Now'?" open-green":' close-red') ?>"><?php echo esc_html($openStatus) ; ?></strong>
									</p>
									<?php																
									break;
									
									case "review": 
									?>
									<p class=" review-listing ">
										<?php
												$post_type='cleanup_review'; $publish='publish';
											$total_review_point=0;
											
												$author_reviews = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type =%s  and post_author=%s 	and post_status=%s ORDER BY ID DESC",$post_type,$id,$publish));
												
											$total_reviews=count($author_reviews);
											if($total_reviews>0){
												foreach ( $author_reviews as $review )
												{													
													$review_val2=(float)get_post_meta($review->ID,'review_value',true);
													$total_review_point=$total_review_point+ $review_val2;
												}
											}
					
											$avg_review=0;											
											if($total_review_point>0){
												$avg_review= (float)$total_review_point/(float)$total_reviews;
											}
											$saved_listing_avg_rating=get_post_meta($id,'review',true);
											if($avg_review!=$saved_listing_avg_rating){
												update_post_meta($id,'review',$avg_review);
											}
											
										if($avg_review >=.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=.1){ ?><i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
										<?php
										if($avg_review >=1.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=1.1){ ?><i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
										<?php
										if($avg_review >=2.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=2.1){ ?><i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
										<?php
											if($avg_review >=3.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=3.1){ ?>
										<i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
										<?php
										if($avg_review >=4.75 ){ ?><i class="fas fa-star off-white"></i><?php }elseif($avg_review >=4.1){ ?><i class="fas fa-star-half-alt  half-off-white"></i> <?php }else{?> <i class="far fa-star off-white"></i><?php } ?>
				
										
									</p>
									<?php																
									break;
																			
									default:
									if(get_post_meta($id,$field_key,true)!=''){
										$custom_meta_data=get_post_meta($id,$field_key,true);
										if(is_array($custom_meta_data)){
											$full_data='';
											foreach( $custom_meta_data as $one_data){
												$full_data=$full_data.' '.$one_data;
											}
											$custom_meta_data=$full_data;
										}
									?>
									<p class=" address ">
										<i class="<?php echo esc_html($saved_icon); ?>"></i><?php echo esc_html($custom_meta_data);?>
									</p>
									<?php	
									}
									break;
								}										
							}									
						}
					}								
				?>
				<?php								
					$dir_style5_email='yes';
					$dirpro_email_button=get_post_meta($id,'dirpro_email_button',true);
					if($dirpro_email_button==""){$dirpro_email_button='yes';}
					if($dir_style5_email=="yes" AND $dirpro_email_button=='yes'){
						$email_button='yes';
						}else{
						$email_button='no';
					}
				?>
				<p class="client-contact">									
					<?php									
						$saved_icon= cleanup_get_icon($active_archive_icon_saved, 'contact_button','archive');
						if(isset($active_archive_fields['contact_button'])){
							if($email_button=='yes'){ ?>
							<button type="button" class="btn btn-small-ar mt-1" onclick="cleanup_call_popup('<?php echo esc_html($id);?>')"><i class="<?php echo esc_html($saved_icon); ?>"></i><?php esc_html_e( 'Contact', 'cleanup' ); ?></button>
							<?php
							}
						}
						if(isset($active_archive_fields['booking_button'])){
							if($email_button=='yes'){ ?>
							<button type="button" class="btn btn-small-ar mt-1" onclick="cleanup_listing_booking_popup('<?php echo esc_html($id);?>')"><i class="<?php echo esc_html($saved_icon); ?>"></i><?php esc_html_e( 'Booking', 'cleanup' ); ?></button>
							<?php
							}
						}
						if(isset($active_archive_fields['web_link'])){
							$saved_icon= cleanup_get_icon($active_archive_icon_saved, 'web_link','archive');
							if(!empty($company_web)){
							
						?>
						<a type="button" href="<?php echo esc_url($company_web); ?>" target="_blank" class=" btn btn-small-ar  mt-1"  ><i class="<?php echo esc_html($saved_icon); ?>"></i><?php esc_html_e( 'Website', 'cleanup' ); ?></a>
						<?php
							}
						}
					?>
				</p>
			</div>
					
		</div>
	</div>
	