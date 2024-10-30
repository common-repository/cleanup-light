<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	$cleanup_directory_url=get_option('cleanup_ep_url');					
	if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	global $post;

	
	add_action( 'manage_cleanup_message_posts_custom_column' , 'cleanup_custom_cleanup_message_column' );
	add_filter( 'manage_edit-cleanup_message_columns',  'cleanup_set_custom_edit_cleanup_message_columns'  );
	function cleanup_set_custom_edit_cleanup_message_columns($columns) {				
		$columns['Message'] = esc_html__('Message','cleanup');
		$columns['email'] = esc_html__('Email','cleanup');
		$columns['phone'] = esc_html__('Phone','cleanup');		
		return $columns;
	}
	function cleanup_custom_cleanup_message_column( $column ) {
		global $post;
		switch ( $column ) {
			case 'Message' :		
				echo esc_html($post->post_content);
			break; 
			case 'phone' :			
				echo get_post_meta($post->ID,'from_phone',true);  
			break;
			case 'email' :
				echo get_post_meta($post->ID,'from_email',true);  
			break;
			
			
		}
	}	
	
?>