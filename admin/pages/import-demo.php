<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( 'Are you cheating:user Permission?' );
}
global $current_user; global $wpdb;	
$cleanup_directory_url=get_option('cleanup_ep_url');					
if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}
	$post_names = array('Therapy','Foxglove','Lake Merritt','Plant Technician', 'Grey Services','Tadu Ethiopian');
	$post_cat = array('Upholsery Cleaning','Apartment Cleaning','Move In/Move Out Cleaning','Commercial Cleaning','Office Cleaning');	
	$post_tag = array('Circuit breakers','Electrical panels','Generator','Switches','Electrical repair','Bathtub','Drain','Water heater','Shower','Carpet cleaning','Deep cleaning','Garbage removal','Kitchen cleaning','Oven cleaning','Regular cleaning','Window cleaning','Structural repair','Remodeling');
	$post_city = array('New York ','Dubai','Bretagne','New South Wales','London','Paris','Berlin');	
	$post_aear = array('Central Brooklyn','Chelsea','Midtown','Shoreditch' , 'Upper Manhattan','Berlin');
	$post_location = array('New York','London','Tokyo','Los Angeles' , 'Houston','Berlin');
	$latitude= array('40.7427704','40.7437704','40.7497704','40.7428704' , '40.7426704','40.7527704');
	$longitude=array('-73.99455039999998','-73.99355039999998','-73.99555039999998','-73.99655039999998' , '-73.99755039999998','-73.99459039999998');
	 $storeSchedule = [
        'Mon' => ['08:00 AM' => '05:00 PM'],
        'Tue' => ['08:00 AM' => '05:00 PM'],
        'Wed' => ['08:00 AM' => '05:00 PM'],
        'Thu' => ['08:00 AM' => '05:00 PM'],
        'Fri' => ['08:00 AM' => '05:00 PM']
    ];
	
$i=0;	
	foreach($post_names as $one_post){ 
	$my_post = array();
	$my_post['post_title'] = $one_post;
	$my_post['post_content'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	
	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	
	';	
	$my_post['post_status'] = 'publish';	
	$my_post['post_type'] = $cleanup_directory_url;	
	$newpost_id= wp_insert_post( $my_post );		
	
	$rand_keys = array_rand($post_cat, 2);	
	$new_post_arr=array();
	$new_post_arr[]=$post_cat[$rand_keys[0]];
	$new_post_arr[]=$post_cat[$rand_keys[1]];
	wp_set_object_terms( $newpost_id, $new_post_arr, $cleanup_directory_url.'-category');	
	
	// For Tag Save tag_arr	
	$rand_keys = array_rand($post_tag, 6);	
	$new_post_arr=array();
	$new_post_arr[]=$post_tag[$rand_keys[0]];
	$new_post_arr[]=$post_tag[$rand_keys[1]];
	$new_post_arr[]=$post_tag[$rand_keys[2]];
	$new_post_arr[]=$post_tag[$rand_keys[3]];
	$new_post_arr[]=$post_tag[$rand_keys[4]];
	$new_post_arr[]=$post_tag[$rand_keys[5]];
	
	wp_set_object_terms( $newpost_id, $new_post_arr, $cleanup_directory_url.'-tag');
	
	
	wp_set_object_terms( $newpost_id, $post_location[$i], $cleanup_directory_url.'-locations');
	
	update_post_meta($newpost_id, 'address', '129-133 West 22nd Street'); 
	$rand_keys = array_rand($post_aear, 1);	
	update_post_meta($newpost_id, 'local-area', $post_aear[$rand_keys]); 
	update_post_meta($newpost_id, 'latitude', $latitude[$i]); 
	update_post_meta($newpost_id, 'longitude',$longitude[$i]);
	$rand_keys = array_rand($post_city, 1);		
	update_post_meta($newpost_id, 'city', $post_city[$rand_keys]); 
	update_post_meta($newpost_id, 'postcode', '10011'); 
	update_post_meta($newpost_id, 'country', 'USA'); 
	update_post_meta($newpost_id, 'phone', '212245-4606'); 
	update_post_meta($newpost_id, 'fax', '212245-4606'); 
		
	update_post_meta($newpost_id, 'company_name', 'Clean Services'); 
	update_post_meta($newpost_id, 'contact-email', 'test@test.com'); 
	update_post_meta($newpost_id, 'contact_web', 'www.e-plugins.com'); 
	update_post_meta($newpost_id, 'listing_contact_source', 'new_value'); 	
	update_post_meta($newpost_id, 'youtube', 'dm7FQRr8tcg');  
	update_post_meta($newpost_id, 'price', '$500'); 
	update_post_meta($newpost_id, 'discount', '$250'); 
		
	$date = gmdate('Y-m-d', strtotime('+'.$i.' days'));
	
	
	// FAQ;
	update_post_meta($newpost_id, 'faq_title0', 'What types of cleaning services do you offer?');
	update_post_meta($newpost_id, 'faq_description0', 'Cleaning services can vary depending on the provider, but generally, they can offer a range of services such as regular cleaning, deep cleaning, move-in or move-out cleaning, post-construction cleaning, carpet cleaning, and more. Some providers may also offer specialized services like window cleaning or power washing.'); 
	
	update_post_meta($newpost_id, 'faq_title1', 'How much do cleaning services cost?');
	update_post_meta($newpost_id, 'faq_description1', 'The cost of cleaning services can vary depending on factors such as the size of the space, the level of cleaning required, and the frequency of service. Many cleaning services will offer a free estimate, so it is a good idea to get in touch with a provider to discuss your needs and get a quote.'); 
	
	update_post_meta($newpost_id, 'faq_title2', 'Do I need to be home during the cleaning service?');
	update_post_meta($newpost_id, 'faq_description2', 'This is entirely up to you. Some people prefer to be present during the cleaning service, while others prefer to schedule the cleaning when they are out of the house. If you choose to be away during the cleaning service, you may need to make arrangements for the cleaner to access your home.'); 
	
	update_post_meta($newpost_id, 'faq_title3', 'Are cleaning products included in the service?');
	update_post_meta($newpost_id, 'faq_description3', 'It depends on the provider. Some cleaning services will provide their own cleaning products, while others may require you to provide your own. It is a good idea to ask about this before booking a service so that you can be prepared.'); 
	
	update_post_meta($newpost_id, 'faq_title4', 'What if I am not satisfied with the cleaning service?');
	update_post_meta($newpost_id, 'faq_description4', 'Most cleaning services will have a satisfaction guarantee, which means that if you are not satisfied with the service, they will work to resolve the issue. It is important to communicate any concerns you have with the provider so that they can address them.'); 
	update_post_meta($newpost_id, 'faq_title5', 'How often should I schedule a cleaning service?');
	update_post_meta($newpost_id, 'faq_description5', 'The frequency of cleaning services will depend on your individual needs and lifestyle. Some people prefer to schedule regular weekly or bi-weekly cleanings, while others may only need occasional deep cleanings. It is important to consider factors such as the size of your space, the number of people living in your home, and any pets you may have when determining the frequency of cleaning services.');
	
	update_post_meta($newpost_id, '_opening_time', $storeSchedule);
	
	

 $i++; 
}

// /// **** Create Home Page ******	
	$page_title='Home';
	$page_name='home';
	$page_content='[depicter id="9"]';
	$my_post_form = array(
	'post_title'    => wp_strip_all_tags( $page_title),
	'post_name'    => wp_strip_all_tags( $page_name),
	'post_content'  => $page_content,
	'post_status'   => 'publish',
	'post_author'   =>  get_current_user_id(),	
	'post_type'		=> 'page',
	);
	$newpost_id= wp_insert_post( $my_post_form );	

?>