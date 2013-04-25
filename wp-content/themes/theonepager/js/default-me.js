
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

    	$('#postToWall').on('click', function() {
        	postToWallUsingFBApi();
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

        console.log('test window ready');
   	});// end window.load*/
}(jQuery)); //IFE

var sliderFb = function () {
 // Slider for facebook
  	var currentPosition = 0;
  	var slides = $('.pcWrap');
  	var numberOfSlides = slides.length;

  	var manageControls = function(position) {
        	// hide left arrow if position = first slide
        	if (position == 0) {
        		$('#leftControl').hide()
        	} else {
        		$('#leftControl').show()
        	}

        	// hide right arrow if position is last slide
        	if (position == numberOfSlides - 1) {
        		$('#rightControl').hide();
        	} else {
        		$('#rightControl').show();
        	}
    };
        // Create slider wrap
        $('.pcWrap').wrapAll('<div class="sliderWrap"></div>');
        
        // Create Previous and Next buttons
        $('#loading-posts').prepend('<div id="rightControl" class="control rightFB"><a href="#">Next</a></div>');
        $('#loading-posts').prepend('<div id="leftControl" class="control leftFB"><a href="#">Prev</a></div>');
        
        // Set slider wrap width 
        var pcWrapWidth = $('.pcWrap').width();
        var pcWrapLength = $('.pcWrap').length;

        // console.log('pcWrapWidth: ' + pcWrapWidth);
        // console.log('pcWraplength: ' + pcWrapLength);
        var slideWidth = pcWrapWidth * pcWrapLength;
        // console.log('slideWidth: ' + slideWidth);

        $('.sliderWrap').css('width', slideWidth);

        manageControls(currentPosition);

        $('.control').on('click', function(e) {
        	currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;

        	manageControls(currentPosition);
        	$('.sliderWrap').animate({
        		'marginLeft' : pcWrapWidth*(-currentPosition)
        	});	

        	console.log('current position = ' + currentPosition);
        	e.preventDefault();
        });
};