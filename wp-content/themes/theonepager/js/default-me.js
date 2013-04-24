
(function($){
	// Document load
	$(function(){
		alert('document ready');
		console.log('test document ready');
	});//end.document.ready
	

	// Window load
    $(window).load(function(){
    	alert('window ready');
        // fbDoLogin();

    	$('#postToWall').on('click', function() {
        	postToWallUsingFBApi();
    	});

        console.log('test window ready');
   	});// end window.load*/
}(jQuery)); //IFE

