jQuery(document).ready(function($) {

	$('.home-slider').slick({
	  infinite: true,
	  autoplay:true,
	  slidesToShow: 1,
	  slidesToScroll: 1,	  
	});


	$('.featured-product-slide').slick({
	  dots: false,
	  infinite: true,
	  autoplay:true,
	  autoplaySpeed: 6000,
	  speed: 300,
	  slidesToShow: 5,
	  slidesToScroll: 1,
	  responsive: [
	    {
	      breakpoint: 1024,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 3,
	        infinite: true,
	        dots: true
	      }
	    },
	    {
	      breakpoint: 600,
	      settings: {
	        slidesToShow: 2,
	        slidesToScroll: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        slidesToShow: 1,
	        slidesToScroll: 1
	      }
	    }
	    // You can unslick at a given breakpoint now by adding:
	    // settings: "unslick"
	    // instead of a settings object
	  ]
	});

	// Success-story Slider
		 $('.succes-slider').slick({		  
		  infinite: false,
		  speed: 300,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 1,
		        infinite: true,
		        dots: true
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
		});

	// DETAIL PAGE

	 $('.slider-for').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,
	  fade: true,
	  asNavFor: '.slider-nav'
	});
	$('.slider-nav').slick({
	  slidesToShow: 3,
	  slidesToScroll: 1,
	  asNavFor: '.slider-for',
	  dots: false,
	  centerMode: true,
	  focusOnSelect: true
	});
	


	$('.top-search-block .dropdown-menu li').hover(
	  function() {
	    $( this ).addClass('active');

	  }, function() {
	    $( this ).removeClass('active');
	  }
	);

	/*-------------------Start-animation-----------------------*/
	    var wow = new WOW(
	  {
	    boxClass:     'wow',      
	    animateClass: 'animated', 
	    offset:       0,          
	    mobile:       true,       
	    live:         true,       
	    callback:     function(box) {
	 
	    },
	    scrollContainer: null
	  }
	);
	wow.init();/*-------------------End-animation-----------------------*/
	/*-------------------Start-Tooltip-----------------------*/
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	});/*-------------------End-Tooltip-----------------------*/
});

