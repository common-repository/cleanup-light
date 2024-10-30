<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	$cleanup_directory_url=get_option('cleanup_ep_url');					
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	global $wpdb, $post;
	$main_class = new cleanup_eplugins;
	//Strat  Subscription remainder email ********************************
	$membership_users = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->users "));
	$total_package=count($membership_users);
	if(sizeof($membership_users)>0){
		$i=0;
		foreach ( $membership_users as $row )
		{	
			$user_id= $row->ID;
			$reminder_day = get_option( 'cleanup_reminder_day');
			$exp_date= get_user_meta($user_id, 'cleanup_exprie_date', true);
			$date2 = gmdate("Y-m-d");
			$date1 = $exp_date;
			$diff = abs(strtotime($date2) - strtotime($date1));
			$days = floor($diff / (60*60*24));
			if( $reminder_day >= $days ){
				$exprie_send_email_date= get_user_meta($user_id, 'exprie_send_email_date', true);
				if(strtotime($exprie_send_email_date) != strtotime($exp_date) || $exprie_send_email_date=='' ){
					// Start Email Action
					$email_body = get_option( 'cleanup_reminder_email');
					$signup_email_subject = get_option( 'cleanup_reminder_email_subject');			
					$admin_mail = get_option('admin_email');	
					if( get_option( 'cleanup_admin_email' )==FALSE ) {
						$admin_mail = get_option('admin_email');						 
						}else{
						$admin_mail = get_option('cleanup_admin_email');								
					}						
					$wp_title = get_bloginfo();
					$user_info = get_userdata( $user_id);											
					$email_body = str_replace("[expire_date]", $exp_date, $email_body);	
					$cilent_email_address =$user_info->user_email;			
					$auto_subject=  $signup_email_subject; 
					$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Content-Type: text/html");
					$h = implode("\r\n", $headers) . "\r\n";
					wp_mail($cilent_email_address, $auto_subject, $email_body, $h);
					// End Email Action
					update_user_meta($user_id, 'exprie_send_email_date', $exp_date);
				}	
			}	
		}
	}	
	//End Subscription remainder email *************************
	// Start Hide Directory******************
	$publish='publish';	
	$all_post = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type =%s  and post_status=%s", $cleanup_directory_url,$publish));
	$total_post=count($all_post);									
	if($total_post>0){
		$i=0;
		foreach ( $all_post as $row )								
		{			
			$dir_id=$row->ID;
			$post_author_id=$row->post_author;	
			$main_class->check_listing_expire_date($dir_id, $post_author_id,$cleanup_directory_url);					
		}
	}										
// End  Hide Directory******************
// Start Notification***************
	
	
	$email_body_main = get_option( 'cleanup_notification_email');
	$contact_email_subject =  get_option( 'cleanup_notification_email_subject');
	$admin_mail = get_option('admin_email');
	$wp_title = get_bloginfo();
			
	$args_today = array(
	'post_type' => $cleanup_directory_url, // enter your custom post type
	'post_status' => 'publish',
	'posts_per_page'=> '-1',
	'date_query' => array(
        array(
            'year' => gmdate('Y'),
            'month' => gmdate('m'),
            'day' => gmdate('d'),
        ),
	 )
	);
		
	$today_posts = new WP_Query( $args_today );
	if ( $today_posts->have_posts() ) :
	while ( $today_posts->have_posts() ) : $today_posts->the_post();
		
			$dir_id=get_the_ID();
			$dir_detail= get_post($dir_id); 
			$job_name= $dir_detail->post_title; 
			$currentCategory=wp_get_object_terms( $dir_id, $directory_url.'-category');
			$deadline='';
			if(get_post_meta($dir_id,'deadline', true)!=''){
				$deadline =gmdate('M d, Y', strtotime(get_post_meta($dir_id,'deadline', true)));
			}
			$job_link= '<a href="'.get_the_permalink($dir_id).'">'.$dir_detail->post_title.'</a>';	
			$args_user = array();
			$args_user['number']='999999999';
			$args_user['orderby']='display_name';
			$args_user['order']='ASC'; 
			
			$user_query = new WP_User_Query( $args_user );
			// User Loop		
			
			if ( ! empty( $user_query->results ) ) {
				foreach ( $user_query->results as $user ) {
					$job_notifications_all='';
					$job_notifications_all= get_user_meta($user->ID ,'listing_notifications',true);
					$will_send_email='no';	
					if(is_array($job_notifications_all)){
						foreach($currentCategory as $c){			
							$c->slug;
							if(in_array($c->slug, $job_notifications_all)){
								$will_send_email='yes';
							}
						}
					}
					
					if($will_send_email=='yes'){  
						$email_body	=$email_body_main;		
						$full_name =get_user_meta($user->ID,'full_name',true);
						$cilent_email_address =$user->user_email;
						$email_body = str_replace("[user_name]", $full_name, $email_body);
						$email_body = str_replace("[iv_member_listing_name]",$listing_name, $email_body);
						$email_body = str_replace("[iv_member_listing_deadline]", $deadline, $email_body);
						$email_body = str_replace("[iv_member_listing_url]",$listing_link, $email_body); 	
						$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Reply-To: ".$admin_mail  ,"Content-Type: text/html");
						$h = implode("\r\n", $headers) . "\r\n";
						wp_mail($cilent_email_address, $contact_email_subject, $email_body, $h);
						
					}
				}
			}	
		
		endwhile;
	endif;
	
// End Notification