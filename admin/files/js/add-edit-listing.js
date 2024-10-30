"use strict";

jQuery( document ).ready(function() { 
	if (jQuery(".epinputdate")[0]){	
		jQuery( ".epinputdate" ).datepicker( );
	}
});
jQuery(function() {		
	if (jQuery("#deadline")[0]){ 
		jQuery( "#deadline" ).datepicker({ dateFormat: 'dd-mm-yy' });
	}
	
});

function add_day_field(){
	"use strict";	
	var main_opening_div =jQuery('#day-row1').html(); 
	jQuery('#day_field_div').append('<div class="clearfix"></div><div class=" row form-group" >'+main_opening_div+'</div>');

}
function remove_old_day(div_id){
	"use strict";	
	jQuery('#old_days'+div_id).remove();
}
jQuery(document).ready(function(){
    jQuery("#toggle-btn").on("click", function(){
      jQuery("#toggle-example").collapse('toggle'); // toggle collapse
    });
});

jQuery( document ).ready(function() { 		
	setTimeout(function(){			
			jQuery(".leaflet-locationiq-input").attr("placeholder", realpro_data.save_address);
			
		},500); 
});
	
jQuery( document ).ready(function() {
				
	// Initialize an empty map without layers (invisible map)
	var map = L.map('map', {
		center: [40.7259, -73.9805], // Map loads with this location as center
		zoom: 12,
		scrollWheelZoom: true,
		zoomControl: false,
		attributionControl: false,
		
	});
   
	//Geocoder options
	var geocoderControlOptions = {
		bounds: false,          //To not send viewbox
		markers: false,         //To not add markers when we geocoder
		attribution: null,      //No need of attribution since we are not using maps
		expanded: true,         //The geocoder search box will be initialized in expanded mode
		panToPoint: false,       //Since no maps, no need to pan the map to the geocoded-selected location
		params: {               //Set dedupe parameter to remove duplicate results from Autocomplete
				dedupe: 1,
			}
	}

	//Initialize the geocoder
	var geocoderControl = new L.control.geocoder('pk.87f2d9fcb4fdd8da1d647b46a997c727', geocoderControlOptions).addTo(map).on('select', function (e) {
		console.log(e);
		
		jQuery('#address').val(e.feature.feature.display_name);
		jQuery('#country').val(e.feature.feature.address.country);
		jQuery('#postcode').val(e.feature.feature.address.postcode);
		jQuery('#state').val(e.feature.feature.address.state);
		jQuery('#city').val(e.feature.feature.address.city);
		jQuery('#longitude').val(e.latlng.lng);
		jQuery('#latitude').val(e.latlng.lat);
					
		
	});

	//Get the "search-box" div
	var searchBoxControl = document.getElementById("search-box");
	//Get the geocoder container from the leaflet map
	var geocoderContainer = geocoderControl.getContainer();
	//Append the geocoder container to the "search-box" div
	searchBoxControl.appendChild(geocoderContainer);        
	

});

jQuery( document ).ready(function() { 
	jQuery(document).on('click', '.cleanupcats-fields', function(){
			var listID = jQuery('#user_post_id').val();		
			var searchIDs = jQuery("#cleanupcats-container input:checkbox:checked").map(function(){
			  return jQuery(this).val();
			}).get(); 
		
			
			if (searchIDs != undefined && searchIDs != '') {
				console.log(searchIDs);
				var loader_image = realpro_data.loading_image;
				jQuery('#cleanup_fields').html(loader_image);
				var search_params={
					"action"  : "cleanup_load_categories_fields_wpadmin",	
					'term_id': searchIDs,
					'post_id': listID,
					'datatype': 'slug',
					"_wpnonce":  	realpro_data.dirwpnonce,
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.msg=='success'){
								jQuery('#cleanup_fields').html(response.field_data);								
								if (jQuery(".epinputdate")[0]){	
									jQuery( ".epinputdate" ).datepicker( );
								}

						}
					
						
					}
				});
		}
		
	});	
});	

// For dashboard add listing
jQuery( document ).ready(function() { 
	jQuery(document).on('click', '.editor-post-taxonomies__hierarchical-terms-list[aria-label="Categories"] input', function(){ 
			
	   var termID = [];   
       var termIDs='';
	   var listID = jQuery('#post_ID').val();
		jQuery('.editor-post-taxonomies__hierarchical-terms-list[aria-label="Categories"] input:checked').each(function( index ) {
		   termIDs = jQuery(this).parent().next('label').text();
			termID.push(termIDs);
		});
		
		if (termID != undefined && termID != '') {
				console.log(termID);
				var loader_image = realpro_data.loading_image;
				
				jQuery('#cleanup_fields').html(loader_image);
				var search_params={
					"action"  : "cleanup_load_categories_fields_wpadmin",	
					'term_id': termID,
					'post_id': listID,
					'datatype': 'text',
					"_wpnonce":  	realpro_data.dirwpnonce,
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.msg=='success'){
								jQuery('#cleanup_fields').html(response.field_data);								
								if (jQuery(".epinputdate")[0]){	
									jQuery( ".epinputdate" ).datepicker( );
								}

						}
					
						
					}
				});
		}
		
	});	
});	
function cleanup_chatgtp_settings_popup(){
	"use strict";	
	
	var form_listing_title =jQuery('#title').val();	
	if(form_listing_title!=''){
		let originalText = form_listing_title;
		let newText = originalText.replace(new RegExp(' ', "g"), '+');
		var contactform =cleanup_data.ajaxurl+'?action=cleanup_chatgtp_settings_popup&form_listing_title='+newText;		
		jQuery.colorbox({ href:contactform, width:"75%", height: "75%", maxWidth: '750px',maxHeight: '880px', });
	}else{
		alert('Please Add Title');
	}
	
}	
function cleanup_chatgpt_post_creator(){
	"use strict";
	tinyMCE.triggerSave();	
	var ajaxurl = realpro_data.ajaxurl;
	var loader_image = realpro_data.loading_image;
		jQuery('#update_message-gpt').html(loader_image);
		jQuery('#chatgpt_post_creator').hide();
		
		var search_params={
			"action"  : 	"cleanup_chatgpt_post_creator",	
			"form_data":	jQuery("#chatgpt_pop").serialize(), 
			"_wpnonce":  	realpro_data.dirwpnonce,
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){
						jQuery('#update_message-gpt').html('');
						jQuery('#chatgpt_post_creator').hide();
						jQuery('#insert_data_inform').show();
						var editor = tinyMCE.get('new_post_content');						
						// main content
						editor.setContent(response.content);	
						// FAQ						
						jQuery('#faqsall').append(response.faqs);
						// images 	
						if(response.feature_image_url=='off'){
							jQuery.colorbox.close();
						}else{							
							const arr = response.feature_image_url.split("|");
							jQuery('#feature_image_urls').append('<div class="form-group col-md-12 col-12 flex-column d-flex"><label>Select Image</label></div>');
							arr.forEach((item) => {
								jQuery('#feature_image_urls').append('<div class="form-group col-sm-3 col-12 flex-column d-flex"><label> <input type="radio" name="gpt_image" value="'+item+'"><img src="'+item+'"></label></div>');
							});	
						}
				}
			}
		});
}
function cleanup_insert_gpt_image_inform(){
	"use strict";
	var ajaxurl = realpro_data.ajaxurl;
	var loader_image = realpro_data.loading_image;
		jQuery('#update_message-gpt').html(loader_image);
		var search_params={
			"action"  : 	"cleanup_chatgpt_upload_image",	
			"form_data":	jQuery("#chatgpt_pop").serialize(), 
			"_wpnonce":  	realpro_data.dirwpnonce,
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){
					jQuery('#post_image_div').html('<img  class="img-responsive rounded img-fluid"  src="'+response.image_url+'">');
					jQuery('#feature_image_id').val(response.attachment_id ); 
					jQuery('#post_image_edit').html('<button type="button" onclick="cleanup_remove_post_image(\'post_image_div\');"  class="btn btn-small-ar">X</button>');  
					jQuery.colorbox.close();
											
				}
			}
		});
}

function cleanup_update_post(){
	"use strict";
	tinyMCE.triggerSave();	
	var ajaxurl = realpro_data.ajaxurl;
	var loader_image = realpro_data.loading_image;
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"cleanup_update_wp_post",	
					"form_data":	jQuery("#new_post").serialize(), 
					"_wpnonce":  	realpro_data.dirwpnonce,
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = realpro_data.permalink+"?&profile=all-post"; 						
								jQuery(location).attr('href',url);	
						}
					
						
					}
				});
	
	}

function cleanup_new_post_without_user(){
	"use strict";
	tinyMCE.triggerSave();	
	var ajaxurl = realpro_data.ajaxurl;
	var has_access=0;
	if(realpro_data.current_user_id=='0'){
		if(jQuery('#n_user_email').val().length === 0 || jQuery('#n_password').val().length === 0){ 			
				jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.useremail_message +'.</div>');					
                jQuery('#update_message2').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.useremail_message +'.</div>');			
		}else{
			if (IsEmail(jQuery('#n_user_email').val()) == false) { 
			
				jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.useremail_message +'.</div>');					
                jQuery('#update_message2').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.useremail_message +'.</div>');
                    //return false;
			}else{
				has_access=1;
			
			}
		
		}
	}else{
	has_access=1;
	}
	
	if(has_access==1){
		var loader_image = realpro_data.loading_image;
		jQuery('#update_message').html(loader_image);
		jQuery('#update_message2').html(loader_image);
		var search_params={
			"action"  : 	"cleanup_save_post_without_user",	
			"form_data":	jQuery("#new_post").serialize(), 
			"_wpnonce":  	realpro_data.dirwpnonce,
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){ 
				if(response.code=='success'){					  						
					jQuery('#full-form-add-new').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+realpro_data.success_message  +' <a class="btn btn-sm" href="'+realpro_data.my_account_link+'" >My Account</a></div>');	
						
				}
				if(response.code=='error'){
					 jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
					 jQuery('#update_message2').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
					
				}
				
			}
		});
	}	
}
 function IsEmail(email) {
	"use strict";
	var regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!regex.test(email)) {
		return false;
	}
	else {
		return true;
	}
}
function cleanup_save_post (){
	"use strict";
	tinyMCE.triggerSave();	
	var ajaxurl = realpro_data.ajaxurl;
	var loader_image = realpro_data.loading_image;
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"cleanup_save_wp_post",	
					"form_data":	jQuery("#new_post").serialize(), 
					"_wpnonce":  	realpro_data.dirwpnonce,
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = realpro_data.permalink+"?&profile=all-post";    						
								jQuery(location).attr('href',url);	
						}
					
						
					}
				});
	
	}
function cleanup_add_faq_field(){
	"use strict";
	var main_faq_div =jQuery('#faqmain').html(); 
	jQuery('#faqsall').append('<div class="clearfix"></div><hr><div class="row">'+main_faq_div+'</div>');
}
function cleanup_faq_delete(id_delete){	
	"use strict";
	jQuery('#faq_delete_'+id_delete).remove();
}



function  cleanup_remove_post_image	(profile_image_id){
	"use strict";
	jQuery('#'+profile_image_id).html('');
	jQuery('#feature_image_id').val(''); 
	jQuery('#post_image_edit').html('<button type="button" onclick="cleanup_edit_post_image(\'post_image_div\');"  class="btn btn-small-ar">Add</button>');  

}	
 function cleanup_edit_post_image(profile_image_id){	
			"use strict";
				var image_gallery_frame;

             
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: realpro_data.Set_Feature_Image,
                    button: {
                        text: realpro_data.Set_Feature_Image, 
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive rounded img-fluid"  src="'+attachment.url+'">');
							jQuery('#feature_image_id').val(attachment.id ); 
							jQuery('#post_image_edit').html('<button type="button" onclick="cleanup_remove_post_image(\'post_image_div\');"  class="btn btn-small-ar">X</button>');  
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
	}
// Banner 
function  cleanup_remove_topbanner_image	(profile_image_id){
	"use strict";
	jQuery('#'+profile_image_id).html('');
	jQuery('#topbanner_image_id').val(''); 
	jQuery('#post_image_topbaner').html('<button type="button" onclick="cleanup_topbanner_image(\'post_image_topbaner\');"  class="btn btn-small-ar">Add</button>');  

}	
 function cleanup_topbanner_image(profile_image_id){	
		"use strict";
		var image_gallery_frame;             
		image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
			// Set the title of the modal.
			title: realpro_data.Set_Feature_Image,
			button: {
				text: realpro_data.Set_Feature_Image, 
			},
			multiple: false,
			displayUserSettings: true,
		});                
		image_gallery_frame.on( 'select', function() {
			var selection = image_gallery_frame.state().get('selection');
			selection.map( function( attachment ) {
				attachment = attachment.toJSON();
				if ( attachment.id ) {
					jQuery('#'+profile_image_id).html('<img  class="img-responsive rounded img-fluid "  src="'+attachment.url+'">');
					jQuery('#topbanner_image_id').val(attachment.id ); 
					jQuery('#post_image_topbaner').append('<button type="button" onclick="cleanup_remove_topbanner_image(\'post_image_topbaner\');"  class="btn btn-small-ar">X</button>');  
				   
				}
			});
		   
		});               
		image_gallery_frame.open(); 
				
}
		
 function cleanup_edit_gallery_image(profile_image_id){
				"use strict";
				var image_gallery_frame;
				var hidden_field_image_ids = jQuery('#gallery_image_ids').val();
              
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: realpro_data.Gallery_Images,
                    button: {
                        text: realpro_data.Gallery_Images,
                    },
                    multiple: true,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();                       
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).append('<div id="gallery_image_div'+attachment.id+'" class="col-md-3"><img  class="img-responsive"  src="'+attachment.url+'"><button type="button" onclick="cleanup_remove_gallery_image(\'gallery_image_div'+attachment.id+'\', '+attachment.id+');"  class="btn btn-small-ar">X</button> </div>');
							
							hidden_field_image_ids=hidden_field_image_ids+','+attachment.id ;
							jQuery('#gallery_image_ids').val(hidden_field_image_ids); 
							
							
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 
 }			

function  cleanup_remove_gallery_image(img_remove_div,rid){	
	"use strict";
	var hidden_field_image_ids = jQuery('#gallery_image_ids').val();	
	hidden_field_image_ids =hidden_field_image_ids.replace(rid, '');	
	jQuery('#'+img_remove_div).remove();
	jQuery('#gallery_image_ids').val(hidden_field_image_ids); 
	

}	
function cleanup_attached_doc(profile_image_id){
	"use strict";
	var image_gallery_frame;
	var hidden_field_image_ids = jQuery('#attached_ids').val();
  
	image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
		// Set the title of the modal.
		title: realpro_data.attached_doc,
		button: {
			text: realpro_data.attached_doc,
		},
		multiple: true,
		library: {type: 'application/pdf',},
		displayUserSettings: true,
	});                
	image_gallery_frame.on( 'select', function() {
		var selection = image_gallery_frame.state().get('selection');
		selection.map( function( attachment ) {
			attachment = attachment.toJSON();			
			if ( attachment.id ) {				
				jQuery('#'+profile_image_id).append('<div id="attached_div'+attachment.id+'" class="row mb-2"><label class="col-md-11 control-label">'+attachment.title+' </label><div class="col-md-1"><button type="button" onclick="cleanup_remove_attached_doc(\'attached_div'+attachment.id+'\', '+attachment.id+');"  class="btn btn-small-ar">X</button></div></div>');
				
				hidden_field_image_ids=hidden_field_image_ids+','+attachment.id ;
				jQuery('#attached_ids').val(hidden_field_image_ids); 
				
				
			   
			}
		});
	   
	});               
	image_gallery_frame.open(); 
 }			
function  cleanup_remove_attached_doc(img_remove_div,rid){	
	"use strict";
	var hidden_field_image_ids = jQuery('#attached_ids').val();	
	hidden_field_image_ids =hidden_field_image_ids.replace(rid, '');	
	jQuery('#'+img_remove_div).remove();
	jQuery('#attached_ids').val(hidden_field_image_ids); 	
}

jQuery(document).ready(function() {
	jQuery("input[name$='contact_source']").on("click", function (){
		var rvalue = jQuery(this).val();
		
		if(rvalue=='new_value'){jQuery("#new_contact_div" ).show();}
		if(rvalue=='user_info'){jQuery("#new_contact_div" ).hide();}
		
		
	});
});	

		