
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
		 			for (i=0; i<data.length; i+=1) {  
			 			$("#data").append("<p>" + data[i].text) +"</p>");  
			 			$("#data").append("<p>" + data[i].created_at +"</p>");  
			 			//$("#data").html(data);
		    		}  
		        },  
		  
		    error : function() {   
		        alert("Twitter Failure!");   
		    },  		  
		}); // end ajax call    
        
        console.log('test window ready');
   	});// end window.load*/
}(jQuery)); //IFE

