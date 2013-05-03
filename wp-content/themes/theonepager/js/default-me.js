
(function($){
	// Document load
	$(function(){
		//alert('document ready');

        // Twitter
        $('#twitter').jtwt({
            count: 1, // number of displayed tweets
            username: 'ted', // username
            //query: '#batman', // performs a serach query
            image_size: 65,
            loader_text: 'loading tweets', //loadin text
            no_result: 'No tweets found' // no results text
        });

        $('#twitter2').jtwt({
            count: 10, // number of displayed tweets
            //username: 'god', // username
            query: '@god', // performs a serach query
            image_size: 65,
            loader_text: 'loading tweets', //loadin text
            no_result: 'No tweets found' // no results text
        });
		//console.log('test document ready');
	});//end.document.ready
	

	// Window load
    $(window).load(function(){
        // test api facebook on load
        //testAPI();        

        // Scroll bar
        $('#scrollbar1, .scrollbar2').tinyscrollbar();

        // Facebook
        $('#loadingFriends, #loadingComments').show();
        $('#loading-posts').hide();

        // login when campaign top menu clicked
        $('a#getInvolved-nav').on('click', function(){
            fbDoLogin();
        });

        // login fb
        $('.fbLogin').on('click', function(e) {
            fbDoLogin();
            e.preventDefault();
        });

        // logout fb
        $('.fbLogout').on('click', function(e) {
            fbDoLogout()
            e.preventDefault();
        });

        // become friends
        $('fbBecomeFriend').on('click', function(e){
            addAsFriend();
            e.preventDefault();
        });

        // onclick friend show name
            $('.friendWrap .friend').show();
            $('.friendWrap .friend-detail-wrap').hide();
        $('.friendWrap').on('click', function(){
            $(this).find('.friend').slideToggle('slow');
            $(this).find('.friend-detail-wrap').slideToggle('slow');
        });

        $('.friendWrap .friend, .friendWrap .friend-detail').on('click', function(e){
            e.preventDefault();
        });

        // post to fb wall button
        $('.postToWall').on('click', function(e) {
            //var textDataID = $(this).siblings('textarea').attr('data-id');
            var thisPostID = $(this).siblings('textarea').attr('name'); //$(this).attr('id'); 
                        
            //console.log('input post id ' + thisPostID);
            //console.log('textData id ' + textDataID);
            
            if (thisPostID) {
                postToWallUsingFBApi(thisPostID);
                var clearTextVal = $(this).siblings('textarea').val('');
            } else { 
                // do nothing
                return false;
            }

            e.preventDefault();
            console.log('posted');
        });


    	// Twitter
    	// http://140dev.com/twitter-api-console/
    	/*$.ajax({     
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
		        console.log("Twitter Failure!");   
		    },  		  
		});*/ // end ajax call    
        
    	// Facebook slider function()
       	sliderFb();

        // Blog slider function() 
        sliderBlogPost();

        // Center Slides
        centerSliderNav();

        // Active top nav
        topNavActive();

        // Scroll opacity of navigation
        scrollNav();

        // Top shadow
        topShadowActive();

        //console.log('test window ready');
   	});// end window.load*/
    
    var topShadowActive = function () {
        var barVisible = $('#wpadminbar').is(':visible');
        var scrollpast = $('#top').hasClass('scrollpast');

        if(barVisible == true) {
            $('#shadow-top').css('top', '191px');
        } else {
            $('#shadow-top').css('top', '163px');
        } 

        //console.log('top shadow');
    };

    var topNavActive = function () {
        var thisSpan, logo;
        var currentItem = false;
        var isDown = false;
        $('.border-line').hide();

        $('#top #top-nav a').mousedown(function(){ isDown = true; });
        $('#top #top-nav a').on({
            mouseover: function () {
                currentItem = $(this).closest('li').hasClass('current-menu-item');
                logo = $(this).closest('li').hasClass('logo-between');
                if (logo == false && currentItem == false) {
                    $(this).append('<span class="border-line" style="height:5px;background-color:#234766;display:block;margin:5px auto 5px;text-align:center;"></span>');
                    thisSpan = $(this).find('.border-line')
                    thisSpan.fadeIn('fast');
                } else { return false; }
            },
            mouseout: function (e) {
                //console.log('mouseleave: ' + currentItem);
                if (currentItem == false){
                    $(this).find('.border-line').fadeOut('fast');
                    $(thisSpan).delay(500).remove();
                } 
            },
            click : function (e) {
                //console.log('logo' + logo);
                if (logo == false && currentItem == true) {
                    $('#top #top-nav a .border-line').remove();
                    $(this).append('<span class="border-line" style="height:5px;background-color:#234766;display:block;margin:5px auto 5px;text-align:center;"></span>');
                    $(this).find('.border-line').fadeIn('fast');
                }
            }
        });
        
        $('#top #top-nav li').on('click', function(){
            currentItem = $(this).hasClass('current-menu-item');
            logo = $(this).hasClass('logo-between');
            
            if (logo == false && currentItem == true) {
                    $('#top #top-nav a .border-line').remove();
                    $(this).find('a').append('<span class="border-line" style="height:5px;background-color:#234766;display:block;margin:5px auto 5px;text-align:center;"></span>');
                    $(this).find('.border-line').fadeIn('fast');
            }
        }); 
    };

    var scrollNav = function () {
        var windowOffset = $('body').position();
        var windowOffsetTop = $(window).scrollTop();//windowOffset.top;
        var windowTopPos;
        var barVisible = $('#wpadminbar').is(':visible');
        var scrollpast = $('#wrapper #top').attr('class');

        $(document).on('scroll', function () {
            windowTopPos = $(window).scrollTop();
            //console.log(windowTopPos);
            
            if(windowTopPos >= 370) {
                $('#top').css('opacity', '0.8');
                $('#top').addClass('scrollpast');
                $('#home-nav').fadeIn('fast').css('display','block');
                    if(barVisible == true) {
                        $('#shadow-top').css('top','95px');
                    } else {
                        $('#shadow-top').css('top','123px');
                    }

            } else { 
                $('#top').css('opacity', '1');
                $('#top').removeClass('scrollpast');
                $('#home-nav').fadeOut(100).css('display','none');
            }
        });

       $('#top a[href="#"]').on('click', function() {
            $('html, body').animate({
                scrollTop: "0px"
            }, 400);
        });
       $('#top .logo-between a').on('click', function(e){
            e.preventDefault();
       });
    };

    var centerSliderNav = function () {
         // slider centre campaigns
        var lenSideWidth = $('#campaigns .ls_def_ibanner_banner .abs').width();
        var lensNavWidth = $('#campaigns .ls_def_ibanner_nav').width();
        var lensPos = ( lenSideWidth / 2 ) - ( lensNavWidth / 2 );
        $('#campaigns .ls_def_ibanner_nav').css('left', lensPos);

        // slider center events 
        var lenSlideWidthEvents = $('#events .slide-img').width();
        var lenNavWidthEvents = $('#events .ls_def_ibanner_nav').width();
        var lensPosEvent = ( lenSlideWidthEvents / 2 ) - ( lenNavWidthEvents / 2 );
        $('#events .ls_def_ibanner_nav').css('left', lensPosEvent);
    };

    var sliderFb = function () {
     // Slider for facebook
        var currentPosition = 0;
        var slides = $('.pcWrap');
        var numberOfSlides = slides.length;

        function getPcVal (pcWrapWidth, currentPosition) {
            var pcWrapID = $('.pcWrap.active').attr('id');
            $('#postForm textarea').attr('name', pcWrapID);
            //console.log('pcWrapID ' + pcWrapID);
        }

        function manageControls (position) {
                // hide left arrow if position = first slide
                if (position == 0) {
                    $('#leftControl').css('display',' none');
                } else {
                    $('#leftControl').css('display', 'block');
                }

                // hide right arrow if position is last slide
                if (position == numberOfSlides - 1) {
                    $('#rightControl').hide();
                } else {
                    $('#rightControl').show();
                }
        }
            // Create slider wrap
            $('.pcWrap').wrapAll('<div class="sliderWrap"></div>');
            
            // Create Previous and Next buttons
            $('#loading-posts').prepend('<div class="clear"></div>');
            $('#loading-posts').prepend('<div id="rightControl" class="control rightFB"><a href="#">Next</a></div>');
            $('#loading-posts').prepend('<div id="leftControl" class="control leftFB"><a href="#">Prev</a></div>');
            
            // Set slider wrap width 
            var pcWrapWidth = $('.pcWrap').outerWidth();
            var pcWrapLength = $('.pcWrap').length;
            var slideWidth = pcWrapWidth * pcWrapLength;

            //console.log('pcWrapWidth: ' + pcWrapWidth);
            //console.log('pcWraplength: ' + pcWrapLength);    
            //console.log('slideWidth: ' + slideWidth);

            $('.sliderWrap').css('width', slideWidth);

            manageControls(currentPosition);
            
            $('.pcWrap:eq(0)').addClass('active');
            getPcVal(pcWrapWidth, currentPosition);

            $('.control').on('click', function(e) {
                currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;

                manageControls(currentPosition);
                $('.sliderWrap').animate({
                    'marginLeft' : pcWrapWidth*(-currentPosition)
                }); 
                
                $('.pcWrap').removeClass('active');
                $('.pcWrap:eq(' + currentPosition + ')').addClass('active');

                getPcVal(pcWrapWidth, currentPosition);

                //console.log('current position = ' + currentPosition);
                e.preventDefault();
            });
    };

    var sliderBlogPost = function () {
     // Slider for facebook
        //console.log('test beg sliderblog post');
        var currentPosition = 0;
        var slidesBL = $('#blog-posts article');
        var numberOfSlidesBL = slidesBL.length;

        var manageControls = function(position) {
                // hide left arrow if position = first slide
                if (position == 0) {
                    $('#leftControlBL').hide()
                } else {
                    $('#leftControlBL').show()
                }

                // hide right arrow if position is last slide
                if (position == numberOfSlidesBL - 1) {
                    $('#rightControlBL').hide();
                } else {
                    $('#rightControlBL').show();
                }
        };
            // Create slider wrap
            $('#blog-posts article').wrapAll('<div class="sliderWrapBL"></div>');
            
            // Create Previous and Next buttons
            $('#blog-posts #main').prepend('<div class="clear"></div>');
            $('#blog-posts #main').prepend('<div id="rightControlBL" class="controlBL rightBL"><a href="#">Next</a></div>');
            $('#blog-posts #main').prepend('<div id="leftControlBL" class="controlBL leftBL"><a href="#">Prev</a></div>');
            
            // Set slider wrap width 
            var articleWrapWidth = $('#blog-posts article').outerWidth();
            var articleWrapLength = $('#blog-posts article').length;

            // console.log('pcWrapWidth: ' + pcWrapWidth);
            // console.log('pcWraplength: ' + pcWrapLength);
            var slideWidth = articleWrapWidth * articleWrapLength;
            // console.log('slideWidth: ' + slideWidth);

            $('.sliderWrapBL').css('width', slideWidth);

            manageControls(currentPosition);

            $('.controlBL').on('click', function(e) {
                currentPosition = ($(this).attr('id')=='rightControlBL') ? currentPosition+1 : currentPosition-1;

                manageControls(currentPosition);
                $('.sliderWrapBL').animate({
                    'marginLeft' : articleWrapWidth*(-currentPosition)
                }); 

                //console.log('current position = ' + currentPosition);
                e.preventDefault();
            });
        //console.log('test end slider blog post');
    };    

}(jQuery)); //IFE

