"use strict";
var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    blockStyle = {};

registerBlockType('cleanup/price-table', {
	title: 'Pricing Table',
	icon: 'dashicons dashicons-money-alt ',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_price_table]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_price_table]' );
    },
});


registerBlockType('cleanup/registration-form', {
	title: 'Registration Form',
	icon: 'dashicons dashicons-forms',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_form_wizard]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_form_wizard]' );
    },
});

registerBlockType('cleanup/my-account', {
	title: 'My Account',
	icon: 'dashicons dashicons-universal-access',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_profile_template]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_profile_template]' );
    },
});



registerBlockType('cleanup/author-profile-public', {
	title: 'Author profile',
	icon: 'dashicons dashicons-bank',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_profile_public]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_profile_public]' );
    },
});

registerBlockType('cleanup/login', {
	title: 'Login Form',
	icon: 'dashicons dashicons-unlock',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_login]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_login]' );
    },
});

registerBlockType('cleanup/author-directory', {
	title: 'Author Directory',
	icon: 'dashicons dashicons-admin-home',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_author_directory]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_author_directory]' );
    },
});


registerBlockType('cleanup/categories-image', {
	title: 'Categories Block',
	icon: 'dashicons dashicons-category',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_categories]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_categories]' );
    },
});

registerBlockType('cleanup/featured', {
	title: 'Featured Listing',
	icon: 'dashicons dashicons-sticky',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_featured]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_featured]' );
    },
});

registerBlockType('cleanup/map-full', {
	title: 'Map Full',
	icon: 'dashicons dashicons-location-alt',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_map]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_map]' );
    },
});
registerBlockType('cleanup/all-listing', {
	title: 'All Listing With map',
	icon: 'dashicons dashicons-grid-view',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_archive_grid]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_archive_grid]' );
    },
});
registerBlockType('cleanup/all-listing-without-map', {
	title: 'All Listing Without map',
	icon: 'dashicons dashicons-grid-view',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_archive_grid_no_map]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_archive_grid_no_map]' );
    },
});

registerBlockType('cleanup/search-form', {
	title: 'Search Form',
	icon: 'dashicons dashicons-search',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_search]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_search]' );
    },
});

registerBlockType('cleanup/filter', {
	title: 'Filter',
	icon: 'dashicons dashicons-admin-settings',
	category: 'cleanup-category',  		  
	edit: function() {
        return el( 'p', '', '[cleanup_listing_filter]' );
    },
    save: function() {
        return el( 'p', '', '[cleanup_listing_filter]' );
    },
});













