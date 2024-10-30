"use strict";
var ajaxurl = cleanup1.ajaxurl;
var loader_image = cleanup1.loading_image;

jQuery( function() {	
	
	jQuery("#compose_adminmenu").on("click", function(){
		jQuery('#cleanup-left-menu').toggle();
	});
} );

function cleanup_contact_close(){
	"use strict";
	jQuery.colorbox.close();
}
jQuery(document).ready(function () {
	
	jQuery("a.nav-link").on('click',function(){
		jQuery(".tab-pane").hide();
		jQuery(jQuery(this).attr("href")).show();
	  });
	  
     if (jQuery("[rel=tooltip]").length) {
		 jQuery("[rel=tooltip]").tooltip();
     }
   });
jQuery(window).on('load',function(){
	if (jQuery("#deadline")[0]){	
		jQuery( "#deadline" ).datepicker({ dateFormat: 'dd-mm-yy' });
	}
});
jQuery(window).on('load',function(){
	if (jQuery(".epinputdate")[0]){	
		jQuery( ".epinputdate" ).datepicker( );
	}
});


function cleanup_listing_bookmark_delete_myaccount(h_id,divename){	
	"use strict";
	var search_params={
		"action" 	: 	"cleanup_save_un_favorite",
		"data"	 	: 	"id="+h_id,
		"_wpnonce"	: cleanup1.contact,
	};
	jQuery.ajax({
		url : ajaxurl,
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('');
			if (response.msg=="success") {
				jQuery("#"+divename+"_"+h_id).fadeOut(500, function(){ jQuery(this).remove();});
				} else {
				alert('Try later');
			}
		}
	});
}
function cleanup_delete_message_myaccount(h_id,divename){	
	"use strict";
	var search_params={
		"action" 	: 	"cleanup_message_delete",
		"data"	 	: 	"id="+h_id,
		"_wpnonce"	: cleanup1.dirwpnonce,
	};
	jQuery.ajax({
		url : ajaxurl,
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('');
			if (response.msg=="success") {
				jQuery("#"+divename+"_"+h_id).fadeOut(500, function(){ jQuery(this).remove();});
				} else {
				alert('Try later');
			}
		}
	});
}
function cleanup_delete_booking_myaccount(h_id,divename){
	"use strict";
	var search_params={
		"action" 	: 	"cleanup_booking_delete",
		"data"	 	: 	"id="+h_id,
		"_wpnonce"	: cleanup1.dirwpnonce,
	};
	jQuery.ajax({
		url : ajaxurl,
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('');
			if (response.msg=="success") {
				jQuery("#"+divename+"_"+h_id).fadeOut(500, function(){ jQuery(this).remove();});
				} else {
				alert('Try later');
			}
		}
	});	
	
}

function cleanup_company_bookmark_delete_myaccount(h_id,divename){	
	"use strict";
	var search_params={
		"action" 	: 	"cleanup_author_bookmark_delete",
		"data"	 	: 	"id="+h_id,
		"_wpnonce"	: cleanup1.dirwpnonce,
	};
	jQuery.ajax({
		url : ajaxurl,
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('');
			if (response.msg=="success") {
				jQuery("#"+divename+"_"+h_id).fadeOut(500, function(){ jQuery(this).remove();});
				} else {
				alert('Try later');
			}
		}
	});
}



function cleanup_author_email_popup(user_id){	
	"use strict";
	var contactform =cleanup1.ajaxurl+'?action=cleanup_author_email_popup&user_id='+user_id;
	jQuery.colorbox({ href:contactform, width:"95%", height: "85%", maxWidth: '360px',maxHeight: '650px', });
	
}
function cleanup_listing_email_popup(dir_id){ 
	"use strict";
	var contactform =cleanup1.ajaxurl+'?action=cleanup_listing_contact_popup&dir_id='+dir_id;
	jQuery.colorbox({ href:contactform, width:"95%", height: "85%", maxWidth: '360px',maxHeight: '650px', });
	
}
function cleanup_candidate_meeting_popup(user_id){
	"use strict";
	var contactform =cleanup1.ajaxurl+'?action=cleanup_candidate_meeting_popup&user_id='+user_id;
	jQuery.colorbox({href: contactform,opacity:"0.70",closeButton:false,
				onComplete:function(){		
				//DATEPICKER
				jQuery('#meeting_date').datetimepicker();				
			},
		
		});	
}
jQuery(document).ready(function($) {
	if (jQuery("#all-bookmark")[0]){
		jQuery('#all-bookmark').show();
		var oTablecandidate = jQuery('#all-bookmark').dataTable({
			"language": {
				"sProcessing": 		cleanup1.sProcessing ,
				"sSearch": 			'',
				"searchPlaceholder" : cleanup1.sSearch,
				"lengthMenu":		cleanup1.lengthMenu ,
				"zeroRecords": 		cleanup1.zeroRecords,
				"info": 			cleanup1.info,
				"infoEmpty": 		cleanup1.infoEmpty,
				"infoFiltered":		cleanup1.infoFiltered ,
				
				"oPaginate": {
					"sFirst":   	cleanup1.sFirst,
					"sLast":    	cleanup1.sLast,
					"sNext":   		cleanup1.sNext ,
					"sPrevious":	cleanup1.sPrevious,
				},
			}
			
		});
		//oTablecandidate.fnSort( [ [1,'DESC'] ] );
	}
});




jQuery(document).ready(function($) {
	if (jQuery("#listing-manage")[0]){
		jQuery('#listing-manage').show();
		var oTable2 = jQuery('#listing-manage').dataTable({
			"language": {
				"sProcessing": 		cleanup1.sProcessing ,
				"sSearch": 			'',
				"searchPlaceholder" : cleanup1.sSearch,
				"lengthMenu":			cleanup1.lengthMenu ,
				"zeroRecords": 		cleanup1.zeroRecords,
				"info": 					cleanup1.info,
				"infoEmpty": 			cleanup1.infoEmpty,
				"infoFiltered":		cleanup1.infoFiltered ,
				"oPaginate": {
					"sFirst":   	cleanup1.sFirst,
					"sLast":    	cleanup1.sLast,
					"sNext":   		cleanup1.sNext ,
					"sPrevious":	cleanup1.sPrevious,
				},
			}
		});
		oTable2.fnSort( [ [0,'DESC'] ] );
	}
});


jQuery(document).ready(function($) {
	if (jQuery("#tbl-epmplyer-bookmark")[0]){
		jQuery('#tbl-epmplyer-bookmark').show();
		var oTable2 = jQuery('.tbl-epmplyer-bookmark').dataTable({
			"language": {
				"sProcessing": 		cleanup1.sProcessing ,
				"sSearch": 			'',
				"searchPlaceholder" : cleanup1.sSearch,
				"lengthMenu":			cleanup1.lengthMenu ,
				"zeroRecords": 		cleanup1.zeroRecords,
				"info": 					cleanup1.info,
				"infoEmpty": 			cleanup1.infoEmpty,
				"infoFiltered":		cleanup1.infoFiltered ,
				"oPaginate": {
					"sFirst":   	cleanup1.sFirst,
					"sLast":    	cleanup1.sLast,
					"sNext":   		cleanup1.sNext ,
					"sPrevious":	cleanup1.sPrevious,
				},
			}
		});
		oTable2.fnSort( [ [1,'DESC'] ] );
	}
});
jQuery(document).ready(function($) {
	if (jQuery("#tbl-listing-bookmark")[0]){
		jQuery('#tbl-listing-bookmark').show();
		var oTable2 = jQuery('.tbl-listing-bookmark').dataTable({
			"language": {
				"sProcessing": 		cleanup1.sProcessing ,
				"sSearch": 			'',
				"searchPlaceholder" : cleanup1.sSearch,
				"lengthMenu":			cleanup1.lengthMenu ,
				"zeroRecords": 		cleanup1.zeroRecords,
				"info": 					cleanup1.info,
				"infoEmpty": 			cleanup1.infoEmpty,
				"infoFiltered":		cleanup1.infoFiltered ,
				"oPaginate": {
					"sFirst":   	cleanup1.sFirst,
					"sLast":    	cleanup1.sLast,
					"sNext":   		cleanup1.sNext ,
					"sPrevious":	cleanup1.sPrevious,
				},
			}
		});
		oTable2.fnSort( [ [1,'DESC'] ] );
	}
});
jQuery(document).ready(function($) {
	if (jQuery("#alllistingdata")[0]){
		jQuery('#alllistingdata').show();
		var oTable2 = jQuery('#alllistingdata').dataTable({
			"language": {
				"sProcessing": 		cleanup1.sProcessing ,
				"sSearch": 			'',
				"searchPlaceholder" : cleanup1.sSearch,
				"lengthMenu":			cleanup1.lengthMenu ,
				"zeroRecords": 		cleanup1.zeroRecords,
				"info": 					cleanup1.info,
				"infoEmpty": 			cleanup1.infoEmpty,
				"infoFiltered":		cleanup1.infoFiltered ,
				"oPaginate": {
					"sFirst":   	cleanup1.sFirst,
					"sLast":    	cleanup1.sLast,
					"sNext":   		cleanup1.sNext ,
					"sPrevious":	cleanup1.sPrevious,
				},
			}
		});
		oTable2.fnSort( [ [1,'DESC'] ] );
	}
});
jQuery(document).ready(function($) {
	if (jQuery("#interest-user-data")[0]){
		jQuery(window).on('load',function(){
			jQuery('#interest-user-data').show();
			var oTable = jQuery('#interest-user-data').dataTable();
			oTable.fnSort( [ [1,'DESC'] ] );
		});
	}
	if (jQuery(".popup-contact")[0]){
		jQuery(".popup-contact").colorbox({transition:"None", width:"50%", height:"50%" ,opacity:"0.70"});
	}
});
jQuery(document).ready(function($) {
	jQuery('[href^=#tab]').on("click", function (e) {
		e.preventDefault()
		jQuery(this).tab('show')
	});
})

function cleanup_edit_banner_image(profile_image_id){
	"use strict";
	var image_gallery_frame;
	image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
		// Set the title of the modal.
		title: cleanup1.SetImage	,
		button: {
			text: cleanup1.SetImage,
		},
		multiple: false,
		displayUserSettings: true,
	});
	image_gallery_frame.on( 'select', function() {
		var selection = image_gallery_frame.state().get('selection');
		selection.map( function( attachment ) {
			attachment = attachment.toJSON();
			if ( attachment.id ) {			
				
				jQuery('#'+profile_image_id).html('<img  class="img-circle img-responsive"  src="'+attachment.url+'">');
				jQuery('#topbanner_url').val(attachment.url );
				jQuery('#topbanner_id').val(attachment.id );			
				
			}
		});
	});
	image_gallery_frame.open();
}

function cleanup_edit_profile_image(profile_image_id){
	"use strict";
	var image_gallery_frame;
	image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
		// Set the title of the modal.
		title: cleanup1.SetImage	,
		button: {
			text: cleanup1.SetImage,
		},
		multiple: false,
		displayUserSettings: true,
	});
	image_gallery_frame.on( 'select', function() {
		var selection = image_gallery_frame.state().get('selection');
		selection.map( function( attachment ) {
			attachment = attachment.toJSON();
			if ( attachment.id ) {
				console.log(attachment.url);
				var ajaxurl = cleanup1.ajaxurl;
				var search_params = {
					"action": 	"cleanup_update_profile_pic",
					"attachment_thum": attachment.url,
					"profile_pic_url_1": attachment.url,
					"_wpnonce":  	cleanup1.dirwpnonce,
				};
				jQuery.ajax({
					url: ajaxurl,
					dataType: "json",
					type: "post",
					data: search_params,
					success: function(response) {
						if(response=='success'){
							
						
							jQuery('#'+profile_image_id).html('<img  class="img-circle img-responsive"  src="'+attachment.url+'">');
						}
					}
				});
			}
		});
	});
	image_gallery_frame.open();
}
function cleanup_update_profile_setting (){
	"use strict";
	var ajaxurl =cleanup1.ajaxurl;
	var loader_image = cleanup1.loading_image;
	jQuery('#update_message').html(loader_image);
	var search_params={
		"action"  : 	"cleanup_update_profile_setting",
		"form_data":	jQuery("#profile_setting_form").serialize(),
		"_wpnonce":  	cleanup1.dirwpnonce,
	};
	jQuery.ajax({
		url : ajaxurl,
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
		
			var new_topimage=jQuery('#topbanner_url').val();
			
			jQuery('#topbanner_heroimg').removeAttr("style");
			
			jQuery('#topbanner_heroimg').attr("style",'background:url('+new_topimage +') no-repeat; background-size:cover;');			
			
			jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
		}
	});
}


function cleanup_update_password (){
	"use strict";
	var ajaxurl =cleanup1.ajaxurl;
	var loader_image = cleanup1.loading_image;
	jQuery('#update_message_pass').html(loader_image);
	var search_params={
		"action"  : 	"cleanup_update_setting_password",
		"form_data":	jQuery("#pass_word").serialize(),
		"_wpnonce":  	cleanup1.dirwpnonce,
	};
	jQuery.ajax({
		url : ajaxurl,
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message_pass').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
		}
	});
}
jQuery(".nav-tabs a").on("click", function(){
	jQuery(this).tab('show');
});

function cleanup_send_message_iv(){
	"use strict";
	if (jQuery.trim(jQuery("#message-content").val()) == "") {
		alert("Please put your message");
		} else {
		var ajaxurl =cleanup1.ajaxurl;
		var loader_image = cleanup1.loading_image;
		jQuery('#update_message_popup').html(loader_image);
		var search_params={
			"action"  : 	"cleanup_message_send",
			"form_data":	jQuery("#message-pop").serialize(),
			"_wpnonce":  	cleanup1.contact,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				jQuery('#update_message_popup').html(response.msg );
				jQuery("#message-pop").trigger('reset');
			}
		});
	}
}
function cleanup_save_notification(){ 
	"use strict";
		var ajaxurl =cleanup1.ajaxurl;
		var loader_image = cleanup1.loading_image;
		jQuery('#notification_message').html(loader_image);
		var search_params={
			"action"  : 	"cleanup_save_notification",
			"form_data":	jQuery("#nofification_form").serialize(),
			"_wpnonce":  	cleanup1.contact,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				jQuery('#notification_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
			}
		});
}


function cleanup_cancel_membership_paypal (){
	"use strict";
	if (confirm('Are you sure to cancel this Membership?')) {
		var ajaxurl =cleanup1.ajaxurl;
		var loader_image = cleanup1.loading_image;
		jQuery('#update_message_paypal').html(loader_image);
		var search_params={
			"action"  : 	"cleanup_cancel_paypal",
			"form_data":	jQuery("#paypal_cancel_form").serialize(),
			"_wpnonce":  	cleanup1.dirwpnonce,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){
					jQuery('#paypal_cancel_div').hide();
					jQuery('#update_message_paypal').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
					}else{
					jQuery('#update_message_paypal').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
				}
			}
		});
	}
}
function cleanup_cancel_membership_stripe (){
	"use strict";
	if (confirm('Are you sure to cancel this Membership?')) {
		var ajaxurl =cleanup1.ajaxurl;
		var loader_image = cleanup1.loading_image;
		jQuery('#update_message_stripe').html(loader_image);
		var search_params={
			"action"  : 	"cleanup_cancel_stripe",
			"form_data":	jQuery("#profile_cancel_form").serialize(),
			"_wpnonce":  	cleanup1.dirwpnonce,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				jQuery('#stripe_cancel_div').hide();
				jQuery('#update_message_stripe').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
			}
		});
	}
}
jQuery(function(){
	jQuery('#package_sel').on('change', function (e) {
		var optionSelected = jQuery("option:selected", this);
		var pack_id = this.value;
		jQuery("#package_id").val(pack_id);
		var ajaxurl =cleanup1.ajaxurl;
		var loader_image = cleanup1.loading_image;
		var search_params={
			"action"  			: "cleanup_check_package_amount",
			"coupon_code" 		:jQuery("#coupon_name").val(),
			"package_id" 		: pack_id,
			"package_amount" 	:'',
			"api_currency" 		:cleanup1.currencyCode,
			"_wpnonce":  	 cleanup1.signup,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				jQuery('#p_amount').html(response.p_amount);
			}
		});
	});
});