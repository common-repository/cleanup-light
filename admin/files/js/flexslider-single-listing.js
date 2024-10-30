"use strict";
jQuery(window).load(function() {
  // The slider being synced must be initialized first
  jQuery('#cleanup-carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 210,
    itemMargin: 10,
    asNavFor: '#cleanup-slider'
  });
 
  jQuery('#cleanup-slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: true,
    sync: "#cleanup-carousel"
  });
});