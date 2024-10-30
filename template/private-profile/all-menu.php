<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<ul>
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_menu_listinghome' ) ) {
			$account_menu_check= get_option('cleanup_menu_listinghome');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="">
			<a href="<?php echo get_post_type_archive_link( $cleanup_directory_url ) ; ?>">
				<i class="fas fa-home"></i>
			<?php  esc_html_e('Listing Search','cleanup');	 ?> </a>
		</li>
		<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_mylevel' ) ) {
			$account_menu_check= get_option('cleanup_mylevel');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='level'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=level">
				<i class="fas fa-user-clock"></i>
			<?php  esc_html_e('Membership','cleanup');	 ?> </a>
		</li>
		<?php
		}
	?>
	
	
	
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_menusetting' ) ) {
			$account_menu_check= get_option('cleanup_menusetting');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='setting'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=setting">
				<i class="fas fa-user-cog"></i>
			<?php  esc_html_e('Edit Profile','cleanup');?> </a>
		</li>
		<?php
		}
	?>
	
		
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_menuallpost' ) ) {
			$account_menu_check= get_option('cleanup_menuallpost');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='all-post'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=all-post">
				<i class="far fa-copy"></i>
			<?php  esc_html_e('Manage Listings','cleanup');?>  </a>
		</li>
		<?php
		}
	?>	
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_messageboard' ) ) {
			$account_menu_check= get_option('cleanup_messageboard');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='messageboard'? 'active':''); ?> ">
		<a href="<?php echo get_permalink(); ?>?&profile=messageboard">
			<i class="far fa-envelope"></i>
		<?php  esc_html_e('Message','cleanup');?></a>
	</li>
	<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_booking' ) ) {
			$account_menu_check= get_option('cleanup_booking');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='booking'? 'active':''); ?> ">
		<a href="<?php echo get_permalink(); ?>?&profile=booking">
			<i class="fa-regular fa-calendar-days"></i>
		<?php  esc_html_e('Booking','cleanup');?></a>
		</li>
	<?php
		}
	?>
	
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_notification' ) ) {
			$account_menu_check= get_option('cleanup_notification');
		}
		if($account_menu_check!='yes'){
		?>
	<li class="<?php echo ($active=='notification'? 'active':''); ?> ">
		<a href="<?php echo get_permalink(); ?>?&profile=notification">
			<i class="far fa-bell"></i>
		<?php  esc_html_e('Listing Notifications','cleanup');?> </a>
	</li>
	<?php
		}
	?>
	
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_author_bookmarks' ) ) {
			$account_menu_check= get_option('cleanup_author_bookmarks');
		}
		if($account_menu_check!='yes'){ 
		?>
		<li class="<?php echo ($active=='author_bookmarks'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=author_bookmarks">
				<i class="fas fa-user-check"></i>
			<?php   esc_html_e('Saved Author','cleanup');?> </a>
		</li>
		<?php
		}
	?>
	<?php
		$account_menu_check= '';
		if( get_option('cleanup_listing_bookmarks' ) ) {
			$account_menu_check= get_option('cleanup_listing_bookmarks');
		}
		if($account_menu_check!='yes'){
		?>
		<li class="<?php echo ($active=='listing_bookmark'? 'active':''); ?> ">
			<a href="<?php echo get_permalink(); ?>?&profile=listing_bookmark">
				<i class="fas fa-chalkboard-teacher"></i>
			<?php   esc_html_e('Saved Listing','cleanup');?> </a>
		</li>
		<?php
		}
	?>
	
	
	
	
	<li class="<?php echo ($active=='log-out'? 'active':''); ?> ">
		<a href="<?php echo wp_logout_url( home_url() ); ?>" >
			<i class="fas fa-sign-out-alt"></i>
			<?php  esc_html_e('Sign out','cleanup');?>
		</a>
	</li>
</ul>