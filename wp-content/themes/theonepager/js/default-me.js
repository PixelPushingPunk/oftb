
(function($){
	// Document load
	$(function(){
		//alert('document ready');
		console.log('test document ready');
	});//end.document.ready
	

	// Window load
    $(window).load(function(){
    	//alert('window ready');
        // Facebook

        // fbDoLogin();

        $('.postToWall').on('click', function(e) {
            var textDataID = $(this).siblings('textarea').attr('data-id');
            var thisPostID = $(this).attr('id');
                        
            console.log('input post id ' + thisPostID);
            console.log('textData id ' + textDataID);
            
            if (thisPostID === textDataID) {
                postToWallUsingFBApi(thisPostID);
            } else { 
                e.preventDefault;
                return false;
                // do nothing
            }
            console.log('posted');
        });


    	// Twitter
    	// http://140dev.com/twitter-api-console/
    	$.ajax({     
		    url : "https://api.twitter.com/1.1/statuses/user_timeline.json", //"https://books.140.dev.com/ebook_js/code/timeline_response.php", // 
		    dataType : "json",  
		    timeout:15000,  
		  
		    success : function(data) {   
		        $("#data").html("Data successfully obtained! twitter <br />");  
		 			for (var i=0; i < data.length; i+=1) {  
			 			$("#data").append("<p>" + data[i].text +"</p>");  
			 			$("#data").append("<p>" + data[i].created_at +"</p>");  
			 			//$("#data").html(data);
		    		}  
		        },  
		  
		    error : function() {   
		        alert("Twitter Failure!");   
		    },  		  
		}); // end ajax call    
        
    	// Facebook slider function()
       	sliderFb();

        // Blog slider function() 
        sliderBlogPost();

        console.log('test window ready');
   	});// end window.load*/
}(jQuery)); //IFE

var sliderFb = function () {
 // Slider for facebook
  	var currentPosition = 0;
  	var slides = jQuery('.pcWrap');
  	var numberOfSlides = slides.length;

  	var manageControls = function(position) {
        	// hide left arrow if position = first slide
        	if (position == 0) {
        		jQuery('#leftControl').hide()
        	} else {
        		jQuery('#leftControl').show()
        	}

        	// hide right arrow if position is last slide
        	if (position == numberOfSlides - 1) {
        		jQuery('#rightControl').hide();
        	} else {
        		jQuery('#rightControl').show();
        	}
    };
        // Create slider wrap
        jQuery('.pcWrap').wrapAll('<div class="sliderWrap"></div>');
        
        // Create Previous and Next buttons
        jQuery('#loading-posts').prepend('<div class="clear"></div>');
        jQuery('#loading-posts').prepend('<div id="rightControl" class="control rightFB"><a href="#">Next</a></div>');
        jQuery('#loading-posts').prepend('<div id="leftControl" class="control leftFB"><a href="#">Prev</a></div>');
        
        // Set slider wrap width 
        var pcWrapWidth = jQuery('.pcWrap').width();
        var pcWrapLength = jQuery('.pcWrap').length;

         console.log('pcWrapWidth: ' + pcWrapWidth);
         console.log('pcWraplength: ' + pcWrapLength);
        var slideWidth = pcWrapWidth * pcWrapLength;
         console.log('slideWidth: ' + slideWidth);

        jQuery('.sliderWrap').css('width', slideWidth);

        manageControls(currentPosition);

        jQuery('.control').on('click', function(e) {
        	currentPosition = (jQuery(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;

        	manageControls(currentPosition);
        	jQuery('.sliderWrap').animate({
        		'marginLeft' : pcWrapWidth*(-currentPosition)
        	});	

        	console.log('current position = ' + currentPosition);
        	e.preventDefault();
        });
};

var sliderBlogPost = function () {
 // Slider for facebook
    console.log('test beg sliderblog post');
    var currentPosition = 0;
    var slidesBL = jQuery('#blog-posts article');
    var numberOfSlidesBL = slidesBL.length;

    var manageControls = function(position) {
            // hide left arrow if position = first slide
            if (position == 0) {
                jQuery('#leftControlBL').hide()
            } else {
                jQuery('#leftControlBL').show()
            }

            // hide right arrow if position is last slide
            if (position == numberOfSlidesBL - 1) {
                jQuery('#rightControlBL').hide();
            } else {
                jQuery('#rightControlBL').show();
            }
    };
        // Create slider wrap
        jQuery('#blog-posts article').wrapAll('<div class="sliderWrapBL"></div>');
        
        // Create Previous and Next buttons
        jQuery('#blog-posts #main').prepend('<div id="rightControlBL" class="controlBL rightBL"><a href="#">Next</a></div>');
        jQuery('#blog-posts #main').prepend('<div id="leftControlBL" class="controlBL leftBL"><a href="#">Prev</a></div>');
        
        // Set slider wrap width 
        var articleWrapWidth = jQuery('#blog-posts article').width();
        var articleWrapLength = jQuery('#blog-posts article').length;

        // console.log('pcWrapWidth: ' + pcWrapWidth);
        // console.log('pcWraplength: ' + pcWrapLength);
        var slideWidth = articleWrapWidth * articleWrapLength;
        // console.log('slideWidth: ' + slideWidth);

        jQuery('.sliderWrapBL').css('width', slideWidth);

        manageControls(currentPosition);

        jQuery('.controlBL').on('click', function(e) {
            currentPosition = (jQuery(this).attr('id')=='rightControlBL') ? currentPosition+1 : currentPosition-1;

            manageControls(currentPosition);
            jQuery('.sliderWrapBL').animate({
                'marginLeft' : articleWrapWidth*(-currentPosition)
            }); 

            console.log('current position = ' + currentPosition);
            e.preventDefault();
        });
    console.log('test end slider blog post');
};