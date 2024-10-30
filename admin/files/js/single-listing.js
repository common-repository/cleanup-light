"use strict";
var ajaxurl = cleanup_data.ajaxurl;
var loader_image =cleanup_data.loading_image;
var paged =1;
var listingdata_width= jQuery("#dirpro_directories").width();
var full_grid= jQuery("#full_grid").width();
// variables
var accordionBtn = document.querySelectorAll('.accordionTitle');
var allTexts = document.querySelectorAll('.text');
var accIcon = document.querySelectorAll('.accIcon');

// For search filter function
function cleanup_call_filter(){
	"use strict";
	var cboxOptions = {
	  width: '95%',
	  height: '95%',
	  maxWidth: '960px',
	  maxHeight: '960px',
	}
		var $form  = jQuery("#listingfilter");		
		jQuery.colorbox({inline:true, href:$form, width:"95%", height: "80%", maxWidth: '760px',maxHeight: '760px', });		
}
// For showing map function
function cleanup_call_map(){
	"use strict";
		var $form  = jQuery("#archivemap");		
		jQuery.colorbox({inline:true, href:$form, width:"95%", height: "95%", maxWidth: '760px',maxHeight: '650px', });		
}
// For contact popup function
function cleanup_call_popup(dir_id){
	"use strict";
	var contactform =cleanup_data.ajaxurl+'?action=cleanup_listing_contact_popup&dir_id='+dir_id;		
	jQuery.colorbox({ href:contactform, width:"95%", height: "85%", maxWidth: '450px',maxHeight: '650px', });
}
// For showing booking popup function
function cleanup_listing_booking_popup(dir_id){
	"use strict";
	
	var contactform =cleanup_data.ajaxurl+'?action=cleanup_listing_booking_popup&dir_id='+dir_id;		
	jQuery.colorbox({ href:contactform, width:"95%", height: "85%", maxWidth: '650px',maxHeight: '680px', });
	
}
// For showing report popup function
function cleanup_claim_popup(dir_id){
	"use strict";	
	var contactform =cleanup_data.ajaxurl+'?action=cleanup_listing_claim_popup&dir_id='+dir_id;			
	jQuery.colorbox({ href:contactform, width:"95%", height: "85%", maxWidth: '450px',maxHeight: '550px', });
}

jQuery(document).ready(function(){   
	cleanup_single_block_resize();
	
	jQuery(window).on('resize', function(){
		cleanup_single_block_resize();
	});   
})
// For arachive page block resize function
function cleanup_single_block_resize(){
	"use strict";
		var listingdata_width= jQuery("#dirpro_directories").width();
		 
		jQuery( ".listingdata-col" ).removeClass( "col-xl-6 col-xl-4 col-xl-3 col-xl-2 col-xl-12 col-lg-6 col-lg-4 col-lg-3 col-lg-2  col-md-6 col-md-4 col-md-3 col-md-2 col-md-12 col-sm-12  col-sm-6 col-sm-2 col-12" );
		
	  if(listingdata_width>1500  ){ 
		jQuery( ".listingdata-col" ).addClass( "col-xl-3 col-md-4 col-lg-2 " );
			jQuery('#map').removeClass('maphide');	
	   }else if(listingdata_width>1000 && listingdata_width<1500 ){  
			jQuery( ".listingdata-col" ).addClass( "col-xl-4 col-md-4 col-lg-4 " );
			jQuery('#map').removeClass('maphide');	
	   }else if(listingdata_width>600 && listingdata_width<1000  ){
			jQuery( ".listingdata-col" ).addClass( "col-xl-4 col-md-6 col-lg-4" );	
			jQuery('#map').addClass('map50');
	   }else if(listingdata_width>500 && listingdata_width<600  ){ 
			jQuery( ".listingdata-col" ).addClass( "col-xl-6 col-md-6 col-lg-6 " );
			jQuery('#map').addClass('map50');
	  }else { 
			jQuery( ".listingdata-col" ).addClass( "col-xl-12 col-md-12 col-lg-6 " );	
			jQuery('#map').addClass('map50');
	   }
}
jQuery( function() { 
	
jQuery('#resetmainpage').on('click', function () {    
	window.location = window.location.href.split("?")[0];
});

 jQuery(function () {
	 jQuery('[data-toggle="tooltip"]').tooltip();
});
	
	jQuery('.grid-one').on('click', function () {
		setTimeout(function() {
				
				jQuery('#dirpro_directories').removeClass('col-md-6 col-lg-6 col-xl-6 col-md-12 col-lg-12 col-xl-12');
				jQuery('#map').removeClass('maphide');	
				jQuery("#archivemap" ).removeClass( "col-md-6 col-lg-6 col-sm-12 " );		
				jQuery( ".listingdata-col" ).removeClass( "col-xl-6 col-xl-4 col-xl-3 col-xl-2  col-lg-6 col-lg-2 col-lg-3 col-md-6 col-md-4 col-md-3 col-sm-12  col-md-3 col-sm-2 col-12" );			 
							
				// for small window
				jQuery("#dirpro_directories" ).addClass( "col-md-3 col-lg-3 col-xl-3 col-sm-12 archivescroll" );				
				jQuery("#archivemap" ).addClass( "col-md-9 col-lg-9 col-xl-9 col-sm-12 " );						
				jQuery('#map').addClass('map50');
				cleanup_single_block_resize();		
			
		  }, 600,'slide' );
		
	}); 

	jQuery('.grid-two').on('click', function () { 
		 setTimeout(function() { 
				jQuery('#dirpro_directories').removeClass('col-xl-2 col-xl-3 col-xl-12 col-lg-2 col-lg-4 col-lg-12 col-md-3 col-lg-3 col-md-12  ');			
				jQuery( ".listingdata-col" ).removeClass( "col-xl-4 col-xl-3 col-xl-3 col-xl-6 col-xl-12 col-md-6 col-md-3 col-md-12 col-lg-6 col-lg-2 col-lg-3 col-lg-12 col-sm-12  col-md-3 col-sm-2 col-12" ); 
				jQuery('#map').removeClass('maphide');
				jQuery("#archivemap" ).removeClass( "col-md-9 col-lg-9 col-xl-9 " );	
				// for small window
				jQuery("#dirpro_directories" ).addClass( "col-md-6 col-lg-6   col-sm-12 archivescroll" );
				jQuery("#archivemap" ).addClass( "col-md-6 col-lg-6 col-sm-12 " );					
				jQuery('#map').addClass('map50');
				cleanup_single_block_resize();			
			
		  }, 700,'slide' );
		
	});

	jQuery('.grid-three').on('click', function () {
			 setTimeout(function() {		 
			jQuery('#dirpro_directories').removeClass('col-xl-4 col-xl-3 col-xl-6 col-md-6 col-md-3 col-lg-6 col-lg-3 col-sm-12 archivescroll');
			jQuery( ".listingdata-col" ).removeClass( "col-xl-12 col-xl-6 col-xl-4 col-xl-3 col-xl-3  col-lg-12 col-lg-6 col-lg-2 col-lg-3 col-lg-4 col-md-12 col-md-6 col-md-4 col-md-3 col-md-2 col-sm-12 col-sm-6  col-sm-2 col-12" );	    
			jQuery('#map').removeClass('map50');		
			
			jQuery("#dirpro_directories" ).addClass( "col-xl-12 col-md-12 col-lg-12 col-sm-12" ); 
			jQuery('#map').addClass('maphide');		
			// for small window
			
			cleanup_single_block_resize();
			
		  }, 700,'slide' );
		
	}); 

	


});
// event listener
accordionBtn.forEach(function (el) {
    el.addEventListener('click', cleanup_toggleAccordion)
});

// function
function cleanup_toggleAccordion(el) {
	"use strict";
   var targetText = el.currentTarget.nextElementSibling.classList;
   var targetAccIcon = el.currentTarget.children[0];
   var target = el.currentTarget;
   
   if (targetText.contains('show')) {
       targetText.remove('show');
       targetAccIcon.classList.remove('anime');
       target.classList.remove('accordionTitleActive');
   } 
   else {
      accordionBtn.forEach(function (el) {
         el.classList.remove('accordionTitleActive');
         
         allTexts.forEach(function (el) {
            el.classList.remove('show');
         })
         
         accIcon.forEach(function (el) {
          el.classList.remove('anime');
         }) 
         
      })
      
         targetText.add('show');
         target.classList.add('accordionTitleActive');
         targetAccIcon.classList.add('anime');
   }  
}

jQuery( document ).ready(function() { 
	if (jQuery("#faqs-accordion")[0]){	 
		jQuery( "#faqs-accordion" ).accordion();
	}
});	
jQuery( document ).ready(function() { 
	var isLogged =cleanup_data.current_user_id;
	jQuery(".listingbookmark").on('click', function(e){ 
		if (isLogged=="0") {
			alert(cleanup_data.Please_login);
			} else { 
			
			var not_bookmark_yet = jQuery(this).closest('.btn-add-favourites').attr("id");
			var alreay_bookmark = jQuery(this).closest('.btn-added-favourites').attr("id");
			
			if (typeof not_bookmark_yet === "undefined") { 	
				// Allready bookmarked 				
					var not_bookmark_yet_id = jQuery(this).closest('.btn-added-favourites').attr("id");	
					var p_id= not_bookmark_yet_id.replace("listingbookmark", '');						
					var search_params={
						"action"  : 	"cleanup_save_un_favorite",
						"data": "id=" + p_id,
						"_wpnonce":  	cleanup_data.contact,
					};					
					jQuery.ajax({
						url : ajaxurl,
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){						
							if (response.msg=="success") {
								jQuery("#"+alreay_bookmark).removeClass('btn-added-favourites').addClass('btn-add-favourites',{duration:1000});
								jQuery('#'+alreay_bookmark).prop('title', cleanup_data.Add_to_Favorites);
								jQuery('#'+alreay_bookmark).html('<i class="fa-regular fa-heart"></i>');
							}
						}
					});	
				
				}else{		 				
					// not_bookmark_yet listingbookmark	
					var not_bookmark_yet_id = jQuery(this).closest('.btn-add-favourites').attr("id");			
					var p_id= not_bookmark_yet_id.replace("listingbookmark", '');	
					var search_params={
						"action"  : 	"cleanup_save_favorite",
						"data": "id=" + p_id,
						"_wpnonce":  	cleanup_data.contact,
					};					
					jQuery.ajax({
						url : ajaxurl,
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){						
							if (response.msg=="success") {
								jQuery("#"+not_bookmark_yet).removeClass('btn-add-favourites').addClass('btn-added-favourites',{duration:1000});
								jQuery('#'+not_bookmark_yet).prop('title', cleanup_data.Added_to_Favorites);		
								jQuery('#'+not_bookmark_yet).html( '<i class="fa-solid fa-heart"></i>');
							}
						}
					});	
				
			}
			
			}
			
		});
	
});
function cleanup_contact_close(){
	jQuery.colorbox.close();
}
// For send report message function
function send_message_claim(){
	"use strict";
	var isLogged =cleanup_data.current_user_id;
	   if (isLogged=="0") {
                     alert(cleanup_data.Please_login);
        } else {
			var form = jQuery("#message-claim");
			if (jQuery.trim(jQuery("#message-content", form).val()) == "") {
                  alert(cleanup_data.Please_put_your_message);
			} else {
				var ajaxurl = cleanup_data.ajaxurl;
				var loader_image = cleanup_data.loading_image;
				jQuery('#update_message_claim').html(loader_image);
				var search_params={
					"action"  : 	"cleanup_claim_send",
					"form_data":	jQuery("#message-claim").serialize(),
					"_wpnonce":  	cleanup_data.listing,
				};
				jQuery.ajax({
					url : ajaxurl,
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						jQuery('#update_message_claim').html('   '+response.msg );
						jQuery("#message-claim").trigger('reset');

					}
				});
			}
	   }

	}
// For save review function
function cleanup_iv_submit_review(){
	"use strict";
	var isLogged =cleanup_data.current_user_id;
	if (isLogged=="0") {
		alert(cleanup_data.Please_login);
		} else {
		var form = jQuery("#iv_review_form");
		if (jQuery.trim(jQuery("#review_comment", form).val()) == "") {
			alert(cleanup_data.Please_put_your_message);
			} else {
			var ajaxurl = cleanup_data.ajaxurl;
			var loader_image = cleanup_data.loading_image;
			jQuery('#rmessage').html(loader_image);
			var search_params={
				"action"  :  "cleanup_save_user_review",
				"form_data": jQuery("#iv_review_form").serialize(),
				"_wpnonce": cleanup_data.listing,
			};
			jQuery.ajax({
				url : ajaxurl,
				dataType : "json",
				type : "post",
				data : search_params,
				success : function(response){
					jQuery('#rmessage').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
					jQuery("#iv_review_form")[0].reset();
				}
			});
		}
	}
}
(function($) {
	$.fn.bcSwipe = function(settings) {
		var config = { threshold: 50 };
		if (settings) {
			$.extend(config, settings);
		}
		this.each(function() {
			var stillMoving = false;
			var start;
			if ('ontouchstart' in document.documentElement) {
				this.addEventListener('touchstart', onTouchStart, false);
			}
			function onTouchStart(e) {
				if (e.touches.length == 1) {
					start = e.touches[0].pageX;
					stillMoving = true;
					this.addEventListener('touchmove', onTouchMove, false);
				}
			}
			function onTouchMove(e) {
				if (stillMoving) {
					var x = e.touches[0].pageX;
					var difference = start - x;
					if (Math.abs(difference) >= config.threshold) {
						cancelTouch();
						if (difference > 0) {
							$(this).carousel('next');
						}
						else {
							$(this).carousel('prev');
						}
					}
				}
			}
			function cancelTouch() {
				this.removeEventListener('touchmove', onTouchMove);
				start = null;
				stillMoving = false;
			}
		});
		return this;
	};
})(jQuery);
jQuery('#carouselExampleControls').bcSwipe({ threshold: 50 });
jQuery('#similarPrppertycarousel').bcSwipe({ threshold: 50 });

jQuery( document ).ready(function() { 
	if (jQuery(".epinputdate")[0]){	 
		jQuery( ".epinputdate" ).datepicker( );
	}
});

// For sending booking message function
function cleanup_booking_send_message(){
	"use strict";
	var formc = jQuery("#booking_pop");
	
	if (jQuery.trim(jQuery("#booking_email_address",formc).val()) == "" || jQuery.trim(jQuery("#booking_name",formc).val()) == "" || jQuery.trim(jQuery("#booking_address",formc).val()) == ""|| jQuery.trim(jQuery("#booking_phone",formc).val()) == "") {
		alert(cleanup_data.Please_put_your_message);
		} else {
		var ajaxurl = cleanup_data.ajaxurl;
		var loader_image =cleanup_data.loading_image;
		jQuery('#booking_update_message_popup').html(loader_image);
		var search_params={
			"action"  : 	"cleanup_booking_message_send",
			"form_data":	jQuery("#booking_pop").serialize(),
			"_wpnonce":  	cleanup_data.contact,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				jQuery('#booking_update_message_popup').html(response.msg );
				jQuery("#booking_pop").trigger('reset');
			}
		});
	}
	
}
// For send contact popup message function
function cleanup_contact_send_message_iv(){
	"use strict";
	var formc = jQuery("#message-pop");
	
	if (jQuery.trim(jQuery("#email_address",formc).val()) == "" || jQuery.trim(jQuery("#name",formc).val()) == "" || jQuery.trim(jQuery("#message-content",formc).val()) == "") {
		alert(cleanup_data.Please_put_your_message);
		} else {
		var ajaxurl = cleanup_data.ajaxurl;
		var loader_image =cleanup_data.loading_image;
		jQuery('#update_message_popup').html(loader_image);
		var search_params={
			"action"  : 	"cleanup_message_send",
			"form_data":	jQuery("#message-pop").serialize(),
			"_wpnonce":  	cleanup_data.contact,
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
// For save_favorite function
function cleanup_save_favorite(id) {  
	"use strict";
	var isLogged =cleanup_data.current_user_id;
	if (isLogged=="0") {
		alert(cleanup_data.Please_login);
		} else {
		var ajaxurl = cleanup_data.ajaxurl;
		var search_params={
			"action"  : 	"cleanup_save_favorite",
			"data": "id=" + id,
			"_wpnonce":  	cleanup_data.contact,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				jQuery("#fav_dir"+id).html('<button class="btn btn-big " data-placement="left" data-toggle="tooltip" title="'+cleanup_data.Added_to_Favorites+'" href="javascript:;" onclick="cleanup_save_unfavorite('+id+')" ><i class="'+cleanup_data.favorite_icon+'" ></i></button>');
			}
		});
	}
}
// For save_unfavorite function
function cleanup_save_unfavorite(id) {
	"use strict";
	var isLogged =cleanup_data.current_user_id;
	if (isLogged=="0") {
		alert(cleanup_data.Please_login);
		} else {
		var ajaxurl = cleanup_data.ajaxurl;
		var search_params={
			"action"  : 	"cleanup_save_un_favorite",
			"data": "id=" + id,
			"_wpnonce":  	cleanup_data.contact,
		};
		jQuery.ajax({
			url : ajaxurl,
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				jQuery("#fav_dir"+id).html('<button class="btn btn-border"  data-placement="left" data-toggle="tooltip" title="'+cleanup_data.Add_to_Favorites+'>" href="javascript:;" onclick="cleanup_save_favorite('+id+')" ><i class="'+cleanup_data.favorite_icon+'"></i></button>');
			}
		});
	}
}
// For checking valid email function
function cleanup_isValidEmailAddress(emailAddress) {
	"use strict";
	var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&"\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&"\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	return pattern.test(emailAddress);
}

