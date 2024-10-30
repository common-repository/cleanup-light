<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php
	global 	$cleanup_directory_url;
$cleanup_directory_url=get_option('cleanup_ep_url');					
if($cleanup_directory_url==""){$cleanup_directory_url='cleaning-service';}	

	
function cleanup_taxonomy_add_custom_field() {
	$nonce = wp_create_nonce('cleanup');
    ?>
    <div class="form-field term-image-wrap">
        <label for="cat-image"><?php esc_html_e('Image[Best: 250px X 380px]','cleanup');?></label>
        <p><a href="#" class="aw_upload_image_button button button-secondary" id="upload_image_btn"><?php esc_html_e('Upload Image','cleanup');?></a></p>
		<input type="hidden" name="cleanup_wpnonce" value="<?php echo esc_attr($nonce); ?>">
        <input type="text" name="category_image_url" id="category_image_url"  value="" size="40" />
    </div>
    <?php
}
add_action( $cleanup_directory_url.'-locations_add_form_fields', 'cleanup_taxonomy_add_custom_field', 10, 2 );
 
function cleanup_taxonomy_edit_custom_field($term) {
    $image = get_term_meta($term->term_id, 'cleanup_term_image', true);
	$nonce = wp_create_nonce('cleanup');
    ?>
    <tr class="form-field term-image-wrap">
        <th scope="row"><label for="category_image_url"><?php esc_html_e('Image [Best: 250px X 380px]','cleanup');?></label></th>
        <td>
            <p><a href="#" class="aw_upload_image_button button button-secondary" id="upload_image_btn"><?php esc_html_e('Upload Image','cleanup');?> </a>
				
				<img src="<?php echo esc_url($image); ?>" id="cleanup_term_image_dis" width="100px">
			</p>
			
			<br/>
			
			<input type="hidden" name="cleanup_wpnonce" value="<?php echo esc_attr($nonce); ?>">
            <input type="text" name="category_image_url"  id="category_image_url" value="<?php echo esc_url($image); ?>" size="40" />
        </td>
    </tr>
    <?php
}
add_action( $cleanup_directory_url.'-locations_edit_form_fields', 'cleanup_taxonomy_edit_custom_field', 10, 2 );

// Save data
add_action('created_'.$cleanup_directory_url.'-locations', 'cleanup_save_term_image', 10, 2);
function cleanup_save_term_image($term_id, $tt_id) {
	if ( ! wp_verify_nonce(  sanitize_text_field($_POST['cleanup_wpnonce']), 'cleanup' ) ) {
			wp_die( 'Are you cheating:wpnonce?' );
	}	
    if (isset($_POST['category_image_url']) && '' !== $_POST['category_image_url']){
        $group = sanitize_url($_POST['category_image_url']);
        add_term_meta($term_id, 'cleanup_term_image', $group, true);
    }
}

///Now save the edited value
add_action('edited_'.$cleanup_directory_url.'-locations', 'cleanup_update_image_upload', 10, 2);
function cleanup_update_image_upload($term_id, $tt_id) {
	if ( ! wp_verify_nonce(  sanitize_text_field($_POST['cleanup_wpnonce']), 'cleanup' ) ) {
			wp_die( 'Are you cheating:wpnonce?' );
	}	
    if (isset($_POST['category_image_url']) && '' !== $_POST['category_image_url']){
        $group = sanitize_url($_POST['category_image_url']);
        update_term_meta($term_id, 'cleanup_term_image', $group);
    }
}

// Js add
function cleanup_image_uploader_enqueue() {
    global $typenow,$cleanup_directory_url;	
    if( ($typenow == $cleanup_directory_url) ) { 
		wp_enqueue_media();
        wp_register_script( 'cleanup_meta-image', cleanup_ep_URLPATH . 'admin/files/js/meta-media-uploader.js', array( 'jquery' ) );
        wp_localize_script( 'cleanup_meta-image', 'meta_image',
            array(
                'title' => 'Upload an Image',
                'button' => 'Use this Image',
            )
        );
        wp_enqueue_script( 'cleanup_meta-image' );
    }
}
add_action( 'admin_enqueue_scripts', 'cleanup_image_uploader_enqueue' );