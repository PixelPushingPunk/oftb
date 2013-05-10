<?php
 
    /*require_once("facebook.php");
    
    $config = array();
    $config['appId'] = '134240710093824';
    $config['secret'] = '2098ddbb1f0029aba8fcd4cbbe09b44c';
    $config['cookie'] = true;
    $config['fileUpload'] = false; // optional

    $facebook = new Facebook($config);
    $signed_request = $facebook->getSignedRequest();
    $access_token = $facebook->getAccessToken();
    
    $page_id = '505165066';
    $fanpage_id = '261622440537988';
    $fb_user_id = $facebook->getUser();

    if(is_null($facebook-getUser())) {
        $params = array(
            'req_perms' => 'user_status, publish_stream, user_photos'
        );
        header("Location:{$facebook-getLoginURL($params)}");
        exit;
    }
    */
    # $feed_array = array(
    #     'message' => "Hello world!"
    # );
    # $page_post = $facebook->api("/$fanpage_id/feed","post",$feed_array);
   #error_reporting(E_ALL);
?>

<!-- Facebook SDK -->
<div id="fb-root"></div>
<script src="//connect.facebook.net/en_US/all.js"></script>
<script>
(function ($){
    var page_id = '505165066'; //505165066
    var fanpage_id = '261622440537988';
    var app_id = '134240710093824';
    var app_secret = '2098ddbb1f0029aba8fcd4cbbe09b44c';
    var uid, accessTokenVar;
    var myIDvar;

    // Additional JS functions here
    var reloadItemsMasonry = function () {
        var $facebookContainer = $('#facebook-friend-temp');
        $facebookContainer.masonry( 'reloadItems' );
    };

    var reloadMasonry = function () {
        var $facebookContainer = $('#facebook-friend-temp');
        $facebookContainer.masonry( 'reload' );
    };

    var destoryMasonry = function () {
        var $facebookContainer = $('#facebook-friend-temp');
        $facebookContainer.masonry( 'destroy' );
    };

    var initMasonry = function () {
        var $facebookContainer = $('#facebook-friend-temp');
        destoryMasonry();
        $facebookContainer.imagesLoaded(function(){
            $facebookContainer.masonry({
                // options
                itemSelector : '.itemFriend',
                columnWidth : 80,
                isAnimated: true, 
                isResizeable: true,
                isFitWidth: true
                //containerStyle: {float: 'left'}
            });
        });
    };

    var initResSlides = function () {
        $('.rslides').responsiveSlides({
            auto: false,             // Boolean: Animate automatically, true or false
            speed: 500,            // Integer: Speed of the transition, in milliseconds
            timeout: 4000,          // Integer: Time between slide transitions, in milliseconds
            pager: false,           // Boolean: Show pager, true or false
            nav: true,             // Boolean: Show navigation, true or false
            random: false,          // Boolean: Randomize the order of the slides, true or false
            pause: false,           // Boolean: Pause on hover, true or false
            pauseControls: true,    // Boolean: Pause when hovering controls, true or false
            prevText: "Previous",   // String: Text for the "previous" button
            nextText: "Next",       // String: Text for the "next" button
            maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
            navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
            manualControls: "",     // Selector: Declare custom pager navigation
            namespace: "rslides",   // String: Change the default namespace used
            before: function(){},   // Function: Before callback
            after: function(){}     // Function: After callback
        });
    };

    window.fbLoginStatus = function () {
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                $('.fbLogin').hide();
                $('.fbLogout').show();
                uid = response.authResponse.userID;
                accessTokenVar = response.authResponse.accessToken;

                $('#accessToken').val(accessTokenVar);
                //console.log('user id: ' + uid);
                //console.log('access token : ' + accessTokenVar);

                testAPI();
                initMasonry();
                console.log("connected");
                return true;
            } else if (response.status === 'not_authorized') {
                $('.fbLogin').show();
                $('.fbLogout').hide();
                console.log("not_authorized");
                return false;
            } else {
                $('.fbLogin').show();
                $('.fbLogout').hide();
                console.log("not_logged_in");
                return false;
            }
        });
    };

    window.fbAsyncInit = function () {
        FB.init({
            appId: '134240710093824', // App ID
            channelUrl: '//bg-brits2013-priceless-remakes.appspot.com/channel.html', // Channel File
            frictionlessRequests: true,
            init: true,
            level: 'debug',
            signedRequest: null,
            status: true, // check login status
            trace: false,
            viewMode: 'website',
            autoRun: true,
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true  // parse XFBML
        });

        // Additional init code here
        /*FB.Event.subscribe('auth.login', function(response){
            window.location.reload();
        });*/
        //testAPI();
        fbLoginStatus();
    };

    window.fbDoLogin = function () {
        FB.login(function (response) {
            if (response.authResponse) {
                //accessTokenVar = response.authResponse.accessToken;
                // console.log("connected");
                //testAPI();
                //$('#facebook-friends-temp').hide();
                fbLoginStatus();
                //initMasonry();
                console.log('just clicked on fbDoLogin');
            } else {
               // console.log("cancelled");
            }
        }, { scope: "user_likes, friends_likes, publish_actions, manage_pages, publish_stream, publish_actions, offline_access, read_stream, status_update, photo_upload, share_item, create_note, video_upload, read_requests" });
        
        setTimeout(function(){ fbLoginStatus(); }, 5000);
    };
    //publish_stream, publish_actions, email

    window.fbDoLogout = function() {
        FB.logout(function(response) {
            if(response.authReponse) {
                //var accessTokenVar = response.authResponse.accessToken;
                fbLoginStatus();
                reloadItemsMasonry();
                console.log('just clicked on fbDoLogout');
            } else {

            }
            // user is now logged out
            //var accessTokenVar = response.authResponse.accessToken;
            //console.log(response);
        });

         setTimeout(function(){ fbLoginStatus(); }, 2000);
    };

    var include = function (arr, obj) {
        //for(var i=0; i<arr.length; i++) {
            if (arr == obj) {
                //console.log('true');
                return true;
            } else {
                //console.log('false');
                return false;
            }
        //}
    };

    window.addAsFriend = function () {
        FB.api('/me/friends', function(response){
            var oftb;
            var page_id = '505165066';
            $.each(response.data, function(index, value) {
                oftb = include(value.id, page_id);
                //console.log('oftb: ' + oftb);
                // console.log(value.id);
            }); 
                if(oftb) {
                    // request friendship
                    alert('You are already friends');
                    return false;
                } else {
                    // you are already friends
                   
                    FB.ui({ method: 'friends.add', id: page_id });
                   
                }
        });
        FB.api('/' + page_id + '/?fields=friendrequests', function(response){

        });
    };

    window.myIdFB = function () {
        FB.api('/me?fields=id', function (response) { 
                $.each(response, function(index, value) {
                    if(response) {
                        myIDvar = value;
                        //console.log('my id ' + value);
                        //console.log('type of ' + typeof value);
                        return myIDvar = value;
                    } else {
                        myIDvar = 0;
                        return null;
                    } 
                });
        });
    };

    window.checkDoesLike = function () {
        myIdFB();
        var friendsID, friendImg, friendsName;
        var fanFriends = {};
        //var myIDvar;
        var isEmpty = function (obj) {
            for(var prop in obj) {
                if(obj.hasOwnProperty(prop)) {
                    return false;
                }    
            }
            return true;
        };

        var getId = function (id, name) {
            
            // Remove existing friend like images
            $('.myFriends').remove();

            var divContainer = $('#facebook-friend-temp');
            FB.api('/' + id + '/likes/261622440537988', function(response){
                
                if( response.data ) {
                    if( !isEmpty(response.data)) {
                        //console.log('You are a fan!');
                        //console.log('id of fan ' + id);
                        var friendImg = 'https://graph.facebook.com/' + id + '/picture?width=64&height=64';
                        $("<div class='itemFriend friendWrap myFriends'><a class=\"friendLike\" href=\"#\"><img /></a><div class=\"friend-detail-wrap\"><a href=\"#\" class=\"friend-detail\">" + name +"</a></div></div>")
                            .find("img")
                              .attr({
                                  src: friendImg
                                  //alt: response.data[i].name,
                                  //title: response.data[i].name
                                  //onClick: 'alert("You selected "+this.title); return false;'
                              })
                            .end()
                            .prependTo(divContainer);
                            //initMasonry();
                            reloadMasonry();
                            return id;
                    } else {
                        //console.log('Not a fan!'); 
                        return false;
                    }
                } else {
                    //console.log('FATAL ERROR!');
                    return false;
                }
        
            });
        };

        var meLikesPage = function () {
            // remove existing images
            $('.iFriends').remove();

            var divContainer = $('#facebook-friend-temp');
            FB.api('/me/likes/261622440537988', function(response) {
                if( response.data ) {
                    if(!isEmpty(response.data)){
                        var myImg = 'https://graph.facebook.com/' + myIDvar + '/picture?width=64&height=64';
                        $("<div class='itemFriend friendWrap iFriends'><a class=\"iLike\" href=\"#\"><img /></a><div class=\"friend-detail-wrap\"><a href=\"#\" class=\"friend-detail\">You</a></div></div>")
                            .find("img")
                              .attr({
                                  src: myImg
                                  //alt: response.data[i].name,
                                  //title: response.data[i].name
                                  //onClick: 'alert("You selected "+this.title); return false;'
                              })
                            .end()
                            .prependTo(divContainer);
                            //initMasonry();
                            reloadMasonry();
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
                
            });
            //console.log('me likes page end ');
        };

        
        
        FB.api('/me/friends', function (response) { 
            var divContainer = $('.facebook-section');
            $.each(response.data, function(index, value) {
                friendsID = value.id;
                friendsName = value.name;
                getId(friendsID, friendsName);
            });
            meLikesPage();
        });

        
        //initMasonry();    
    };

    window.loadFriends = function () {
        FB.api('/' + page_id + '/friends?fields=name,link', function (response) {
            $("#loadingFriends, #facebook-friends-temp").hide();
            var divContainer = $('#facebook-friends');

            var startCount = (response.data.length - 10) ? response.data.length - 10 : 0; 
            var inCount = response.data.length;

            for (i = 0; i < inCount; i++) { 
                $("<div class=\"itemFriend friendWrap\"><a class=\"friend\" href=\"#\"><img /></a><div class=\"friend-detail-wrap\"><a href=\"#\" class=\"friend-detail\">" + response.data[i].name +"</a></div></div>")
	  	    .find(".friend")
            .attr({
	  	        id: response.data[i].id,
	  	        href: response.data[i].link
	  	    })
            .end()
	  	    .find("img")
	          .attr({
	              src: 'https://graph.facebook.com/' + response.data[i].id + '/picture?width=64&height=64',
	              alt: response.data[i].name,
	              title: response.data[i].name
	              //onClick: 'alert("You selected "+this.title); return false;'
	          })
	        .end()
	        .appendTo(divContainer);
            }
        });
    };

    window.postToWallUsingFBApi = function (thisPostID) {
        function onPostToWallCompleted(response) {
            if (response) {
                if (response.error) {
                    //document.getElementById("txtEcho").innerHTML=response.error.message;
                    alert('response error: ' + response.error.message);
                } 
                else {
                    if (response.id) {
                       //document.getElementById("txtEcho").innerHTML="Posted as post_id "+response.id;
                        alert('posted as post_id: ' + response.id);
                    } 
                    else if (response.post_id) {
                        //document.getElementById("txtEcho").innerHTML="Posted as post_id "+response.post_id;
                        alert('Posted as post_id: ' + response.post_id);
                    } 
                    else {
                        //document.getElementById("txtEcho").innerHTML="Unknown Error";
                        alert('Unknown Error');
                    }
                }
            }
        }

        var msgVal = $('.textareaFB').val();

        var data = {
            //caption: 'This is my wall post example',
            message: msgVal//'Post another message through fbapi'
        }

        var dataUser = {
            message: msgVal//'Message from user'
            //access_token: accessTokenVar
            //from: uid
        }

        //console.log('user id on click: ' + uid);
        //console.log('access token on click: ' + accessTokenVar);
        
        //FB.api('/'+ fanpage_id +'/feed', 'post', data, onPostToWallCompleted);
        FB.api('/' + thisPostID + '/comments?access_token=' + accessTokenVar + '', 'POST', dataUser, onPostToWallCompleted);

        //http://www.fbrell.com/xfbml/fb:share-button
        //https://developers.facebook.com/bugs/409281805774218/
        //http://stackoverflow.com/questions/14792062/posting-to-friends-wall-with-graph-api-via-feed-connection-failing-since-feb
        //http://stackoverflow.com/questions/13829086/oauthexception-when-trying-to-post-to-friends-wall
        //https://developers.facebook.com/roadmap/#february-2013
        //http://stackoverflow.com/questions/14056046/feed-story-publishing-to-other-users-is-disabled-for-this-application
    };

    var pcWrapIDGLOBAL;
    var getPlacePostID = function() {
        pcWrapIDGLOBAL = $('.pcWrap.rslides1_on').attr('title');
        //$('#postForm textarea').attr('name', pcWrapID);
        console.log('pc wrap gloabl ' + pcWrapIDGLOBAL);
    };

    var placePostID = function () {
        //console.log('pcWrapID ' + pcWrapID);
        $('#postForm textarea').attr('name', pcWrapIDGLOBAL);
        $('body').on('click', '#loading-posts .rslides_nav', function() {
            getPlacePostID();
            $('#postForm textarea').attr('name', pcWrapIDGLOBAL);
            console.log('pc wrap gloabl ' + pcWrapIDGLOBAL);
        });
    };

    window.loadPosts = function () {
        //initMasonry();
        FB.api('/'+fanpage_id+'/posts', function(response) {
            $('#loadingComments').hide();
            $('#loading-posts').show();
            var divContainer = $('#loading-posts');

            // Posts & Comments
            $.each(response.data, function(index, value) {
                var x = $.inArray("message", value);
                if(value.message && value.picture) {
                    var pcWrap = $('.pcWrap'); //onclick='javascript:postToWallUsingFBApi(thisPostID);'
                    var thisPostID = value.id; //<form><textarea class='textareaFB' data-id='" + thisPostID + "'></textarea><br><input class='postToWall' type='submit' id='" + thisPostID + "' value='comment' name='comment' id="+ value.object_id +"/></form>
                    $("<div class='pcWrap'><div class='postWrapper'><a class='posts' href='#'><img class='post-img'/></a><p>" + value.message + "</p></div><div class='commentsWrapper'></div></div>")
                        .attr({
                            title: value.id,
                            name: value.from.name
                        })
                        .find("img.post-img")
                        .attr({
                            src: value.picture+'?width=64&height=64',
                            alt: value.from.name
                        })
                        .end()
                        .appendTo(divContainer);
                    
                    //console.log('value id is: ' + thisPostID);   

                    if(typeof value.comments !=='undefined') {

                        $.each(value.comments.data, function(index, valueB){
                            var date = new Date(valueB.created_time);
                            var day = date.getDate();
                            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
                            var month = date.getMonth();
                            var hours = date.getUTCHours();
                            var minutes = date.getUTCMinutes();

                           $("<div class='comments'><a href='#'><img class='comment-img'/></a><p>" + valueB.message + "</p><span class='time'>" + day + " " + monthNames[month] + " at " + hours + ":" + minutes + "</span><span class='like'></span></div>")
                            .attr({
                                id: valueB.id,//from.id,
                                name: valueB.from.name
                            })
                            .find("img.comment-img")
                            .attr({
                                src: 'https://graph.facebook.com/' + valueB.from.id + '/picture?width=64&height=64',
                                alt: valueB.from.name
                            })
                            .end()
                            .appendTo($('.commentsWrapper'));
                        });
                    }
                }
                       
            }); // End loop 
            initResSlides();
            getPlacePostID();
            placePostID();
        }); // End FB.api - posts
    }; // end window.load.post.function

    window.testAPI = function () {
        //addAsFriend();
        //loadFriends();
        loadPosts();
        checkDoesLike();
    };

    // Load the SDK Asynchronously
    (function (d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) { return; }
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    } (document));

    $(window).load(function(){  });

}(jQuery));
</script>	
