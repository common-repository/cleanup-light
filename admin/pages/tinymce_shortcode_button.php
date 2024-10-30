<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php	
	function cleanup_loadMyBlock() {
  wp_enqueue_script(
    'cleanup-block',
    cleanup_ep_URLPATH . 'admin/files/js/gutenberg-block.js',
    array('wp-blocks','wp-editor'),
    true
  );
}
   
add_action('enqueue_block_editor_assets', 'cleanup_loadMyBlock');

// Block Category
function cleanup_filter_block_categories_when_post_provided( $block_categories, $editor_context ) {
    if ( ! empty( $editor_context->post ) ) {
        array_push(
            $block_categories,
            array(
                'slug'  => 'cleanup-category',
				'icon'  => 'dashicons-before dashicons-universal-access-alt',
                'title' => esc_html__( 'CleanUp', 'cleanup' ),                
            )
        );
    }
    return $block_categories;
}
 
add_filter( 'block_categories_all', 'cleanup_filter_block_categories_when_post_provided', 10, 2 );
