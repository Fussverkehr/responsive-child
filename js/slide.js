	jQuery(document).ready(function(){

				jQuery('.slideshow').wrap('<div class="slideshowcontainer"></div>');
				jQuery('ul.slideshow a').hide().eq(0).show().addClass('active');			
				jQuery('.slideshowcontainer').after('<a href="#" id="backbutton"><< </a><a href="#" id="forbutton">>></a>');
				jQuery('ul.slideshow a span').hide();
				var myTimer = setInterval(function startAni(){jQuery('#forbutton').trigger('click');		
					    },7000);
				jQuery('.slideshowcontainer').on("mouseover",function(){
				  clearInterval(myTimer);
				    jQuery('ul.slideshow a span').fadeIn(1000);
				    			},
				jQuery('.slideshowcontainer').on("mouseout",function(){
				    jQuery('ul.slideshow a span').fadeOut(1000);
				    var myTimer = setInterval(function startAni(){jQuery('#forbutton').trigger('click');		
				    	    },7000);				    
				});	    				
				
				jQuery('#forbutton').on('click' , function(){
				var currentImage = jQuery('ul.slideshow a.active');
				
					if (jQuery('ul.slideshow a.active').next().length == 0){
					jQuery('ul.slideshow a.active').fadeOut(3000).removeClass('active');
					jQuery('ul.slideshow a:first-child').fadeIn(3000).addClass('active');
					} else{
				jQuery('ul.slideshow a.active').fadeOut(3000).removeClass('active').next().fadeIn(3000).addClass('active');
						}
				return false;
			});
	 
jQuery('#backbutton').on( 'click' , function(){
	var currentImage = jQuery('ul.slideshow a.active');
	
		if (jQuery('ul.slideshow a.active').prev().length == 0){
		
		jQuery('ul.slideshow a:last-child').fadeOut(3000).removeClass('active');
		
		jQuery('ul.slideshow a:last-child').fadeIn(3000).addClass('active');
		} else{
	jQuery('ul.slideshow a.active').fadeOut(3000).removeClass('active').prev().fadeIn(3000).addClass('active');
			}
	return false;
});
});
