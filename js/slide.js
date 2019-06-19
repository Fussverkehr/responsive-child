(function($){
    $document.ready(function(){

				$('.slideshow').wrap('<div class="slideshowcontainer"></div>');
				$('ul.slideshow a').hide().eq(0).show().addClass('active');			
				$('.slideshowcontainer').after('<a href="#" id="backbutton"><< </a><a href="#" id="forbutton">>></a>');
				$('ul.slideshow a span').hide();
				var myTimer = setInterval(function startAni(){$('#forbutton').trigger('click');		
					    },7000);
				$('.slideshowcontainer').hover(function(){
				    clearInterval(myTimer);
				    $('ul.slideshow a span').fadeIn(1000);
				    			},
				function(){
				    $('ul.slideshow a span').fadeOut(1000);
				    var myTimer = setInterval(function startAni(){$('#forbutton').trigger('click');		
				    	    },5000);				    
				});	    				
				
				$('#forbutton').on('click' , function(){
				var currentImage = $('ul.slideshow a.active');
				
					if ($('ul.slideshow a.active').next().length == 0){
					$('ul.slideshow a.active').fadeOut(3000).removeClass('active');
					$('ul.slideshow a:first-child').fadeIn(3000).addClass('active');
					} else{
				$('ul.slideshow a.active').fadeOut(3000).removeClass('active').next().fadeIn(3000).addClass('active');
						}
				return false;
			});
	 
$('#backbutton').on( 'click' , function(){
	var currentImage = $('ul.slideshow a.active');
	
		if ($('ul.slideshow a.active').prev().length == 0){
		
		$('ul.slideshow a:last-child').fadeOut(3000).removeClass('active');
		
		$('ul.slideshow a:last-child').fadeIn(3000).addClass('active');
		} else{
	$('ul.slideshow a.active').fadeOut(3000).removeClass('active').prev().fadeIn(3000).addClass('active');
			}
	return false;
});

			}); })(jQuery);