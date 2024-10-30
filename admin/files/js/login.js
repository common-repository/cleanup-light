"use strict";
function  cleanup_forget_pass(){
	"use strict";
   var ajaxurl = real_data.ajaxurl;
   var loader_image =real_data.loading_image;
   jQuery('#forget_message').html(loader_image);
   var search_params={
     "action"  : 	"cleanup_forget_password",
     "form_data":	jQuery("#forget-password").serialize(),
	 "_wpnonce": real_data.cleanup,
   };
   var femail = jQuery('#forget_email').val();

   if( femail!="" ){
    jQuery.ajax({
     url : ajaxurl,
     dataType : "json",
     type : "post",
     data : search_params,
     success : function(response){
      if(response.code=='success'){
							// redirect
							jQuery('#forget_message').html('<div class="alert alert-success alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+real_data.forget_sent+' </div>' );
						}else{
							jQuery('#forget_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg+'</div>' );
						}


					}
				});
  }else{
    jQuery('#forget_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+real_data.forget_validator+'</div>' );
  }
}
function  cleanup_chack_login(){
	"use strict";
  var ajaxurl = real_data.ajaxurl;
  var loader_image =real_data.loading_image;
 jQuery('#error_message').html(loader_image);
 var search_params={
   "action"  : 	"cleanup_check_login",
   "form_data":	jQuery("#login_form").serialize(),
    "_wpnonce": real_data.cleanup,
 };
 var username = jQuery('#username').val();
 var password = jQuery('#password').val();
 if( password!="" && username!=""){
  jQuery.ajax({
   url : ajaxurl,
   dataType : "json",
   type : "post",
   data : search_params,
   success : function(response){
    if(response.code=='success'){
						// redirect						
						 setTimeout(function() {
							location.reload(true);
						}, 6000);
						
						}else{
							jQuery('#error_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+real_data.login_error+' </div>' );
						}


					}
				});
}else{
  jQuery('#error_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+real_data.login_validator+'</div>' );
}
}
(function($){
  $(document).ready(function(){
    $('.forgot-link').on('click',function(){
      $("#login_form").hide();
      $("#forget-password").show();
    });
    $('#back-btn').on('click',function(){
      $("#login_form").show();
      $("#forget-password").hide();
    });
  });
}(jQuery));


jQuery("#password").keypress(function(e) {
  if(e.which == 13) {
   cleanup_chack_login();

 }
});
jQuery("#forget_email").keypress(function(e) {
  if(e.which == 13) {
    cleanup_forget_pass();

  }
});
jQuery(document).ready(function () {
  jQuery("#forget-password").on("submit", function(e){
   e.preventDefault();
 });
});